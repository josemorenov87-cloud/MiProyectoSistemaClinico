<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/www.sistemaclinico2.com/app/conexion.php';
$sql = "SELECT id_menu, nombre_menu, url_menu, parent_id FROM tb_menus ORDER BY orden, id_menu";
$res = $conn->query($sql);
$menus = [];
while ($row = $res->fetch_assoc()) {
    $menus[] = $row;
}
echo json_encode($menus);
