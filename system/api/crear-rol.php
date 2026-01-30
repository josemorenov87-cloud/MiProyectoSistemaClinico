<?php
session_start();
require_once __DIR__ . '/../../app/conexion.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo json_encode(['error' => 'Método no permitido']);
  exit;
}

$nom_rol = isset($_POST['nom_rol']) ? trim($_POST['nom_rol']) : '';
if ($nom_rol === '') {
  http_response_code(400);
  echo json_encode(['error' => 'Nombre de rol requerido']);
  exit;
}

// Crear tabla de roles si no existe
$createSql = "CREATE TABLE IF NOT EXISTS tb_roles (
  id_rol INT AUTO_INCREMENT PRIMARY KEY,
  nom_rol VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
mysqli_query($conn, $createSql);

// Validar duplicado
$stmt = mysqli_prepare($conn, "SELECT id_rol FROM tb_roles WHERE nom_rol = ?");
mysqli_stmt_bind_param($stmt, 's', $nom_rol);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
if (mysqli_stmt_num_rows($stmt) > 0) {
  http_response_code(409);
  echo json_encode(['error' => 'El rol ya existe']);
  exit;
}
mysqli_stmt_close($stmt);

// Insertar
$ins = mysqli_prepare($conn, "INSERT INTO tb_roles (nom_rol) VALUES (?)");
mysqli_stmt_bind_param($ins, 's', $nom_rol);
mysqli_stmt_execute($ins);
$id = mysqli_insert_id($conn);
mysqli_stmt_close($ins);

echo json_encode(['ok' => true, 'id_rol' => $id]);
