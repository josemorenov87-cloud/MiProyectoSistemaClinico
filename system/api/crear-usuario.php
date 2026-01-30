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
$user_user = isset($_POST['user_user']) ? trim($_POST['user_user']) : '';
$name_user = isset($_POST['name_user']) ? trim($_POST['name_user']) : '';
$email_user = isset($_POST['email_user']) ? trim($_POST['email_user']) : '';
$pass_user = isset($_POST['pass_user']) ? $_POST['pass_user'] : '';
$id_rol = isset($_POST['id_rol']) ? intval($_POST['id_rol']) : 0;

if ($dni_user === '' || $user_user === '' || $name_user === '' || $email_user === '' || $pass_user === '' || $id_rol === 0) {
  http_response_code(400);
  echo json_encode(['error' => 'Campos requeridos faltantes']);
  exit;
}

// Crear tabla de usuarios si no existe (campos mínimos)
$createSql = "CREATE TABLE IF NOT EXISTS tb_users (
  dni_user VARCHAR(20) PRIMARY KEY,
  username VARCHAR(100) NOT NULL,
  name_user VARCHAR(150) NOT NULL,
  email_user VARCHAR(150) NOT NULL,
  pass_user VARCHAR(255) NOT NULL,
  rol_user INT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
mysqli_query($conn, $createSql);

// Verificar duplicado por DNI
$stmt = mysqli_prepare($conn, "SELECT dni_user FROM tb_users WHERE dni_user = ?");
mysqli_stmt_bind_param($stmt, 's', $dni_user);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
if (mysqli_stmt_num_rows($stmt) > 0) {
  http_response_code(409);
  echo json_encode(['error' => 'El DNI ya existe']);
  exit;
}
mysqli_stmt_close($stmt);

// Insertar usuario con rol_user asignado
$ins = mysqli_prepare($conn, "INSERT INTO tb_users (dni_user, username, name_user, email_user, pass_user, rol_user) VALUES (?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($ins, 'sssssi', $dni_user, $user_user, $name_user, $email_user, $pass_user, $id_rol);
mysqli_stmt_execute($ins);
mysqli_stmt_close($ins);

// Asegurar tabla de mapeo de roles
$mapSql = "CREATE TABLE IF NOT EXISTS tb_user_roles (
  dni_user VARCHAR(20) NOT NULL,
  id_rol INT NOT NULL,
  PRIMARY KEY (dni_user, id_rol)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
mysqli_query($conn, $mapSql);

// Asignar rol en tb_user_roles
$insR = mysqli_prepare($conn, "INSERT INTO tb_user_roles (dni_user, id_rol) VALUES (?, ?)");
mysqli_stmt_bind_param($insR, 'si', $dni_user, $id_rol);
mysqli_stmt_execute($insR);
mysqli_stmt_close($insR);

echo json_encode(['ok' => true]);
