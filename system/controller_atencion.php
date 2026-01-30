<?php
require_once __DIR__ . '/../app/controllers/AtencionMedicaController.php';
require_once __DIR__ . '/../app/conexion.php';

use App\Controllers\AtencionMedicaController;

global $conn;
$db = $conn;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'id_triaje' => $_POST['id_triaje'] ?? null,
        'id_paciente' => $_POST['id_paciente'] ?? null,
        'id_cie10' => $_POST['id_cie10'] ?? null,
        'desc_diagnostico' => $_POST['desc_diagnostico'] ?? '',
        'desc_antecedentes' => $_POST['desc_antecedentes'] ?? '',
        'id_cita' => $_POST['id_cita'] ?? null,
        'id_medico' => $_POST['id_medico'] ?? null,
        'id_especialidad' => $_POST['id_especialidad'] ?? null,
        'numdoc_paciente' => $_POST['numdoc_paciente'] ?? '',
        'motivo_consulta' => $_POST['motivo_consulta'] ?? '',
        'fecha_atencion' => date('Y-m-d H:i:s'),
        'estado' => 1,
        'diagnosticos' => isset($_POST['diagnosticos']) ? json_decode($_POST['diagnosticos'], true) : [],
        'tratamientos' => isset($_POST['tratamientos']) ? json_decode($_POST['tratamientos'], true) : [],
        'examenes' => isset($_POST['examenes']) ? json_decode($_POST['examenes'], true) : []
    ];
    $controller = new AtencionMedicaController($db);
    $ok = $controller->registrarAtencion($data);
    header('Content-Type: application/json');
    if ($ok) {
        echo json_encode(['success' => true, 'message' => 'Registro exitoso']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al registrar']);
    }
    exit;
}
