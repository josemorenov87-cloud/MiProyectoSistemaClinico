<?php
namespace App\Models;

/**
 * Modelo para obtener las citas del médico autenticado
 */
class CitaMedico {
    private $conexion;
    private $tabla = 'tb_citas';

    public function __construct() {
        global $mysqli;
        $this->conexion = $mysqli;
    }

    /**
     * Listar citas por médico (incluye datos del paciente y especialidad)
     */
    public function listarPorMedico($id_medico) {
        $sql = "SELECT 
                    c.id_cita,
                    c.fecha_cita,
                    c.hora_cita,
                    c.motivo_cita,
                    c.id_medico,
                    c.id_especialidad,
                    c.numdoc_paciente,
                    p.nom_paciente,
                    p.apepat_paciente,
                    p.apemat_paciente,
                    p.tel_paciente,
                    p.cel_paciente,
                    e.desc_especialidad
                FROM {$this->tabla} c
                LEFT JOIN tb_pacientes p ON c.numdoc_paciente = p.numdoc_paciente
                LEFT JOIN tb_especialidades e ON c.id_especialidad = e.id_especialidad
                WHERE c.id_medico = ?
                ORDER BY c.fecha_cita ASC, c.hora_cita ASC";

        $stmt = $this->conexion->prepare($sql);

        if (!$stmt) {
            error_log('Error preparando consulta listarPorMedico: ' . $this->conexion->error);
            return [];
        }

        $stmt->bind_param('i', $id_medico);
        $stmt->execute();
        $resultado = $stmt->get_result();

        $citas = [];
        while ($row = $resultado->fetch_assoc()) {
            $nombrePaciente = trim(
                ($row['nom_paciente'] ?? '') . ' ' .
                ($row['apepat_paciente'] ?? '') . ' ' .
                ($row['apemat_paciente'] ?? '')
            );
            $row['paciente_nombre'] = preg_replace('/\s+/', ' ', trim($nombrePaciente));
            $row['especialidad_nombre'] = !empty($row['desc_especialidad'])
                ? $row['desc_especialidad']
                : '';

            $citas[] = $row;
        }

        return $citas;
    }
}
