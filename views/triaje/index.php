<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../app/controllers/AuthController.php';
use App\Controllers\AuthController;
AuthController::checkAuth();
$pageTitle = 'Pre-Agendar Citas';
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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?php echo PUBLIC_URL; ?>/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo PUBLIC_URL; ?>/plugins/fullcalendar/main.css">
  <link rel="stylesheet" href="<?php echo PUBLIC_URL; ?>/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo PUBLIC_URL; ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo PUBLIC_URL; ?>/plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="<?php echo PUBLIC_URL; ?>/dist/css/adminlte.min.css">
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
  <link rel="icon" href="../../img/LogoAR.png" type="image/png">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- /.navbar -->

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
            <h1 class="m-0">Triaje</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
          <div class="col-xl">            
            <div class="card card-primary">            
              <div class="card-header">
                <h2 class="card-title text-lg font-semibold">Registro de Atención</h2>
              </div>
              <div class="card-body">
                <form id="formTriaje" method="POST" action="<?php echo BASE_URL; ?>/triaje/store">
                <input type="hidden" name="id_paciente" id="id_paciente" value="">
                <input type="hidden" name="id_cita" id="id_cita" value="">
                <input type="hidden" name="codigo_historial" id="codigo_historial" value="">
                <h2 class="section-title text-lg font-semibold p-2 mb-3">Datos del Paciente</h2>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Nro Documento</label>
                        <input type="text" class="form-control" name="numdoc_paciente" id="numdoc_paciente" placeholder="Ej. 32228669">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Paciente</label>
                        <input type="text" class="form-control" id="paciente_nombre" readonly>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Historia Clínica</label>
                        <input type="text" class="form-control" id="historia" readonly>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Edad</label>
                        <input type="text" id="edad" class="form-control" disabled>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Fecha Registro</label>
                        <input type="datetime-local" class="form-control" id="fecha_registro" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label><strong>Cita</strong></label>
                        <select class="form-control" id="sel_cita" name="id_cita_select" onchange="seleccionarCita()">
                          <option value="">-- Cargando citas --</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <h2 class="section-title text-lg font-semibold p-2 mb-3">Signos Vitales</h2>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Temperatura (°C)</label>
                        <input type="number" step="0.1" class="form-control" name="temp" id="temp" placeholder="36.5 - 37.5">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Presión Arterial (mmHg)</label>
                        <input type="text" class="form-control" name="presion" id="presion" placeholder="120/80">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>SpO₂ (%)</label>
                        <input type="number" step="0.1" class="form-control" name="spo2" id="spo2" placeholder="95 - 100">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Pulso (lpm)</label>
                        <input type="number" class="form-control" name="pulso" id="pulso" placeholder="60 - 100">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Talla (cm)</label>
                        <input type="number" step="0.1" class="form-control" name="talla" id="talla" placeholder="170" onchange="calcularIMC()">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Peso (kg)</label>
                        <input type="number" step="0.1" class="form-control" name="peso" id="peso" placeholder="70" onchange="calcularIMC()">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>IMC</label>
                        <input type="text" class="form-control" id="imc" name="imc" readonly>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Interpretación IMC</label>
                        <input type="text" class="form-control" id="imc_interp" name="imc_interp" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Alergias</label>
                        <textarea class="form-control" name="alergias" id="alergias" rows="3" placeholder="Ej. Penicilina, Sulfonamidas"></textarea>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-info">Guardar</button>
                  </div>
                  <!-- /.card-footer -->
                </form>
            </div><!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          
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
<script src="<?php echo PUBLIC_URL; ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo PUBLIC_URL; ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo PUBLIC_URL; ?>/dist/js/adminlte.min.js"></script>
<script>
  const BASE_URL = '<?php echo BASE_URL; ?>';

  function calcularIMC() {
    const talla = parseFloat($('#talla').val());
    const peso = parseFloat($('#peso').val());
    const imcField = $('#imc');
    const interpField = $('#imc_interp');

    if (!talla || !peso || talla <= 0 || peso <= 0) {
      imcField.val('');
      interpField.val('');
      return;
    }

    const tallaMts = talla / 100;
    const imc = (peso / (tallaMts * tallaMts)).toFixed(2);
    imcField.val(imc);

    let interpretacion = '';
    if (imc < 18.5) {
      interpretacion = 'Bajo peso';
    } else if (imc >= 18.5 && imc < 25) {
      interpretacion = 'Normal';
    } else if (imc >= 25 && imc < 30) {
      interpretacion = 'Sobrepeso';
    } else if (imc >= 30) {
      interpretacion = 'Obesidad';
    }
    interpField.val(interpretacion);
  }

  function cargarCitas(numdoc) {
    if (!numdoc) {
      $('#sel_cita').html('<option value="">-- Sin citas disponibles --</option>');
      return;
    }

    $.getJSON(BASE_URL + '/api/cita', { action: 'buscarPorDocumento', numdoc: numdoc }, function(resp) {
      const sel_cita = $('#sel_cita');
      sel_cita.empty();

      if (resp && resp.success && resp.citas && resp.citas.length > 0) {
        // Agregar opción "Sin cita"
        sel_cita.append('<option value="">-- Sin cita --</option>');
        
        // Agregar cada cita disponible
        $.each(resp.citas, function(idx, cita) {
          const fechaCita = cita.fecha_cita || '';
          const horaCita = cita.hora_cita || '';
          const nombreMedico = cita.nombre_medico || 'Sin asignar';
          const especialidad = cita.desc_especialidad || '';
          
          const texto = `${fechaCita} ${horaCita} - ${nombreMedico} (${especialidad})`;
          sel_cita.append(`<option value="${cita.id_cita}">${texto}</option>`);
        });
      } else {
        sel_cita.html('<option value="">-- No hay citas disponibles --</option>');
      }
    }).fail(function() {
      $('#sel_cita').html('<option value="">-- Error al cargar citas --</option>');
    });
  }

  function seleccionarCita() {
    const idCita = $('#sel_cita').val();
    $('#id_cita').val(idCita || '');
  }

  function llenarPaciente(data) {
    if (!data) return;
    const p = data.paciente || {};
    $('#id_paciente').val(p.id_paciente || '');
    $('#numdoc_paciente').val(p.numdoc_paciente || '');
    $('#paciente_nombre').val(p.nombre_completo || '');
    $('#historia').val(p.codigo_historial || '');
    $('#codigo_historial').val(p.codigo_historial || '');
    if (p.edad !== null && p.edad !== undefined) {
      $('#edad').val(p.edad);
    }
    
    // Cargar citas para este paciente
    cargarCitas(p.numdoc_paciente);
    
    // Establecer fecha y hora de registro actual
    const ahora = new Date();
    const isoDateTime = ahora.toISOString().slice(0, 16);
    $('#fecha_registro').val(isoDateTime);
  }

  function buscarPaciente(numdoc) {
    if (!numdoc) return;
    $.getJSON(BASE_URL + '/api/paciente', { action: 'buscarPorDocumento', numdoc: numdoc }, function(resp) {
      if (resp && resp.success) {
        llenarPaciente(resp);
      } else {
        alert(resp && resp.message ? resp.message : 'Paciente no encontrado');
        $('#paciente_nombre').val('');
        $('#historia').val('');
        $('#edad').val('');
        $('#id_paciente').val('');
        $('#codigo_historial').val('');
        $('#id_cita').val('');
        $('#sel_cita').html('<option value="">-- Sin citas disponibles --</option>');
      }
    }).fail(function() {
      alert('No se pudo buscar al paciente');
    });
  }

  $(function() {
    $('#numdoc_paciente').on('blur', function() {
      buscarPaciente(this.value.trim());
    });

    $('#numdoc_paciente').on('keypress', function(e) {
      if (e.which === 13) {
        e.preventDefault();
        buscarPaciente(this.value.trim());
      }
    });

    if ($('#numdoc_paciente').val()) {
      buscarPaciente($('#numdoc_paciente').val().trim());
    }
    
    // Establecer fecha de registro actual al cargar la página
    const ahora = new Date();
    const isoDateTime = ahora.toISOString().slice(0, 16);
    $('#fecha_registro').val(isoDateTime);

    // Manejar submit del formulario
    $('#formTriaje').on('submit', function(e) {
      e.preventDefault();

      // Validar documento
      if (!$('#numdoc_paciente').val().trim()) {
        alert('Por favor ingrese el documento del paciente');
        return;
      }

      // Validar que haya al menos un signo vital
      if (!$('#temp').val() && !$('#presion').val() && !$('#spo2').val() && !$('#pulso').val()) {
        alert('Por favor ingrese al menos un signo vital');
        return;
      }

      // Recopilar datos del formulario
      const formData = new FormData(this);

      // Enviar datos con AJAX
      $.ajax({
        url: BASE_URL + '/triaje/store',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(resp) {
          if (resp.success) {
            alert('Triaje registrado correctamente. ID: ' + resp.id_triaje);
            // Limpiar formulario
            $('#formTriaje')[0].reset();
            // Reiniciar campos
            $('#paciente_nombre').val('');
            $('#historia').val('');
            $('#edad').val('');
            $('#id_paciente').val('');
            $('#id_cita').val('');
            $('#codigo_historial').val('');
            $('#sel_cita').html('<option value="">-- Sin citas disponibles --</option>');
            $('#imc').val('');
            $('#imc_interp').val('');
            // Actualizar fecha de registro
            const ahora = new Date();
            const isoDateTime = ahora.toISOString().slice(0, 16);
            $('#fecha_registro').val(isoDateTime);
          } else {
            alert('Error: ' + (resp.message || 'No se pudo guardar el triaje'));
          }
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseText);
          alert('Error al guardar: ' + (xhr.responseJSON?.message || error));
        }
      });
    });
  });
</script>
</body>
</html>