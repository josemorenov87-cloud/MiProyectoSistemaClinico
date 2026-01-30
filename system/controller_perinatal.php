<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/conexion.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

$data = $_POST;

// Validar campos obligatorios
$required = ['id_paciente', 'fechaAtencion', 'diagnosticos', 'tratamientos', 'examenes'];
foreach ($required as $field) {
    if (empty($data[$field])) {
        echo json_encode(['success' => false, 'message' => 'Falta el campo: ' . $field]);
        exit;
    }
}

$id_paciente = $data['id_paciente'];
$fechaAtencion = $data['fechaAtencion'];
$diagnosticos = json_decode($data['diagnosticos'], true);
$tratamientos = json_decode($data['tratamientos'], true);
$examenes = json_decode($data['examenes'], true);
$motivo_consulta = $data['motivo_consulta'] ?? '';
$desc_diagnostico = $data['desc_diagnostico'] ?? '';
$desc_antecedentes = $data['desc_antecedentes'] ?? '';
$alergias = $data['alergias'] ?? '';

$conn = conectar();
$conn->begin_transaction();
try {
    // Insertar atención perinatal
    $stmt = $conn->prepare("INSERT INTO atencion_perinatal (id_paciente, fecha_atencion, motivo_consulta, desc_diagnostico, desc_antecedentes, alergias) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('isssss', $id_paciente, $fechaAtencion, $motivo_consulta, $desc_diagnostico, $desc_antecedentes, $alergias);
    $stmt->execute();
    $id_atencion = $conn->insert_id;
    $stmt->close();

    // Diagnósticos
    $stmtDiag = $conn->prepare("INSERT INTO atencion_perinatal_diagnostico (id_atencion, id_cie10, es_principal, nota) VALUES (?, ?, ?, ?)");
    foreach ($diagnosticos as $diag) {
        $stmtDiag->bind_param('iiis', $id_atencion, $diag['id_cie10'], $diag['es_principal'], $diag['nota']);
        $stmtDiag->execute();
    }
    $stmtDiag->close();

    // Tratamientos
    $stmtTrat = $conn->prepare("INSERT INTO atencion_perinatal_tratamiento (id_atencion, id_medicamento, dosis, valor_frecuencia, dias_tratamiento, total) VALUES (?, ?, ?, ?, ?, ?)");
    foreach ($tratamientos as $trat) {
        $stmtTrat->bind_param('iisiii', $id_atencion, $trat['id_medicamento'], $trat['dosis'], $trat['valor_frecuencia'], $trat['dias_tratamiento'], $trat['total']);
        $stmtTrat->execute();
    }
    $stmtTrat->close();

    // Exámenes
    $stmtExam = $conn->prepare("INSERT INTO atencion_perinatal_examen (id_atencion, id_tipexam, observacion) VALUES (?, ?, ?)");
    foreach ($examenes as $exam) {
        $stmtExam->bind_param('iis', $id_atencion, $exam['id_tipexam'], $exam['observacion']);
        $stmtExam->execute();
    }
    $stmtExam->close();

    $conn->commit();
    echo json_encode(['success' => true, 'message' => 'Atención perinatal registrada']);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => 'Error al guardar: ' . $e->getMessage()]);
}
