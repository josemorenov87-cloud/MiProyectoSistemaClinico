<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/www.sistemaclinico2.com/app/conexion.php';
$id_rol = isset($_GET['id_rol']) ? intval($_GET['id_rol']) : 0;
$sql = "SELECT id_menu FROM tb_roles_menus WHERE id_rol = $id_rol";
$res = $conn->query($sql);
$permisos = [];
while ($row = $res->fetch_assoc()) {
    $permisos[] = $row['id_menu'];
}
echo json_encode($permisos);
