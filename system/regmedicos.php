<?php
  session_start();
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
  <link rel="icon" href="../img/clinica.png" type="image/png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../public/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../public/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../public/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../public/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../public/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
   <?php include 'includes/sidebar.php' ?>
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
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      <!--Anything you want -->
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2025.</strong> Todos los derechos reservados.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../public/dist/js/adminlte.min.js"></script>
<script>
$(document).ready(function(){
    // Inicializar selects vacíos
    $('#prov_medico').html('<option value="">Seleccione Provincia</option>');
    $('#dist_medico').html('<option value="">Seleccione Distrito</option>');
    // Cargar departamentos por AJAX
    $.post('ajax_departamentos.php', function(data){
        $('#depart_medico').html(data);
    });
    // Cargar especialidades por AJAX
    $.post('ajax_especialidades.php', function(data){
        $('#esp_medico').html(data);
    });
    // Dependencia de selects
    $('#depart_medico').change(function(){
        var id_depart = $(this).val();
        $('#prov_medico').html('<option value="">Cargando...</option>');
        $.post('ajax_provincias.php', {id_depart: id_depart}, function(data){
            $('#prov_medico').html(data);
            $('#dist_medico').html('<option value="">Seleccione Distrito</option>');
        });
    });
    $('#prov_medico').change(function(){
        var id_prov = $(this).val();
        $('#dist_medico').html('<option value="">Cargando...</option>');
        $.post('ajax_distritos.php', {id_prov: id_prov}, function(data){
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