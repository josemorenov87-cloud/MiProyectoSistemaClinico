<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../app/controllers/AuthController.php';
AuthController::checkAuth();
$pageTitle = 'Anamnesis';
$additionalCSS = ['https://cdn.tailwindcss.com'];
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/sidebar.php';
?>
<div class="content-wrapper">
  <div class="content-header"><div class="container-fluid"><h1 class="m-3">Anamnesis</h1></div></div>
  <div class="content"><div class="container-fluid">
    <p>Formulario de Anamnesis (migrado - completar campos específicos).</p>
  </div></div>
</div>
<?php include __DIR__ . '/../layout/footer.php'; ?>
