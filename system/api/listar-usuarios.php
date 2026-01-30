<?php
session_start();
require_once __DIR__ . '/../../app/conexion.php';
header('Content-Type: application/json');

// Asegurar tablas necesarias
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS tb_user_roles (
  dni_user VARCHAR(20) NOT NULL,
  id_rol INT NOT NULL,
  PRIMARY KEY (dni_user, id_rol)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

$sql = "SELECT 
  u.dni_user, u.username as user_user, u.name_user, u.email_user,
  GROUP_CONCAT(DISTINCT r.nom_rol ORDER BY r.nom_rol SEPARATOR ', ') AS roles,
  GROUP_CONCAT(DISTINCT r.id_rol ORDER BY r.nom_rol SEPARATOR ',') AS roles_ids
FROM tb_users u
LEFT JOIN tb_user_roles ur ON ur.dni_user = u.dni_user
LEFT JOIN tb_roles r ON r.id_rol = ur.id_rol
LEFT JOIN tb_roles rp ON rp.id_rol = u.rol_user
GROUP BY u.dni_user, u.username, u.name_user, u.email_user";

$res = mysqli_query($conn, $sql);
$usuarios = [];
if ($res) {
  while ($row = mysqli_fetch_assoc($res)) {
    $usuarios[] = $row;
  }
}
echo json_encode($usuarios);
?>
