<?php
namespace App\Models;

/**
 * Modelo para registrar atención general y su historial clínico
 */
class Atencion {
    private $conn;

    public function __construct() {
        $this->conn = getConnection();
    }

    /**
     * Guardar atención completa (atengeneral + historial + diagnósticos + tratamientos)
     */
    public function guardarAtencionCompleta(array $data): array {
        $this->conn->begin_transaction();

        try {
            $idPaciente = $this->obtenerIdPaciente($data['numdoc_paciente'] ?? null, $data['id_paciente'] ?? null);
            $idHistorialPac = $this->obtenerOcrearHistorial($idPaciente, $data['numdoc_paciente'] ?? null, $data['codigo_historial'] ?? null);

            $idAtencion = $this->insertarAtencionGeneral([
                'id_triaje'        => $data['id_triaje'] ?? null,
                'id_paciente'      => $idPaciente,
                'id_cie10'         => $data['cie10_principal'] ?? null,
                'desc_diagnostico' => $data['desc_diagnostico'] ?? null,
                'desc_antecedentes'=> $data['desc_antecedentes'] ?? null,
            ]);

            $idHistorialDetalle = $this->insertarHistorialDetalle([
                'id_historial_pac' => $idHistorialPac,
                'id_cita'          => $data['id_cita'] ?? null,
                'id_triaje'        => $data['id_triaje'] ?? null,
                'id_atencion'      => $idAtencion,
                'id_medico'        => $data['id_medico'] ?? null,
                'id_especialidad'  => $data['id_especialidad'] ?? null,
                'id_cie10'         => $data['cie10_principal'] ?? null,
                'motivo_consulta'  => $data['motivo_consulta'] ?? null,
                'desc_diagnostico' => $data['desc_diagnostico'] ?? null,
                'desc_antecedentes'=> $data['desc_antecedentes'] ?? null,
                'fecha_atencion'   => $data['fecha_atencion'] ?? date('Y-m-d H:i:s'),
                'estado'           => $data['estado'] ?? 1,
            ]);

            $this->insertarDiagnosticos(
                $idHistorialDetalle,
                $data['cie10_principal'] ?? null,
                $data['nota_diag_principal'] ?? null,
                $data['cie10_secundarios'] ?? []
            );

            if (!empty($data['tratamientos']) && is_array($data['tratamientos'])) {
                $this->insertarTratamientos($idAtencion, $idHistorialDetalle, $data['tratamientos']);
            }

            $this->conn->commit();

            return [
                'success' => true,
                'id_atencion' => $idAtencion,
                'id_historial' => $idHistorialDetalle,
                'id_historial_paciente' => $idHistorialPac,
            ];
        } catch (\Exception $e) {
            $this->conn->rollback();
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Obtener paciente por documento si no llega el id
     */
    private function obtenerIdPaciente(?string $numdoc, ?int $idPaciente): ?int {
        if (!empty($idPaciente)) {
            return (int)$idPaciente;
        }

        if (empty($numdoc)) {
            return null;
        }

        $stmt = $this->conn->prepare('SELECT id_paciente FROM tb_pacientes WHERE numdoc_paciente = ? LIMIT 1');
        if (!$stmt) {
            throw new \Exception('No se pudo preparar consulta de paciente: ' . $this->conn->error);
        }

        $stmt->bind_param('s', $numdoc);
        $stmt->execute();
        $rs = $stmt->get_result();
        $row = $rs ? $rs->fetch_assoc() : null;
        $stmt->close();

        return $row ? (int)$row['id_paciente'] : null;
    }

    /**
     * Recuperar historial existente o crearlo
     */
    private function obtenerOcrearHistorial(?int $idPaciente, ?string $numdoc, ?string $codigoHistorial): int {
        $sql = 'SELECT id_historial_pac FROM tb_historial_paciente WHERE 1=1';
        if (!empty($idPaciente)) {
            $sql .= ' AND id_paciente = ' . (int)$idPaciente;
        }
        if (!empty($numdoc)) {
            $sql .= " OR numdoc_paciente = '" . $this->conn->real_escape_string($numdoc) . "'";
        }
        $sql .= ' ORDER BY id_historial_pac DESC LIMIT 1';

        $result = $this->conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return (int)$row['id_historial_pac'];
        }

        $codigo = !empty($codigoHistorial)
            ? $codigoHistorial
            : 'HIS-' . ($numdoc ?: 'PAC') . '-' . date('YmdHis');

        $sqlInsert = sprintf(
            "INSERT INTO tb_historial_paciente (id_paciente, numdoc_paciente, codigo_historial) VALUES (%s, %s, %s)",
            $this->toSqlNumber($idPaciente),
            $this->toSqlText($numdoc),
            $this->toSqlText($codigo)
        );

        if (!$this->conn->query($sqlInsert)) {
            throw new \Exception('No se pudo crear historial del paciente: ' . $this->conn->error);
        }

        return (int)$this->conn->insert_id;
    }

    /**
     * Insertar en tb_atengeneral
     */
    private function insertarAtencionGeneral(array $data): int {
        $sql = sprintf(
            "INSERT INTO tb_atengeneral (id_triaje, id_paciente, id_cie10, desc_diagnostico, desc_antecedentes) VALUES (%s, %s, %s, %s, %s)",
            $this->toSqlNumber($data['id_triaje'] ?? null),
            $this->toSqlNumber($data['id_paciente'] ?? null),
            $this->toSqlNumber($data['id_cie10'] ?? null),
            $this->toSqlText($data['desc_diagnostico'] ?? null),
            $this->toSqlText($data['desc_antecedentes'] ?? null)
        );

        if (!$this->conn->query($sql)) {
            throw new \Exception('Error guardando atención general: ' . $this->conn->error);
        }

        return (int)$this->conn->insert_id;
    }

    /**
     * Insertar detalle de historial
     */
    private function insertarHistorialDetalle(array $data): int {
        $sql = sprintf(
            "INSERT INTO tb_historial_detalle (id_historial_pac, id_cita, id_triaje, id_atencion, id_medico, id_especialidad, id_cie10, motivo_consulta, desc_diagnostico, desc_antecedentes, fecha_atencion, estado) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
            $this->toSqlNumber($data['id_historial_pac'] ?? null),
            $this->toSqlNumber($data['id_cita'] ?? null),
            $this->toSqlNumber($data['id_triaje'] ?? null),
            $this->toSqlNumber($data['id_atencion'] ?? null),
            $this->toSqlNumber($data['id_medico'] ?? null),
            $this->toSqlNumber($data['id_especialidad'] ?? null),
            $this->toSqlNumber($data['id_cie10'] ?? null),
            $this->toSqlText($data['motivo_consulta'] ?? null),
            $this->toSqlText($data['desc_diagnostico'] ?? null),
            $this->toSqlText($data['desc_antecedentes'] ?? null),
            $this->toSqlText($data['fecha_atencion'] ?? null),
            $this->toSqlNumber($data['estado'] ?? null)
        );

        if (!$this->conn->query($sql)) {
            throw new \Exception('Error guardando detalle del historial: ' . $this->conn->error);
        }

        return (int)$this->conn->insert_id;
    }

    /**
     * Insertar diagnósticos principal/secundarios
     */
    private function insertarDiagnosticos(?int $idHistorialDetalle, $ciePrincipal, ?string $notaPrincipal, array $cieSecundarios): void {
        if (empty($idHistorialDetalle)) {
            return;
        }

        if (!empty($ciePrincipal)) {
            $sql = sprintf(
                "INSERT INTO tb_historial_diag (id_historial, id_cie10, es_principal, nota) VALUES (%s, %s, 1, %s)
                ON DUPLICATE KEY UPDATE es_principal = VALUES(es_principal), nota = VALUES(nota)",
                $this->toSqlNumber($idHistorialDetalle),
                $this->toSqlNumber($ciePrincipal),
                $this->toSqlText($notaPrincipal)
            );

            if (!$this->conn->query($sql)) {
                throw new \Exception('Error guardando diagnóstico principal: ' . $this->conn->error);
            }
        }

        if (!empty($cieSecundarios) && is_array($cieSecundarios)) {
            foreach ($cieSecundarios as $cie) {
                $cie = trim((string)$cie);
                if ($cie === '' || $cie == $ciePrincipal) {
                    continue;
                }

                $sql = sprintf(
                    "INSERT INTO tb_historial_diag (id_historial, id_cie10, es_principal, nota) VALUES (%s, %s, 0, NULL)
                    ON DUPLICATE KEY UPDATE es_principal = VALUES(es_principal)",
                    $this->toSqlNumber($idHistorialDetalle),
                    $this->toSqlNumber($cie)
                );

                if (!$this->conn->query($sql)) {
                    throw new \Exception('Error guardando diagnóstico secundario: ' . $this->conn->error);
                }
            }
        }
    }

    /**
     * Insertar tratamientos vinculados
     */
    private function insertarTratamientos(int $idAtencion, int $idHistorialDetalle, array $tratamientos): void {
        foreach ($tratamientos as $t) {
            $sql = sprintf(
                "INSERT INTO tb_tratamiento (id_atencion, id_medicamento, dosis, valor_frecuencia, dias_tratamiento, total, id_historial) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                $this->toSqlNumber($idAtencion),
                $this->toSqlNumber($t['id_medicamento'] ?? null),
                $this->toSqlNumber($t['dosis'] ?? null),
                $this->toSqlNumber($t['valor_frecuencia'] ?? null),
                $this->toSqlNumber($t['dias_tratamiento'] ?? null),
                $this->toSqlNumber($t['total'] ?? null),
                $this->toSqlNumber($idHistorialDetalle)
            );

            if (!$this->conn->query($sql)) {
                throw new \Exception('Error guardando tratamiento: ' . $this->conn->error);
            }
        }
    }

    private function toSqlNumber($value): string {
        return ($value === null || $value === '' || !is_numeric($value)) ? 'NULL' : (string)(int)$value;
    }

    private function toSqlText($value): string {
        return ($value === null || $value === '') ? 'NULL' : "'" . $this->conn->real_escape_string((string)$value) . "'";
    }
}
