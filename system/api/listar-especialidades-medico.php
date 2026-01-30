<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../../app/conexion.php';

$id_medico = $_POST['id_medico'] ?? 0;

if (!$id_medico) {
    echo json_encode([]);
    exit;
}

// Obtener especialidades del médico
$sql = "
SELECT e.id_especialidad, e.desc_especialidad, me.id_rel
FROM tb_especialidades e
LEFT JOIN tb_medico_especialidad me ON e.id_especialidad = me.id_especialidad AND me.id_medico = ?
ORDER BY e.desc_especialidad
";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id_medico);
$stmt->execute();
$result = $stmt->get_result();

$especialidades = [];
while ($row = $result->fetch_assoc()) {
    $especialidades[] = [
        'id_especialidad' => $row['id_especialidad'],
        'desc_especialidad' => $row['desc_especialidad'],
        'asignada' => !is_null($row['id_rel'])
    ];
}

echo json_encode($especialidades);

$stmt->close();
$conn->close();
?>
