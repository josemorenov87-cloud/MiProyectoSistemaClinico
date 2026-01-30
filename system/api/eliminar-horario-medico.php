<?php
session_start();
header('Content-Type: application/json');

require_once dirname(__DIR__) . '/conexion.php';

if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(['success' => false, 'mensaje' => 'No autorizado']);
    exit;
}

$id_horario = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($id_horario <= 0) {
    echo json_encode(['success' => false, 'mensaje' => 'ID inválido']);
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
    echo json_encode(['success' => false, 'mensaje' => 'Médico no encontrado']);
    exit;
}

$row = $resultado->fetch_assoc();
$id_medico = $row['id_med'];

// Verificar que el horario pertenezca al médico
$query = "SELECT id_med FROM tb_horariomed WHERE id_horariomed = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id_horario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo json_encode(['success' => false, 'mensaje' => 'Horario no encontrado']);
    exit;
}

$row = $resultado->fetch_assoc();
if ($row['id_med'] != $id_medico) {
    echo json_encode(['success' => false, 'mensaje' => 'No tienes permiso']);
    exit;
}

// Eliminar
$query = "DELETE FROM tb_horariomed WHERE id_horariomed = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id_horario);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'mensaje' => 'Eliminado']);
} else {
    echo json_encode(['success' => false, 'mensaje' => 'Error al eliminar']);
}
