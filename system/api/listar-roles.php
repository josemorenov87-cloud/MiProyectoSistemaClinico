<?php
session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../../app/conexion.php';

$roles = [];
$sql = "SELECT id_rol, nom_rol FROM tb_roles ORDER BY nom_rol";
if ($res = $conn->query($sql)) {
  while ($row = $res->fetch_assoc()) { $roles[] = $row; }
}

echo json_encode(['success' => true, 'roles' => $roles]);
