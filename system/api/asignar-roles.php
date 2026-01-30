<?php
session_start();
require_once __DIR__ . '/../../app/conexion.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo json_encode(['error' => 'Método no permitido']);
  exit;
}

$dni_user = isset($_POST['dni_user']) ? trim($_POST['dni_user']) : '';
$id_roles = isset($_POST['id_roles']) ? $_POST['id_roles'] : [];

if ($dni_user === '' || !is_array($id_roles)) {
  http_response_code(400);
  echo json_encode(['error' => 'Parámetros inválidos']);
  exit;
}

// Asegurar existencia de tabla de mapeo
$createSql = "CREATE TABLE IF NOT EXISTS tb_user_roles (
  dni_user VARCHAR(20) NOT NULL,
  id_rol INT NOT NULL,
  PRIMARY KEY (dni_user, id_rol)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
mysqli_query($conn, $createSql);

// Verificar existencia de usuario
$stmt = mysqli_prepare($conn, "SELECT dni_user FROM tb_users WHERE dni_user = ?");
mysqli_stmt_bind_param($stmt, 's', $dni_user);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
if (mysqli_stmt_num_rows($stmt) === 0) {
  http_response_code(404);
  echo json_encode(['error' => 'Usuario no encontrado']);
  exit;
}
mysqli_stmt_close($stmt);

// Limpiar roles actuales
$del = mysqli_prepare($conn, "DELETE FROM tb_user_roles WHERE dni_user = ?");
mysqli_stmt_bind_param($del, 's', $dni_user);
mysqli_stmt_execute($del);
mysqli_stmt_close($del);

// Insertar nuevos roles
$ins = mysqli_prepare($conn, "INSERT INTO tb_user_roles (dni_user, id_rol) VALUES (?, ?)");
foreach ($id_roles as $id_rol) {
  if (!is_numeric($id_rol)) { continue; }
  $id_rol = intval($id_rol);
  mysqli_stmt_bind_param($ins, 'si', $dni_user, $id_rol);
  mysqli_stmt_execute($ins);
}
mysqli_stmt_close($ins);

// Sincronizar rol principal para compatibilidad (tomar el primero si existe)
$rol_principal = null;
if (count($id_roles) > 0) {
  foreach ($id_roles as $id_rol) { if (is_numeric($id_rol)) { $rol_principal = intval($id_rol); break; } }
}
if ($rol_principal !== null) {
  $upd = mysqli_prepare($conn, "UPDATE tb_users SET rol_user = ? WHERE dni_user = ?");
  mysqli_stmt_bind_param($upd, 'is', $rol_principal, $dni_user);
  mysqli_stmt_execute($upd);
  mysqli_stmt_close($upd);
}

echo json_encode(['ok' => true]);
