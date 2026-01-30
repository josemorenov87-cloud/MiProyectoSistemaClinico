<?php
/**
 * Vista: Registro de Médicos (migrada)
 */
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/database.php';

require_once __DIR__ . '/../../app/controllers/AuthController.php';
\App\Controllers\AuthController::checkAuth();

$pageTitle = 'Registro de Médicos';
$additionalCSS = [
    'https://cdn.tailwindcss.com'
];
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/sidebar.php';
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema clinico</title>
  <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .required:after {
            content: " *";
            color: red;
        }
        .section-title {
            background-color: #E6F2FF;
            border-left: 4px solid #007bff;
        }
    </style>
  <link rel="icon" href="<?php echo BASE_URL; ?>/public/dist/img/clinica.png" type="image/png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">



  <!-- Main Sidebar Container -->
 <?php include BASE_PATH . '/system/includes/sidebar.php'; ?>
  <!-- Contenido Sidebar.php -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Registro de Médicos</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">            
            <div class="card card-primary">            
              <div class="card-header">
              </div>
              <div class="card-body">
                <h2 class="section-title text-lg font-semibold p-2 mb-3">Datos Basicos del Médico</h2>
                <form id="formMedico">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Tipo de Doc. de Identidad</label>
                        <select id="tdoc_medico" name="tdoc_medico" required class="form-control">
                          <option value="0">---SELECCIONAR T.DOC.---</option>
                          <option value="1">CARNET DE EXTRANJERIA</option>
                          <option value="2">DNI</option>
                          <option value="3">PASAPORTE</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Nro.Doc. Identidad</label>
                        <input type="text" class="form-control" id="numdoc_medico" name="numdoc_medico">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Fecha de nacimiento</label>
                        <input type="date" class="form-control" id="fnac_medico" name="fnac_medico">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Nombres</label>
                        <input type="text" class="form-control" id="nom_medico" name="nom_medico">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Apellido Paterno</label>
                        <input type="text" class="form-control" id="apepat_medico" name="apepat_medico">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Apellido Materno</label>
                        <input type="text" class="form-control" id="apemat_medico" name="apemat_medico">
                      </div>
                    </div>                    
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Nacionalidad</label>
                        <input type="text" class="form-control" id="nac_medico" name="nac_medico">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Lugar de Nacimiento</label>
                        <input type="text" class="form-control" id="lnac_medico" name="lnac_medico">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Sexo</label>
                        <select id="sex_medico" name="sex_medico" required class="form-control">
                          <option value="0">SELECCIONAR SEXO</option>
                          <option value="F">FEMENINO</option>
                          <option value="M">MASCULINO</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Correo Electronico</label>
                        <input type="text" class="form-control" id="email_medico" name="email_medico">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Telefono Fijo</label>
                        <input type="text" class="form-control" id="tel_medico" name="tel_medico">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Celular</label>
                        <input type="text" class="form-control" id="cel_medico" name="cel_medico">
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" class="form-control" id="direc_medico" name="direc_medico">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Departamento</label>
                        <select id="depart_medico" name="depart_medico" class="form-control" required>
                          <option value="">Seleccione Departamento</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Provincia</label>
                        <select id="prov_medico" name="prov_medico" class="form-control" required>
                          <option value="">Seleccione Provincia</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Distrito</label>
                        <select id="dist_medico" name="dist_medico" class="form-control" required>
                          <option value="">Seleccione Distrito</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <h2 class="section-title text-lg font-semibold p-2 mb-3">Información Profesional</h2>
                  <div class="row">                    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Especialidad</label>
                        <select id="esp_medico" name="esp_medico" class="form-control" required>
                          <option value="">Seleccione Especialidad</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Tipo de Colegiatura</label>
                        <select id="tcoleg_medico" name="tcoleg_medico" required class="form-control">
                          <option value="">Seleccionar Tp. de colegiatura</option>
                          <option value="1">CMP</option>
                          <option value="2">CPSP</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Nro. de Colegiatura</label>
                        <input type="text" class="form-control" id="numcoleg_medico" name="numcoleg_medico">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Estado de Hab. Colegial</label>
                        <input type="text" class="form-control" id="habcoleg_medico" name="habcoleg_medico">
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-info">Guardar</button>
                    <div id="msgMedico" style="margin-top:10px;"></div>
                  </div>
                </form>
                    <script>
                      function calcularEdad() {
                        var fnEl = document.getElementById('fechaNacimiento');
                        var edadEl = document.getElementById('edad');
                        if (!fnEl || !edadEl) { return; }

                        const fechaNacimiento = new Date(fnEl.value);
                        const hoy = new Date();

                        let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
                        const mes = hoy.getMonth() - fechaNacimiento.getMonth();
                        if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
                          edad--;
                        }

                        edadEl.value = isNaN(edad) ? '' : edad;
                      }

                      document.addEventListener('DOMContentLoaded', function() {
                        const today = new Date().toISOString().split('T')[0];
                        var fechaAtencionEl = document.getElementById('fechaAtencion');
                        if (fechaAtencionEl) { fechaAtencionEl.value = today; }
                      });
                    </script>
            </div><!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo BASE_URL; ?>/public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo BASE_URL; ?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo BASE_URL; ?>/public/dist/js/adminlte.min.js"></script>
<script>
$(document).ready(function(){
    // Inicializar selects vacíos
    $('#prov_medico').html('<option value="">Seleccione Provincia</option>');
    $('#dist_medico').html('<option value="">Seleccione Distrito</option>');
    // Cargar departamentos por AJAX
    $.post('<?php echo BASE_URL; ?>/system/ajax_departamentos.php', function(data){
      $('#depart_medico').html(data);
    });
    // Cargar especialidades por AJAX
    $.post('<?php echo BASE_URL; ?>/system/ajax_especialidades.php', function(data){
      $('#esp_medico').html(data);
    });
    // Dependencia de selects
    $('#depart_medico').change(function(){
      var id_depart = $(this).val();
      $('#prov_medico').html('<option value="">Cargando...</option>');
      $.post('<?php echo BASE_URL; ?>/system/ajax_provincias.php', {id_depart: id_depart}, function(data){
        $('#prov_medico').html(data);
        $('#dist_medico').html('<option value="">Seleccione Distrito</option>');
      });
    });
    $('#prov_medico').change(function(){
      var id_prov = $(this).val();
      $('#dist_medico').html('<option value="">Cargando...</option>');
      $.post('<?php echo BASE_URL; ?>/system/ajax_distritos.php', {id_prov: id_prov}, function(data){
        $('#dist_medico').html(data);
      });
    });
    // Envío del formulario
    $('#formMedico').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: 'controller_medico.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response){
                $('#msgMedico').html('<span class="text-success">Médico registrado correctamente.</span>');
                $('#formMedico')[0].reset();
                // Reinicializar selects vacíos
                $('#prov_medico').html('<option value="">Seleccione Provincia</option>');
                $('#dist_medico').html('<option value="">Seleccione Distrito</option>');
            },
            error: function(){
                $('#msgMedico').html('<span class="text-danger">Error al registrar médico.</span>');
            }
        });
    });
});
</script>
</body>
</html>
<?php $additionalJS = []; include __DIR__ . '/../layout/footer.php'; ?>
