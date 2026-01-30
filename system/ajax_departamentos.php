<?php
require_once '../app/conexion.php';
$conn = conectar();
$sql = "SELECT id_depart, nom_depart FROM tb_departamento ORDER BY nom_depart";
$result = $conn->query($sql);
echo '<option value="">Seleccione Departamento</option>';
while ($row = $result->fetch_assoc()) {
    echo '<option value="' . $row['id_depart'] . '">' . htmlspecialchars($row['nom_depart']) . '</option>';
}
$conn->close();
