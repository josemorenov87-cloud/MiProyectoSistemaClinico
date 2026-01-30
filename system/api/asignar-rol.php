<?php
session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../../app/conexion.php';

$dni = isset($_POST['dni_user']) ? trim($_POST['dni_user']) : '';
$idRol = isset($_POST['id_rol']) ? intval($_POST['id_rol']) : 0;

if (empty($dni) || $idRol <= 0) {
  echo json_encode(['success' => false, 'mensaje' => 'Parámetros inválidos']);
  exit;
}

// Verificar existencia del rol
$sqlRol = "SELECT 1 FROM tb_roles WHERE id_rol = ?";
$stRol = $conn->prepare($sqlRol);
$stRol->bind_param('i', $idRol);
$stRol->execute();
$resRol = $stRol->get_result();
if ($resRol->num_rows === 0) {
  echo json_encode(['success' => false, 'mensaje' => 'Rol no existe']);
  exit;
}

// Actualizar rol del usuario
$sqlUpd = "UPDATE tb_users SET rol_user = ? WHERE dni_user = ?";
$stUpd = $conn->prepare($sqlUpd);
$stUpd->bind_param('is', $idRol, $dni);
if ($stUpd->execute()) {
  echo json_encode(['success' => true]);
} else {
  echo json_encode(['success' => false, 'mensaje' => 'Error al actualizar']);
}
