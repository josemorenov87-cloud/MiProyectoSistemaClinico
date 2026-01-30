<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../../app/conexion.php';

if (!isset($_SESSION['id_usuario'])) {
  echo json_encode(['success' => false, 'mensaje' => 'No autenticado']);
  exit;
}

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$hora = isset($_POST['hora']) ? $_POST['hora'] : null;
$hora_fin = isset($_POST['hora_fin']) ? $_POST['hora_fin'] : null;

if ($id <= 0 || !$hora || !$hora_fin) {
  echo json_encode(['success' => false, 'mensaje' => 'Parámetros inválidos']);
  exit;
}

if ($hora >= $hora_fin) {
  echo json_encode(['success' => false, 'mensaje' => 'La hora fin debe ser mayor que la hora de inicio']);
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

// Validar propiedad del registro
$sqlCheck = "SELECT id_med FROM tb_horariomed WHERE id_horariomed = ? LIMIT 1";
$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->bind_param('i', $id);
$stmtCheck->execute();
$resCheck = $stmtCheck->get_result();
if ($resCheck->num_rows === 0) {
  echo json_encode(['success' => false, 'mensaje' => 'Registro no encontrado']);
  exit;
}
$rowCheck = $resCheck->fetch_assoc();
if (intval($rowCheck['id_med']) !== intval($idMed)) {
  echo json_encode(['success' => false, 'mensaje' => 'No autorizado']);
  exit;
}

// Obtener fecha del registro para validar solapamientos
$sqlFecha = "SELECT fecha FROM tb_horariomed WHERE id_horariomed = ?";
$stmtFecha = $conn->prepare($sqlFecha);
$stmtFecha->bind_param('i', $id);
$stmtFecha->execute();
$resFecha = $stmtFecha->get_result();
if ($resFecha->num_rows === 0) {
  echo json_encode(['success' => false, 'mensaje' => 'Registro no encontrado']);
  exit;
}
$fecha = $resFecha->fetch_assoc()['fecha'];

// Validar solapamientos (excluyendo el propio id)
$sqlExist = "SELECT hora, hora_fin FROM tb_horariomed WHERE id_med = ? AND fecha = ? AND id_horariomed <> ?";
$stmtExist = $conn->prepare($sqlExist);
$stmtExist->bind_param('isi', $idMed, $fecha, $id);
$stmtExist->execute();
$resExist = $stmtExist->get_result();
while ($row = $resExist->fetch_assoc()) {
  $s = $row['hora'];
  $e = $row['hora_fin'];
  if ($hora < $e && $s < $hora_fin) {
    echo json_encode(['success' => false, 'mensaje' => 'El rango se solapa con uno existente']);
    exit;
  }
}

// Actualizar hora y hora_fin
$sqlUpd = "UPDATE tb_horariomed SET hora = ?, hora_fin = ? WHERE id_horariomed = ?";
$stmtUpd = $conn->prepare($sqlUpd);
$stmtUpd->bind_param('ssi', $hora, $hora_fin, $id);
if ($stmtUpd->execute()) {
  echo json_encode(['success' => true]);
} else {
  echo json_encode(['success' => false, 'mensaje' => 'Error al actualizar']);
}
