<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../../app/conexion.php';

$id_especialidad = $_POST['id_especialidad'] ?? 0;

if (!$id_especialidad) {
    echo json_encode([]);
    exit;
}

// Obtener médicos asociados a la especialidad mediante la tabla intermedia
$sql = "
SELECT m.id_medico, m.nom_medico, m.apepat_medico, m.sex_medico 
FROM tb_medicos m
INNER JOIN tb_medico_especialidad me ON m.id_medico = me.id_medico
WHERE me.id_especialidad = ? AND m.status_medico = 1
ORDER BY m.nom_medico
";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id_especialidad);
$stmt->execute();
$result = $stmt->get_result();

$medicos = [];
while ($row = $result->fetch_assoc()) {
    $medicos[] = $row;
}

echo json_encode($medicos);

$stmt->close();
$conn->close();
?>
