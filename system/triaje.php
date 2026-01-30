<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
use App\Controllers\AuthController;
AuthController::checkAuth();
$pageTitle = 'Triaje';
include __DIR__ . '/../views/layout/header.php';
include __DIR__ . '/../system/includes/sidebar.php';
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Triaje</h1>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-8">
          <div class="card card-primary">
            <div class="card-header">
              <h2 class="card-title text-lg font-semibold">Registro de Atención</h2>
            </div>
            <div class="card-body">
              <h2 class="section-title text-lg font-semibold p-2 mb-3">Datos del Paciente</h2>
              <form>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Paciente</label>
                      <input type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Historia Clinica</label>
                      <input type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Edad</label>
                      <input type="text" class="form-control" disabled>
                    </div>
                  </div>
                </div>
                <h2 class="section-title text-lg font-semibold p-2 mb-3">Signos Vitales</h2>
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Temperatura (°C)</label>
                      <input type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Presión Arterial (mmHg)</label>
                      <input type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>SpO2 (%)</label>
                      <input type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Pulso (lpm)</label>
                      <input type="text" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Talla (cm)</label>
                      <input type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Peso (kg)</label>
                      <input type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>IMC</label>
                      <input type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Interpretación IMC</label>
                      <input type="text" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Maniobras realizadas en el Examen</label>
                      <textarea class="form-control" rows="3"></textarea>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-info">Guardar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$additionalJS = [
  PUBLIC_URL . '/plugins/bootstrap/js/bootstrap.bundle.min.js',
];
include __DIR__ . '/../views/layout/footer.php';
?>