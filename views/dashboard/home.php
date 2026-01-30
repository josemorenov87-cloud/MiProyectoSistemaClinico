<?php
// session_start(); // Ya se inicia en config.php
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
  <link rel="icon" href="<?php echo BASE_URL; ?>/system/img/clinica.png" type="image/png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo PUBLIC_URL; ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo PUBLIC_URL; ?>/dist/css/adminlte.min.css">
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
              <img src="<?php echo BASE_URL; ?>/system/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
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
              <img src="<?php echo BASE_URL; ?>/system/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
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
              <img src="<?php echo BASE_URL; ?>/system/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
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
  <?php include __DIR__ . '/../../system/includes/sidebar.php'; ?>
    <script>
      window.BASE_URL = '<?php echo BASE_URL; ?>';
      window.PUBLIC_URL = '<?php echo PUBLIC_URL; ?>';
    </script>
    <script src="<?php echo PUBLIC_URL; ?>/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo PUBLIC_URL; ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo PUBLIC_URL; ?>/dist/js/adminlte.min.js"></script>

  <!-- Contenido Sidebar.php -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Bienvenido al Sistema de Gestión Médica</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-8">
            
            <div class="card card-primary card-outline">
              <!-- <div class="card-body">
                <h5 class="card-title">Card title</h5>

                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk of the card's
                  content.
                </p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
              </div> -->
            </div><!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-4">
            
            <div class="card card-primary card-outline">
              <!-- <div class="card-header">
                <h5 class="m-0">Featured</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">Special title treatment</h6>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div> -->
            </div>
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


<!-- Modal Horario del Médico -->
<div class="modal fade" id="modalHorarioMedico" tabindex="-1" role="dialog" aria-labelledby="modalHorarioTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="modalHorarioTitle">
          <i class="fas fa-clock"></i> Horario de Disponibilidad
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalHorarioBody">
        <div class="text-center">
          <div class="spinner-border" role="status">
            <span class="sr-only">Cargando...</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo PUBLIC_URL; ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo PUBLIC_URL; ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo PUBLIC_URL; ?>/dist/js/adminlte.min.js"></script>

<script>
  $(document).ready(function() {
    // Cargar contenido del modal cuando se abre
    $('#modalHorarioMedico').on('show.bs.modal', function() {
      var body = $(this).find('.modal-body');
      body.html('<div class="text-center"><div class="spinner-border" role="status"><span class="sr-only">Cargando...</span></div></div>');
      
      $.ajax({
        url: '<?php echo BASE_URL; ?>/horario-medico/modal',
        method: 'GET',
        dataType: 'html',
        success: function(data) {
          body.html(data);
          
          // Re-inicializar scripts del modal
          initHorarioModal();
        },
        error: function() {
          body.html('<div class="alert alert-danger">Error al cargar. Solo médicos pueden acceder a esta sección.</div>');
        }
      });
    });
  });

  function initHorarioModal() {
    // Cargar horarios
    cargarHorarios();

    // Manejar envío del formulario
    $('#formHorario').on('submit', function(e) {
      e.preventDefault();
      guardarHorario();
    });

    // Establecer fecha mínima a hoy
    var hoy = new Date().toISOString().split('T')[0];
    $('#fecha').attr('min', hoy);
  }

  function cargarHorarios() {
    $.ajax({
      type: 'POST',
      url: '<?php echo BASE_URL; ?>/listar-horarios-medico',
      dataType: 'json',
      success: function(data) {
        var tbody = $('#bodyHorarios');
        if (tbody.length === 0) return; // Si no existe en el modal
        
        tbody.empty();
        
        if (data.horarios && data.horarios.length > 0) {
          $.each(data.horarios, function(i, horario) {
            var estadoClass = horario.estado == 1 ? 'text-success font-weight-bold' : 'text-danger font-weight-bold';
            var estadoTexto = horario.estado == 1 ? 'Activo' : 'Inactivo';
            
            var row = '<tr>' +
              '<td>' + horario.fecha + '</td>' +
              '<td>' + horario.hora + '</td>' +
              '<td><span class="' + estadoClass + '">' + estadoTexto + '</span></td>' +
              '<td>' +
              '<button class="btn btn-sm btn-danger btn-eliminar" data-id="' + horario.id_horariomed + '">Eliminar</button>' +
              '</td>' +
              '</tr>';
            tbody.append(row);
          });

          // Delegated event para eliminar
          $('.btn-eliminar').off('click').on('click', function() {
            var id = $(this).data('id');
            if (confirm('¿Estás seguro de que deseas eliminar este horario?')) {
              eliminarHorario(id);
            }
          });
        } else {
          tbody.append('<tr><td colspan="4" class="text-center">No hay horarios registrados</td></tr>');
        }
      }
    });
  }

  function guardarHorario() {
    var fecha = $('#fecha').val();
    var hora = $('#hora').val();
    var estado = $('#estado').val();

    if (!fecha || !hora || !estado) {
      alert('Por favor completa todos los campos');
      return;
    }

    $.ajax({
      type: 'POST',
      url: '<?php echo BASE_URL; ?>/guardar-horario-medico',
      data: {
        fecha: fecha,
        hora: hora,
        estado: estado
      },
      dataType: 'json',
      success: function(response) {
        if (response.success) {
          alert('Disponibilidad registrada exitosamente');
          $('#formHorario')[0].reset();
          $('#estado').val('');
          cargarHorarios();
        } else {
          alert('Error: ' + response.mensaje);
        }
      },
      error: function() {
        alert('Error al guardar el horario');
      }
    });
  }

  function eliminarHorario(id) {
    $.ajax({
      type: 'POST',
      url: '<?php echo BASE_URL; ?>/eliminar-horario-medico',
      data: {
        id: id
      },
      dataType: 'json',
      success: function(response) {
        if (response.success) {
          alert('Horario eliminado exitosamente');
          cargarHorarios();
        } else {
          alert('Error al eliminar el horario');
        }
      },
      error: function() {
        alert('Error al eliminar el horario');
      }
    });
  }
</script>
</body>
</html>

