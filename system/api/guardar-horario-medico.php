<?php
session_start();
header('Content-Type: application/json');

require_once 'conexion.php';

if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(['success' => false, 'mensaje' => 'No autorizado']);
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

// Validar datos
$fecha = isset($_POST['fecha']) ? trim($_POST['fecha']) : '';
$hora = isset($_POST['hora']) ? trim($_POST['hora']) : '';
$estado = isset($_POST['estado']) ? intval($_POST['estado']) : 0;

if (empty($fecha) || empty($hora)) {
    echo json_encode(['success' => false, 'mensaje' => 'Fecha y hora requeridas']);
    exit;
}

// Insertar horario
$query = "INSERT INTO tb_horariomed (id_med, fecha, hora, estado) VALUES (?, ?, ?, ?)";
$stmt = $conexion->prepare($query);
$stmt->bind_param("issi", $id_medico, $fecha, $hora, $estado);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'mensaje' => 'Guardado exitosamente']);
} else {
    echo json_encode(['success' => false, 'mensaje' => 'Error al guardar']);
}
