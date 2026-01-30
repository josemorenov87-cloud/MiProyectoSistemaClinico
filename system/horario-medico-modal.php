<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    http_response_code(401);
    echo '<div class="alert alert-danger">No autorizado</div>';
    exit;
}
?>
<!-- Formulario y tabla de horarios -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Registrar Disponibilidad</h3>
    </div>
    <form id="formHorario" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="hora">Hora</label>
                        <input type="time" class="form-control" id="hora" name="hora" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
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
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info">Guardar Disponibilidad</button>
        </div>
    </form>
</div>

<div class="card mt-3">
    <div class="card-header">
        <h3 class="card-title">Mi Disponibilidad</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="bodyHorarios">
            </tbody>
        </table>
    </div>
</div>
