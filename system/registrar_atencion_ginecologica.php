<?php
// Nuevo endpoint: Llama al controller de Ginecología (MVC)
require_once __DIR__ . '/../app/controllers/AtencionGinecologicaController.php';
require_once __DIR__ . '/../app/conexion.php';
header('Content-Type: application/json');

$controller = new \App\Controllers\AtencionGinecologicaController($conn);
$data = $_POST;
// Si algún campo es JSON, decodificarlo
if (isset($data['diagnosticos']) && is_string($data['diagnosticos'])) {
    $data['diagnosticos'] = json_decode($data['diagnosticos'], true);
}
if (isset($data['tratamientos']) && is_string($data['tratamientos'])) {
    $data['tratamientos'] = json_decode($data['tratamientos'], true);
}
if (isset($data['examenes']) && is_string($data['examenes'])) {
    $data['examenes'] = json_decode($data['examenes'], true);
}
$ok = $controller->registrarAtencion($data);
echo json_encode(['success' => $ok]);
