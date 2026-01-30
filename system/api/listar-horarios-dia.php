<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../../app/conexion.php';

if (!isset($_SESSION['id_usuario'])) {
  echo json_encode(['success' => false, 'mensaje' => 'No autenticado']);
  exit;
}

$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : null;
if (!$fecha) {
  echo json_encode(['success' => false, 'mensaje' => 'Fecha requerida']);
  exit;
}

$idUsuario = $_SESSION['id_usuario'];

// Obtener id_med del usuario
$sqlMed = "SELECT id_med FROM tb_medicos WHERE usuario_med = ? LIMIT 1";
$stmtMed = $conn->prepare($sqlMed);
$stmtMed->bind_param('i', $idUsuario);
$stmtMed->execute();
$resultMed = $stmtMed->get_result();
if ($resultMed->num_rows === 0) {
  echo json_encode(['success' => false, 'mensaje' => 'Médico no encontrado']);
  exit;
}
$idMed = $resultMed->fetch_assoc()['id_med'];

$sql = "SELECT id_horariomed, fecha, hora, hora_fin, estado FROM tb_horariomed WHERE id_med = ? AND fecha = ? ORDER BY hora";
$stmt = $conn->prepare($sql);
$stmt->bind_param('is', $idMed, $fecha);
$stmt->execute();
$res = $stmt->get_result();

$horarios = [];
while ($row = $res->fetch_assoc()) {
  $horarios[] = $row;
}

echo json_encode(['success' => true, 'horarios' => $horarios]);
