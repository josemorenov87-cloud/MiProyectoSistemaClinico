<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../../app/conexion.php';

$id_medico = $_POST['id_medico'] ?? 0;
$start = $_POST['start'] ?? '';
$end = $_POST['end'] ?? '';

if (!$id_medico || !$start || !$end) {
    echo json_encode([]);
    exit;
}

// Traer todos los horarios disponibles del mes para el médico
$sql = "SELECT fecha, hora FROM tb_horariomed WHERE id_med = ? AND fecha BETWEEN ? AND ? AND estado = 1 ORDER BY fecha, hora";
$stmt = $conn->prepare($sql);
$stmt->bind_param('iss', $id_medico, $start, $end);
$stmt->execute();
$result = $stmt->get_result();

$fechas = [];
while ($row = $result->fetch_assoc()) {
    $fechas[$row['fecha']][] = $row;
}

echo json_encode($fechas);

$stmt->close();
$conn->close();
