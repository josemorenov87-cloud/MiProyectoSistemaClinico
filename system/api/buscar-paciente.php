<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../../app/conexion.php';

$dni = $_POST['dni'] ?? '';

if (empty($dni)) {
    echo json_encode(['success' => false, 'message' => 'DNI requerido']);
    exit;
}

$sql = "SELECT id_paciente, nom_paciente, apepat_paciente, apemat_paciente, numdoc_paciente FROM tb_pacientes WHERE numdoc_paciente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $dni);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $paciente = $result->fetch_assoc();
    echo json_encode(['success' => true, 'paciente' => $paciente]);
} else {
    echo json_encode(['success' => false, 'message' => 'Paciente no encontrado']);
}

$stmt->close();
$conn->close();
?>
