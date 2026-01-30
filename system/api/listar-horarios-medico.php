<?php
session_start();
header('Content-Type: application/json');

require_once dirname(__DIR__) . '/conexion.php';

if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(['success' => false, 'horarios' => []]);
    exit;
}

// Obtener ID del médico
$id_usuario = $_SESSION['id_usuario'];
$query = "SELECT id_med FROM tb_medicos WHERE usuario_med = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo json_encode(['success' => false, 'horarios' => []]);
    exit;
}

$row = $resultado->fetch_assoc();
$id_medico = $row['id_med'];

// Obtener horarios del médico
$query = "SELECT id_horariomed, fecha, hora, estado FROM tb_horariomed WHERE id_med = ? ORDER BY fecha ASC, hora ASC";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id_medico);
$stmt->execute();
$resultado = $stmt->get_result();

$horarios = [];
while ($row = $resultado->fetch_assoc()) {
    $horarios[] = $row;
}

echo json_encode(['success' => true, 'horarios' => $horarios]);
