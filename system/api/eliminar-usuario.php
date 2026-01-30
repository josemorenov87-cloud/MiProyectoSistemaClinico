<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../../app/conexion.php';

$dni_user = $_POST['dni_user'] ?? '';

if (empty($dni_user)) {
    echo json_encode(['success' => false, 'message' => 'DNI requerido']);
    exit;
}

// Eliminar relaciones de roles primero
$sql_roles = "DELETE FROM tb_user_roles WHERE dni_user = ?";
$stmt_roles = $conn->prepare($sql_roles);
$stmt_roles->bind_param('s', $dni_user);
$stmt_roles->execute();
$stmt_roles->close();

// Eliminar usuario
$sql = "DELETE FROM tb_users WHERE dni_user = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $dni_user);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Usuario eliminado correctamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al eliminar usuario: ' . $conn->error]);
}

$stmt->close();
$conn->close();
?>
