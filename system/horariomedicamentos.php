<?php
  session_start();
  
  // Fecha de hoy
  $fechaHoy = new DateTime();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Horario del Médico</title>
  <link rel="icon" href="../img/clinica.png" type="image/png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../public/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../public/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../public/plugins/fullcalendar/main.min.css">
  <style>
    .calendario-semana {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 10px;
      margin-bottom: 30px;
    }
    
    .dia-card {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border-radius: 8px;
      padding: 15px;
      text-align: center;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      min-height: 200px;
      display: flex;
      flex-direction: column;
    }
    
    .dia-card.hoy {
      background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
      border: 3px solid #fff;
    }
    
    .dia-nombre {
      font-weight: bold;
      font-size: 14px;
      margin-bottom: 5px;
    }
    
    .dia-fecha {
      font-size: 12px;
      opacity: 0.9;
      margin-bottom: 10px;
    }
    
    .horas-container {
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 5px;
      justify-content: flex-start;
    }
    
    .hora-item {
      display: flex;
      align-items: center;
      background: rgba(255,255,255,0.2);
      padding: 5px 8px;
      border-radius: 4px;
      font-size: 11px;
      cursor: pointer;
      transition: all 0.3s;
    }
    
    .hora-item:hover {
      background: rgba(255,255,255,0.4);
    }
    
    .hora-item input[type="checkbox"] {
      margin-right: 5px;
      cursor: pointer;
    }
    
    .hora-item.checked {
      background: rgba(76, 175, 80, 0.4);
    }
    
    .btn-agregar-hora {
      font-size: 11px;
      padding: 3px 8px;
      margin-top: 5px;
      background: rgba(255,255,255,0.3);
      border: none;
      color: white;
      border-radius: 3px;
      cursor: pointer;
      transition: all 0.3s;
    }
    
    .btn-agregar-hora:hover {
      background: rgba(255,255,255,0.5);
    }
    
    .horario-registrado {
      background: #e8f5e9;
      border: 1px solid #4caf50;
    }
    
    .tabla-horarios {
      margin-top: 30px;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>

  <!-- Sidebar -->
  <?php include 'includes/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Horario de Disponibilidad</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Inicio</a></li>
              <li class="breadcrumb-item active">Horario</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        
        <!-- Instrucciones -->
        <div class="alert alert-info alert-dismissible fade show" role="alert">
          <h5><i class="fas fa-info-circle"></i> Instrucciones</h5>
          <p>Haz clic en un día del calendario mensual para registrar una hora de atención. Cada registro marca el día como activo. Puedes editar o eliminar horarios desde el modal.</p>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- Calendario Mensual -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Calendario del Mes</h3>
          </div>
          <div class="card-body">
            <div id="calendar"></div>
          </div>
        </div>

        <!-- Modal: Asignar Horario Médico -->
        <div class="modal fade" id="modalHorario" tabindex="-1" role="dialog" aria-labelledby="modalHorarioLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalHorarioLabel">Asignar Horario - <span id="modalFecha"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-4">
                    <div id="rangosContainer">
                      <div class="form-group rango-item">
                        <label>Rango de hora</label>
                        <div class="d-flex align-items-center">
                          <input type="time" class="form-control mr-2 input-hora-inicio" min="08:00" max="18:00" step="1800">
                          <span class="mr-2">a</span>
                          <input type="time" class="form-control input-hora-fin" min="08:00" max="18:00" step="1800">
                        </div>
                      </div>
                    </div>
                    <button class="btn btn-outline-primary btn-sm" id="btnAdicionarRango"><i class="fas fa-plus"></i> Adicionar hora disponible</button>
                    <button class="btn btn-success mt-2" id="btnGuardarRangos"><i class="fas fa-save"></i> Guardar</button>
                  </div>
                  <div class="col-md-8">
                    <h6>Horarios Registrados</h6>
                    <div class="table-responsive">
                      <table class="table table-sm table-striped">
                        <thead>
                          <tr>
                            <th>Hora Inicio</th>
                            <th>Hora Fin</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                          </tr>
                        </thead>
                        <tbody id="tablaHorariosDia">
                          <tr><td colspan="3" class="text-center text-muted">Sin registros</td></tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Tabla de Horarios Registrados -->
        <div class="card tabla-horarios">
          <div class="card-header">
            <h3 class="card-title">Disponibilidad Registrada</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Estado</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody id="bodyHorarios">
                <tr>
                  <td colspan="4" class="text-center text-muted">Cargando...</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2025.</strong> Todos los derechos reservados.
  </footer>
</div>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../public/dist/js/adminlte.min.js"></script>
<!-- FullCalendar -->
<script src="../public/plugins/fullcalendar/main.min.js"></script>

<script>
  var calendar; 
  var fechaSeleccionada = null;

  $(document).ready(function() {
    inicializarFullCalendar();
    cargarTablaHorarios();

    $('#btnAdicionarRango').on('click', function() {
      var item = $('<div class="form-group rango-item">\n' +
        '<label>Rango de hora</label>\n' +
        '<div class="d-flex align-items-center">\n' +
        '<input type="time" class="form-control mr-2 input-hora-inicio" min="08:00" max="18:00" step="1800">\n' +
        '<span class="mr-2">a</span>\n' +
        '<input type="time" class="form-control input-hora-fin" min="08:00" max="18:00" step="1800">\n' +
        '<button type="button" class="btn btn-link text-danger ml-2 btn-remove-rango"><i class="fas fa-times"></i></button>\n' +
        '</div>\n' +
      '</div>');
      $('#rangosContainer').append(item);
      item.find('.btn-remove-rango').on('click', function(){ $(this).closest('.rango-item').remove(); });
    });

    $('#btnGuardarRangos').on('click', function() {
      if (!fechaSeleccionada) { alert('Selecciona un día del calendario'); return; }
      var rangos = [];
      $('#rangosContainer .rango-item').each(function(){
        var inicio = $(this).find('.input-hora-inicio').val();
        var fin = $(this).find('.input-hora-fin').val();
        if (inicio && fin) rangos.push({inicio: inicio, fin: fin});
      });
      if (!rangos.length) { alert('Agrega al menos un rango válido'); return; }
      // Validación básica de solapamientos entre nuevos rangos
      rangos.sort(function(a,b){ return a.inicio.localeCompare(b.inicio); });
      for (var i=0;i<rangos.length;i++){
        if (rangos[i].inicio >= rangos[i].fin) { alert('Cada rango debe tener fin mayor que inicio'); return; }
        if (i>0 && rangos[i-1].fin > rangos[i].inicio) { alert('Rangos nuevos no deben solaparse entre sí'); return; }
      }
      // Guardar uno por uno
      var pendientes = rangos.length, errores = 0;
      rangos.forEach(function(r){
        $.ajax({
          type: 'POST', url: 'api/guardar-horario.php', dataType: 'json',
          data: { fecha: fechaSeleccionada, hora: r.inicio, hora_fin: r.fin, estado: 1 },
          success: function(resp){ if (!resp.success) { errores++; }
            pendientes--; if (pendientes===0){
              if (errores) alert('Algunos rangos no se guardaron por solapamiento');
              $('#rangosContainer').find('input[type="time"]').val('');
              cargarHorariosDia(fechaSeleccionada); calendar.refetchEvents();
            }
          },
          error: function(){ errores++; pendientes--; if (pendientes===0){ alert('Ocurrieron errores al guardar'); } }
        });
      });
    });
  });

  function inicializarFullCalendar() {
    var el = document.getElementById('calendar');
    calendar = new FullCalendar.Calendar(el, {
      initialView: 'dayGridMonth',
      height: 650,
      headerToolbar: { left: 'prev,next today', center: 'title', right: 'dayGridMonth' },
      locale: 'es',
      dateClick: function(info) {
        fechaSeleccionada = info.dateStr;
        $('#modalFecha').text(new Date(info.dateStr).toLocaleDateString());
        $('#modalHorario').modal('show');
        cargarHorariosDia(info.dateStr);
      },
      events: function(fetchInfo, success, failure) {
        $.ajax({
          type: 'POST',
          url: 'api/listar-horarios.php',
          dataType: 'json',
          success: function(data) {
            var fechasActivas = {};
            if (data.horarios) {
              data.horarios.forEach(function(h) {
                fechasActivas[h.fecha] = (fechasActivas[h.fecha] || 0) + 1;
              });
            }
            var events = Object.keys(fechasActivas).map(function(f) {
              return { title: 'Activo (' + fechasActivas[f] + ')', start: f, color: '#28a745' };
            });
            success(events);
          },
          error: function() { failure('Error'); }
        });
      }
    });
    calendar.render();
  }

  function cargarHorariosDia(fecha) {
    $.ajax({
      type: 'POST',
      url: 'api/listar-horarios-dia.php',
      data: { fecha: fecha },
      dataType: 'json',
      success: function(resp) {
        var tbody = $('#tablaHorariosDia');
        tbody.empty();
        if (resp.horarios && resp.horarios.length) {
          resp.horarios.forEach(function(h) {
            var estadoTexto = h.estado == 1 ? 'Activo' : 'Inactivo';
            var row = $('<tr>\n' +
              '<td><input type="time" class="form-control form-control-sm input-edit-hora" value="' + h.hora + '" data-id="' + h.id_horariomed + '"></td>\n' +
              '<td><input type="time" class="form-control form-control-sm input-edit-hora-fin" value="' + (h.hora_fin || '') + '"></td>\n' +
              '<td>' + estadoTexto + '</td>\n' +
              '<td>' +
                '<button class="btn btn-sm btn-primary btn-actualizar" data-id="' + h.id_horariomed + '"><i class="fas fa-save"></i></button> ' +
                '<button class="btn btn-sm btn-danger btn-eliminar" data-id="' + h.id_horariomed + '"><i class="fas fa-trash"></i></button>' +
              '</td>\n' +
            '</tr>');
            tbody.append(row);
          });

          $('.btn-actualizar').off('click').on('click', function() {
            var id = $(this).data('id');
            var tr = $(this).closest('tr');
            var hora = tr.find('.input-edit-hora').val();
            var hora_fin = tr.find('.input-edit-hora-fin').val();
            $.ajax({
              type: 'POST', url: 'api/actualizar-horario.php', data: { id: id, hora: hora, hora_fin: hora_fin }, dataType: 'json',
              success: function(r) { if (r.success) { cargarHorariosDia(fecha); calendar.refetchEvents(); } else { alert(r.mensaje||'Error'); } },
              error: function(){ alert('Error al actualizar'); }
            });
          });

          $('.btn-eliminar').off('click').on('click', function() {
            var id = $(this).data('id');
            if (!confirm('¿Eliminar este horario?')) return;
            $.ajax({
              type: 'POST', url: 'api/eliminar-horario.php', data: { id: id }, dataType: 'json',
              success: function(r) { if (r.success) { cargarHorariosDia(fecha); calendar.refetchEvents(); } },
              error: function(){ alert('Error al eliminar'); }
            });
          });
        } else {
          tbody.append('<tr><td colspan="3" class="text-center text-muted">Sin registros</td></tr>');
        }
      },
      error: function(){ $('#tablaHorariosDia').html('<tr><td colspan="3" class="text-center text-danger">Error al cargar</td></tr>'); }
    });
  }

  function cargarTablaHorarios() {
    // Rellena la tabla global existente abajo (si se mantiene) con el listado completo
    $.ajax({
      type: 'POST', url: 'api/listar-horarios.php', dataType: 'json',
      success: function(data){
        var tbody = $('#bodyHorarios');
        if (!tbody.length) return;
        tbody.empty();
        if (data.horarios && data.horarios.length) {
          data.horarios.forEach(function(h){
            var estadoClass = h.estado == 1 ? 'badge badge-success' : 'badge badge-danger';
            var estadoTexto = h.estado == 1 ? 'Activo' : 'Inactivo';
            var row = '<tr>' +
              '<td>' + h.fecha + '</td>' +
              '<td>' + h.hora + '</td>' +
              '<td><span class="' + estadoClass + '">' + estadoTexto + '</span></td>' +
              '<td><button class="btn btn-xs btn-danger btn-eliminar" data-id="' + h.id_horariomed + '">Eliminar</button></td>' +
            '</tr>';
            tbody.append(row);
          });
          $('.btn-eliminar').off('click').on('click', function(){
            var id = $(this).data('id');
            if (!confirm('¿Eliminar este horario?')) return;
            $.ajax({ type:'POST', url:'api/eliminar-horario.php', data:{id:id}, dataType:'json', success:function(r){ if(r.success){ cargarTablaHorarios(); calendar.refetchEvents(); } } });
          });
        } else {
          tbody.append('<tr><td colspan="4" class="text-center text-muted">Sin registros</td></tr>');
        }
      }
    });
  }
</script>
</body>
</html>
