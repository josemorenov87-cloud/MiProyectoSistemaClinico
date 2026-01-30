<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../app/controllers/AuthController.php';
AuthController::checkAuth();
$pageTitle = 'Agendar Citas';
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/sidebar.php';
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2"><div class="col-sm-6"><h1 class="m-0">Agendar Citas</h1></div></div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">

      <div class="nav-buttons mb-3">
        <button id="btn-register" class="btn btn-primary" aria-pressed="true">Registrar</button>
        <button id="btn-calendar" class="btn btn-secondary" aria-pressed="false">Calendario</button>
      </div>

      <div id="view-register">
        <form id="appointment-form" class="card card-body" style="max-width:480px;">
          <h2>Registrar Cita</h2>
          <div class="form-group">
            <label>Paciente</label>
            <input type="text" name="patientName" class="form-control" required />
          </div>
          <div class="form-group">
            <label>Fecha</label>
            <input type="date" name="appointmentDate" class="form-control" required />
          </div>
          <div class="form-group">
            <label>Hora</label>
            <input type="time" name="appointmentTime" class="form-control" required />
          </div>
          <div class="form-group">
            <label>Motivo</label>
            <input type="text" name="appointmentReason" class="form-control" />
          </div>
          <button type="submit" class="btn btn-success">Guardar</button>
        </form>
      </div>

      <div id="view-calendar" style="display:none;">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <button id="prev-month" class="btn btn-outline-primary">Anterior</button>
          <h3 id="calendar-month-year" class="m-0"></h3>
          <button id="next-month" class="btn btn-outline-primary">Siguiente</button>
        </div>
        <div class="calendar-grid" style="display:grid;grid-template-columns:repeat(7,1fr);gap:8px;">
          <div>Lun</div><div>Mar</div><div>Mié</div><div>Jue</div><div>Vie</div><div>Sáb</div><div>Dom</div>
        </div>
      </div>

      <div id="modal-appointment" class="modal" style="display:none;" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Detalle de Cita</h5>
              <button type="button" class="close modal-close"><span>&times;</span></button>
            </div>
            <div class="modal-body">
              <p><strong>Paciente:</strong> <span id="modal-patient"></span></p>
              <p><strong>Fecha:</strong> <span id="modal-date"></span></p>
              <p><strong>Hora:</strong> <span id="modal-time"></span></p>
              <p><strong>Motivo:</strong> <span id="modal-reason"></span></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary modal-close">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<?php $additionalJS = [PUBLIC_URL.'/js/agendarcitas.js']; include __DIR__ . '/../layout/footer.php'; ?>
