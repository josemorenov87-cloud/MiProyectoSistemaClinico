<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../../app/conexion.php';

$sql = "SELECT id_especialidad, desc_especialidad FROM tb_especialidades ORDER BY desc_especialidad";
$result = $conn->query($sql);

$especialidades = [];
while ($row = $result->fetch_assoc()) {
    $especialidades[] = $row;
}

echo json_encode($especialidades);

$conn->close();
?>
