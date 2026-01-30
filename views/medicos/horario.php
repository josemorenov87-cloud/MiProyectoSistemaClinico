<?php
$pageTitle = 'Horario del Médico';
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../../system/includes/sidebar.php';
?>

<script>
    const BASE_URL = '<?php echo BASE_URL; ?>';
</script>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Horario del Médico</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- Formulario y tabla de horarios -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Registrar Disponibilidad</h3>
                        </div>
                        <form id="formHorario" method="POST" action="<?php echo BASE_URL; ?>/guardar-horario-medico">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="fecha">Fecha de Disponibilidad</label>
                                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="hora">Hora Inicio</label>
                                            <input type="time" class="form-control" id="hora" name="hora" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="hora_fin">Hora Fin</label>
                                            <input type="time" class="form-control" id="hora_fin" name="hora_fin" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="estado">Estado</label>
                                            <select class="form-control" id="estado" name="estado" required>
                                                <option value="">-- Seleccionar --</option>
                                                <option value="1">Activo</option>
                                                <option value="0">Inactivo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-info btn-block">Guardar Disponibilidad</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Mi Disponibilidad</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Hora Inicio</th>
                                        <th>Hora Fin</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="bodyHorarios">
                                </tbody>
                            </table>
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
    PUBLIC_URL . '/plugins/sweetalert2/sweetalert2.min.js',
    PUBLIC_URL . '/js/horario-medico.js',
];
include __DIR__ . '/../layout/footer.php';
?>

