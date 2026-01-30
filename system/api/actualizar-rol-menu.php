<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/www.sistemaclinico2.com/app/conexion.php';
$id_rol = intval($_POST['id_rol']);
$id_menu = intval($_POST['id_menu']);
$acceso = intval($_POST['acceso']);
if ($acceso) {
    $sql = "INSERT IGNORE INTO tb_roles_menus (id_rol, id_menu) VALUES ($id_rol, $id_menu)";
    $conn->query($sql);
    echo json_encode(['ok' => true, 'accion' => 'agregado']);
} else {
    $sql = "DELETE FROM tb_roles_menus WHERE id_rol = $id_rol AND id_menu = $id_menu";
    $conn->query($sql);
    echo json_encode(['ok' => true, 'accion' => 'eliminado']);
}
