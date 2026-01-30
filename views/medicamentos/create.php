<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../app/controllers/AuthController.php';
AuthController::checkAuth();
$pageTitle = 'Registrar Medicamentos';
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/sidebar.php';
?>
<div class="content-wrapper">
  <div class="content-header"><div class="container-fluid"><h1 class="m-3">Registrar Medicamentos</h1></div></div>
  <div class="content"><div class="container-fluid">
    <div class="card card-body">
      <form id="formMedicamentos">
        <div class="row">
          <div class="col-md-6"><label>Nombre</label><input class="form-control" name="nom_medicamento"/></div>
          <div class="col-md-6"><label>Presentación</label><input class="form-control" name="presentacion"/></div>
        </div>
        <div class="row mt-3">
          <div class="col-md-6"><label>Concentración</label><input class="form-control" name="concentracion"/></div>
          <div class="col-md-6"><label>Laboratorio</label><input class="form-control" name="laboratorio"/></div>
        </div>
        <div class="mt-3"><button class="btn btn-primary" type="submit">Guardar</button></div>
      </form>
    </div>
  </div></div>
</div>
<?php include __DIR__ . '/../layout/footer.php'; ?>
