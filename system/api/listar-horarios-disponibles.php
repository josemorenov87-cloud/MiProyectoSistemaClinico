<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../../app/conexion.php';

$id_medico = $_POST['id_medico'] ?? 0;
$fecha = $_POST['fecha'] ?? '';

if (!$id_medico || !$fecha) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT hora FROM tb_horariomed WHERE id_med = ? AND fecha = ? AND estado = 1 ORDER BY hora";
$stmt = $conn->prepare($sql);
$stmt->bind_param('is', $id_medico, $fecha);
$stmt->execute();
$result = $stmt->get_result();

$horarios = [];
while ($row = $result->fetch_assoc()) {
    $horarios[] = $row;
}

echo json_encode($horarios);

$stmt->close();
$conn->close();
?>
