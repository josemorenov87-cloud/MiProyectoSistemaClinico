<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../../app/conexion.php';

$sql = "
SELECT 
  m.id_medico,
  m.nom_medico,
  m.apepat_medico,
  m.sex_medico,
  GROUP_CONCAT(e.desc_especialidad SEPARATOR ', ') as especialidades
FROM tb_medicos m
LEFT JOIN tb_medico_especialidad me ON m.id_medico = me.id_medico
LEFT JOIN tb_especialidades e ON me.id_especialidad = e.id_especialidad
WHERE m.status_medico = 1
GROUP BY m.id_medico
ORDER BY m.nom_medico
";

$result = $conn->query($sql);

$medicos = [];
while ($row = $result->fetch_assoc()) {
    $medicos[] = $row;
}

echo json_encode($medicos);

$conn->close();
?>
