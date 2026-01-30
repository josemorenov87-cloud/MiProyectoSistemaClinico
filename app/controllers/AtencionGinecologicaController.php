<?php
namespace App\Controllers;

use App\Models\AtencionGeneral;
use App\Models\HistorialDetalle;
use App\Models\HistorialPaciente;
use App\Models\HistorialDiag;

require_once __DIR__ . '/../models/AtencionGeneral.php';
require_once __DIR__ . '/../models/HistorialDetalle.php';
require_once __DIR__ . '/../models/HistorialPaciente.php';
require_once __DIR__ . '/../models/HistorialDiag.php';
require_once __DIR__ . '/../conexion.php';

class AtencionGinecologicaController {
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }

    public function registrarAtencion($data) {
            require_once __DIR__ . '/../models/PacienteHelper.php';
        require_once __DIR__ . '/../models/Triaje.php';
        require_once __DIR__ . '/../models/Cita.php';
        $atencionModel = new AtencionGeneral($this->db);
        $historialDetalleModel = new HistorialDetalle($this->db);
        $historialPacienteModel = new HistorialPaciente($this->db);
        $historialDiagModel = new HistorialDiag($this->db);
        $triajeModel = new \App\Models\Triaje($this->db);
        $citaModel = new \App\Models\Cita($this->db);
        require_once __DIR__ . '/../models/Tratamiento.php';
        require_once __DIR__ . '/../models/ExamenesPaciente.php';
        $tratamientoModel = new \App\Models\Tratamiento($this->db);
        $examenesPacienteModel = new \App\Models\ExamenesPaciente($this->db);

        // Buscar id_triaje y id_cita por documento
        $triajeData = $triajeModel->obtenerIdPorDocumento($data['numdoc_paciente']);
        $id_triaje = $triajeData['id_triaje'] ?? $data['id_triaje'];
        $id_cita = $triajeData['id_cita'] ?? $data['id_cita'];

        // Buscar id_paciente por numdoc_paciente
        $id_paciente = \App\Models\PacienteHelper::getIdPacientePorDocumento($data['numdoc_paciente']);
        if (!$id_paciente) {
            // Si no se encuentra, usar el que viene en data (fallback)
            $id_paciente = $data['id_paciente'] ?? 0;
        }

        // Buscar id_especialidad y id_medico por id_cita
        $citaData = $citaModel->obtenerDatosPorId($id_cita);
        $id_especialidad = $citaData['id_especialidad'] ?? $data['id_especialidad'];
        $id_medico = $citaData['id_medico'] ?? $data['id_medico'];

        // Buscar el diagnóstico principal (CIE10 principal)
        $id_cie10_principal = null;
        if (!empty($data['diagnosticos'])) {
            foreach ($data['diagnosticos'] as $diag) {
                if (isset($diag['es_principal']) && $diag['es_principal']) {
                    $id_cie10_principal = $diag['id_cie10'];
                    break;
                }
            }
        }
        if (!$id_cie10_principal && isset($data['id_cie10'])) {
            $id_cie10_principal = $data['id_cie10'];
        }

        // 1. Registrar atención general con CIE10 principal
        $id_atencion = $atencionModel->insertar(
            $id_triaje,
            $id_paciente,
            $id_cie10_principal,
            $data['desc_diagnostico'] ?? '',
            $data['desc_antecedentes'] ?? ''
        );
        if (!$id_atencion) return false;

        // 2. Buscar o crear historial paciente
        $historial = $historialPacienteModel->buscarPorPaciente($data['id_paciente']);
        if (!$historial) {
            $codigo_historial = 'HC-' . $data['numdoc_paciente'];
            $id_historial_pac = $historialPacienteModel->insertar($data['id_paciente'], $data['numdoc_paciente'], $codigo_historial);
        } else {
            $id_historial_pac = $historial['id_historial_pac'];
        }

        // 3. Registrar detalle de historial con CIE10 principal
        $id_historial_detalle = $historialDetalleModel->insertar(
            $id_historial_pac,
            $id_cita,
            $id_triaje,
            $id_atencion,
            $id_medico,
            $id_especialidad,
            $id_cie10_principal,
            $data['motivo_consulta'] ?? '',
            $data['desc_diagnostico'] ?? '',
            $data['desc_antecedentes'] ?? '',
            $data['fecha_atencion'] ?? date('Y-m-d'),
            $data['estado'] ?? null
        );

        // 4. Registrar diagnósticos (principal y secundarios)
        if (!empty($data['diagnosticos'])) {
            foreach ($data['diagnosticos'] as $diag) {
                $historialDiagModel->insertar(
                    $id_historial_detalle,
                    $diag['id_cie10'],
                    $diag['es_principal'],
                    $diag['nota']
                );
            }
        }

        // 5. Registrar tratamientos (receta médica)
        if (!empty($data['tratamientos'])) {
            foreach ($data['tratamientos'] as $trat) {
                $tratamientoModel->insertar(
                    $id_atencion,
                    $trat['id_medicamento'],
                    $trat['dosis'],
                    $trat['valor_frecuencia'],
                    $trat['dias_tratamiento'],
                    $trat['total'],
                    $id_historial_detalle
                );
            }
        }

        // 6. Registrar exámenes médicos solicitados
        if (!empty($data['examenes'])) {
            foreach ($data['examenes'] as $examen) {
                $examenesPacienteModel->insertar(
                    $id_historial_detalle,
                    $examen['id_tipexam'],
                    $examen['observacion'] ?? ''
                );
            }
        }
        return true;
    }
}
