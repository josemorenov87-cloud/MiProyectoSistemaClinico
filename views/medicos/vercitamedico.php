<?php
$pageTitle = 'Citas del Médico';
$additionalCSS = [
    PUBLIC_URL . '/plugins/fullcalendar/main.min.css',
];
$additionalJS = [
    PUBLIC_URL . '/plugins/fullcalendar/main.min.js',
    PUBLIC_URL . '/plugins/fullcalendar/locales-all.min.js',
    PUBLIC_URL . '/plugins/sweetalert2/sweetalert2.min.js',
    PUBLIC_URL . '/js/ver-cita-medico.js',
];
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../../system/includes/sidebar.php';
?>

<script>
    const BASE_URL = '<?php echo BASE_URL; ?>';
</script>

<style>
    .fc-time-only-wrapper { text-align: center; }
    .fc-time-only {
        display: inline-block;
        background: #28a745;
        color: #fff;
        padding: 4px 12px;
        border-radius: 999px;
        font-weight: 600;
    }
</style>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Calendario de Citas</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Mis citas programadas</h3>
                        </div>
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCitas" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Citas del <span id="modalFecha"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="alertSinCitas" class="alert alert-info d-none">No hay citas registradas para este día.</div>
                <div id="citasList"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDetalleCita" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalle de la cita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-2"><strong>Paciente:</strong> <span id="detallePaciente"></span></div>
                <div class="mb-2"><strong>DNI:</strong> <span id="detalleDni"></span></div>
                <div class="mb-2"><strong>Especialidad:</strong> <span id="detalleEspecialidad"></span></div>
                <div class="mb-2"><strong>Fecha:</strong> <span id="detalleFecha"></span></div>
                <div class="mb-2"><strong>Hora:</strong> <span id="detalleHora"></span></div>
                <div class="mb-2"><strong>Motivo:</strong> <span id="detalleMotivo"></span></div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <a id="btnIrAtencion" class="btn btn-primary" href="#">Ir a Atención Médica</a>
            </div>
        </div>
    </div>
    </div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
