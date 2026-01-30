<?php
require_once '../app/conexion.php';
$conn = conectar();
$sql = "SELECT id_especialidad, desc_especialidad FROM tb_especialidades ORDER BY desc_especialidad";
$result = $conn->query($sql);
echo '<option value="">Seleccione Especialidad</option>';
while ($row = $result->fetch_assoc()) {
    echo '<option value="' . $row['id_especialidad'] . '">' . htmlspecialchars($row['desc_especialidad']) . '</option>';
}
$conn->close();
