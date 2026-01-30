<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../../app/conexion.php';

$numdoc_paciente = $_POST['numdoc_paciente'] ?? '';
$id_especialidad = $_POST['id_especialidad'] ?? 0;
$id_medico = $_POST['id_medico'] ?? 0;
$fecha_cita = $_POST['fecha_cita'] ?? '';
$hora_cita = $_POST['hora_cita'] ?? '';
$motivo_cita = $_POST['motivo_cita'] ?? '';

if (!$numdoc_paciente || !$id_especialidad || !$id_medico || !$fecha_cita || !$hora_cita || !$motivo_cita) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos']);
    exit;
}

// Insertar cita
$sql = "INSERT INTO tb_citas (numdoc_paciente, id_especialidad, id_medico, fecha_cita, hora_cita, motivo_cita) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('siisss', $numdoc_paciente, $id_especialidad, $id_medico, $fecha_cita, $hora_cita, $motivo_cita);

if ($stmt->execute()) {
    // Marcar horario como reservado
    $sqlHora = "UPDATE tb_horariomed SET estado = 1 WHERE id_med = ? AND fecha = ? AND hora = ?";
    $stmtHora = $conn->prepare($sqlHora);
    $stmtHora->bind_param('iss', $id_medico, $fecha_cita, $hora_cita);
    $stmtHora->execute();
    $stmtHora->close();

    echo json_encode(['success' => true, 'message' => 'Cita registrada correctamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al registrar la cita']);
}

$stmt->close();
$conn->close();
?>
