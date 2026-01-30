<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../../app/conexion.php';

$id_medico = $_POST['id_medico'] ?? 0;
$id_especialidad = $_POST['id_especialidad'] ?? 0;
$accion = $_POST['accion'] ?? ''; // 'asignar' o 'desasignar'

if (!$id_medico || !$id_especialidad || !$accion) {
    echo json_encode(['success' => false, 'message' => 'Parámetros incompletos']);
    exit;
}

if ($accion === 'asignar') {
    $sql = "INSERT IGNORE INTO tb_medico_especialidad (id_medico, id_especialidad) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $id_medico, $id_especialidad);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Especialidad asignada']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al asignar']);
    }
    $stmt->close();
} 
elseif ($accion === 'desasignar') {
    $sql = "DELETE FROM tb_medico_especialidad WHERE id_medico = ? AND id_especialidad = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $id_medico, $id_especialidad);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Especialidad desasignada']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al desasignar']);
    }
    $stmt->close();
}

$conn->close();
?>
