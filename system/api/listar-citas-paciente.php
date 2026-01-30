<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../../app/conexion.php';

$dni = $_POST['dni'] ?? '';

if (empty($dni)) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT c.id_cita, c.fecha_cita, c.hora_cita, c.motivo_cita, c.id_medico, c.id_especialidad, e.desc_especialidad FROM tb_citas c LEFT JOIN tb_especialidades e ON c.id_especialidad = e.id_especialidad WHERE c.numdoc_paciente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $dni);
$stmt->execute();
$result = $stmt->get_result();

$citas = [];
while ($row = $result->fetch_assoc()) {
    $citas[] = $row;
}

echo json_encode($citas);

$stmt->close();
$conn->close();
?>
