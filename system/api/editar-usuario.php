<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../../app/conexion.php';

$dni_user = $_POST['dni_user'] ?? '';
$user_user = $_POST['user_user'] ?? '';
$name_user = $_POST['name_user'] ?? '';
$email_user = $_POST['email_user'] ?? '';
$pass_user = $_POST['pass_user'] ?? '';

if (empty($dni_user) || empty($user_user) || empty($name_user) || empty($email_user)) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos requeridos']);
    exit;
}

// Si se proporciona nueva contraseña, actualizar
if (!empty($pass_user)) {
    // TODO: Implementar hash de contraseña
    // $pass_user = password_hash($pass_user, PASSWORD_BCRYPT);
    $sql = "UPDATE tb_users SET username = ?, name_user = ?, email_user = ?, pass_user = ? WHERE dni_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssss', $user_user, $name_user, $email_user, $pass_user, $dni_user);
} else {
    // No actualizar contraseña
    $sql = "UPDATE tb_users SET username = ?, name_user = ?, email_user = ? WHERE dni_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $user_user, $name_user, $email_user, $dni_user);
}

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Usuario actualizado correctamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar usuario: ' . $conn->error]);
}

$stmt->close();
$conn->close();
?>
