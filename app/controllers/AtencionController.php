<?php
namespace App\Controllers;

require_once __DIR__ . '/../models/Atencion.php';

use App\Models\Atencion;

class AtencionController {
    private $model;

    public function __construct() {
        $this->model = new Atencion();
    }

    /**
     * Entrada POST desde la vista de Atención Médica
     */
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido';
            return;
        }

        $tratamientos = $this->parseTratamientos($_POST['tratamientos'] ?? []);

        $payload = [
            'id_cita'           => $_POST['id_cita'] ?? null,
            'id_triaje'         => $_POST['id_triaje'] ?? null,
            'id_paciente'       => $_POST['id_paciente'] ?? null,
            'numdoc_paciente'   => $_POST['numdoc_paciente'] ?? null,
            'id_medico'         => $_POST['id_medico'] ?? ($_SESSION['id_medico'] ?? null),
            'id_especialidad'   => $_POST['id_especialidad'] ?? null,
            'codigo_historial'  => $_POST['codigo_historial'] ?? null,
            'motivo_consulta'   => $_POST['motivo_consulta'] ?? null,
            'desc_diagnostico'  => $_POST['desc_diagnostico'] ?? null,
            'desc_antecedentes' => $_POST['desc_antecedentes'] ?? null,
            'cie10_principal'   => $_POST['cie10_principal'] ?? null,
            'nota_diag_principal' => $_POST['nota_diag_principal'] ?? null,
            'cie10_secundarios' => $_POST['cie10_secundarios'] ?? [],
            'fecha_atencion'    => $_POST['fecha_atencion'] ?? date('Y-m-d H:i:s'),
            'estado'            => 1,
            'tratamientos'      => $tratamientos,
        ];

        $resultado = $this->model->guardarAtencionCompleta($payload);

        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            header('Content-Type: application/json');
            echo json_encode($resultado);
            return;
        }

        if (!empty($resultado['success'])) {
            header('Location: ' . BASE_URL . '/atencion/medica?success=1');
            exit;
        }

        header('Location: ' . BASE_URL . '/atencion/medica?error=' . urlencode($resultado['error'] ?? 'Error al guardar atención'));
        exit;
    }

    /**
     * Normaliza tratamientos recibidos del formulario
     */
    private function parseTratamientos($input): array {
        if (!is_array($input)) {
            return [];
        }

        $tratamientos = [];
        foreach ($input as $item) {
            if (!is_array($item)) {
                continue;
            }
            $tratamientos[] = [
                'id_medicamento'  => $item['id_medicamento'] ?? null,
                'dosis'           => $item['dosis'] ?? null,
                'valor_frecuencia'=> $item['valor_frecuencia'] ?? null,
                'dias_tratamiento'=> $item['dias_tratamiento'] ?? null,
                'total'           => $item['total'] ?? null,
            ];
        }
        return $tratamientos;
    }
}
