<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../../app/conexion.php';

if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(['success' => false, 'mensaje' => 'No autorizado']);
    exit;
}

// Obtener ID del médico
$id_usuario = $_SESSION['id_usuario'];
$query = "SELECT id_med FROM tb_medicos WHERE usuario_med = ?";
$stmt = $conn->prepare($query);
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
$hora_fin = isset($_POST['hora_fin']) ? trim($_POST['hora_fin']) : '';
$estado = isset($_POST['estado']) ? intval($_POST['estado']) : 1;

if (empty($fecha) || empty($hora) || empty($hora_fin)) {
    echo json_encode(['success' => false, 'mensaje' => 'Fecha, hora inicio y hora fin requeridas']);
    exit;
}

if ($hora >= $hora_fin) {
    echo json_encode(['success' => false, 'mensaje' => 'La hora fin debe ser mayor que la hora de inicio']);
    exit;
}

// Validar solapamientos en la misma fecha
$sqlExist = "SELECT hora, hora_fin FROM tb_horariomed WHERE id_med = ? AND fecha = ?";
$stmtExist = $conn->prepare($sqlExist);
$stmtExist->bind_param('is', $id_medico, $fecha);
$stmtExist->execute();
$resExist = $stmtExist->get_result();
while ($row = $resExist->fetch_assoc()) {
    $s = $row['hora'];
    $e = $row['hora_fin'];
    if ($hora < $e && $s < $hora_fin) {
        echo json_encode(['success' => false, 'mensaje' => 'El rango se solapa con uno existente']);
        exit;
    }
}

// Insertar horario con hora_fin
$query = "INSERT INTO tb_horariomed (id_med, fecha, hora, hora_fin, estado) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("isssi", $id_medico, $fecha, $hora, $hora_fin, $estado);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'mensaje' => 'Guardado exitosamente']);
} else {
    echo json_encode(['success' => false, 'mensaje' => 'Error: ' . $stmt->error]);
}
