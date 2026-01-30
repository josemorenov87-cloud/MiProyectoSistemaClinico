<?php
require_once __DIR__ . '/../app/conexion.php';
header('Content-Type: application/json');
$id_grpexam = isset($_GET['id_grpexam']) ? intval($_GET['id_grpexam']) : 0;
if ($id_grpexam > 0) {
  $stmt = $conn->prepare('SELECT id_tipexam, nom_tipexam FROM tb_tipexam WHERE cod_grpexam = ? ORDER BY nom_tipexam');
  $stmt->bind_param('i', $id_grpexam);
  $stmt->execute();
  $result = $stmt->get_result();
  $data = [];
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
  echo json_encode(['success'=>true, 'data'=>$data]);
} else {
  echo json_encode(['success'=>false, 'data'=>[]]);
}
