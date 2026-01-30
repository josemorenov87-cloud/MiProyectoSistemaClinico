<?php
// system/save_edited_image.php
// Guarda la imagen editada enviada desde el editor (base64 PNG) en el servidor y retorna la URL
header('Content-Type: application/json');

$imgType = isset($_POST['imgType']) ? $_POST['imgType'] : '';
$imgData = isset($_POST['imgData']) ? $_POST['imgData'] : '';

if (!$imgType || !$imgData) {
    echo json_encode(['success' => false, 'msg' => 'Datos incompletos']);
    exit;
}

$imgData = preg_replace('#^data:image/\w+;base64,#i', '', $imgData);
$imgData = str_replace(' ', '+', $imgData);
$decoded = base64_decode($imgData);
if ($decoded === false) {
    echo json_encode(['success' => false, 'msg' => 'Base64 inválido']);
    exit;
}

$folder = __DIR__ . '/../img/';
if (!is_dir($folder)) mkdir($folder, 0777, true);
$filename = $imgType === 'utero' ? 'utero_editado.png' : 'cervix_editado.png';
$filepath = $folder . $filename;
if (file_put_contents($filepath, $decoded) !== false) {
    $url = '/www.sistemaclinico2.com/img/' . $filename;
    echo json_encode(['success' => true, 'url' => $url]);
} else {
    echo json_encode(['success' => false, 'msg' => 'No se pudo guardar']);
}
