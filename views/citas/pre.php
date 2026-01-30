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
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Agendar Cita - Sistema Clínico</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?php echo PUBLIC_URL; ?>/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo PUBLIC_URL; ?>/plugins/fullcalendar/main.css">
  <link rel="stylesheet" href="<?php echo PUBLIC_URL; ?>/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo PUBLIC_URL; ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo PUBLIC_URL; ?>/plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="<?php echo PUBLIC_URL; ?>/dist/css/adminlte.min.css">
  <style>
    .fc-button-primary {
      background-color: #007bff !important;
      border-color: #007bff !important;
    }
    .fc-button-primary:hover {
      background-color: #0056b3 !important;
    }
    .fc-daygrid-day-frame {
      cursor: pointer;
    }
  </style>
  <!-- Incluir jQuery y plugins necesarios en el head -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="<?php echo PUBLIC_URL; ?>/plugins/select2/js/select2.full.min.js"></script>
  <script src="<?php echo PUBLIC_URL; ?>/plugins/toastr/toastr.min.js"></script>
  <script src="<?php echo PUBLIC_URL; ?>/plugins/moment/moment.min.js"></script>
  <script src="<?php echo PUBLIC_URL; ?>/plugins/moment/locale/es.js"></script>
  <script src="<?php echo PUBLIC_URL; ?>/plugins/fullcalendar/main.min.js"></script>
  <script src="<?php echo PUBLIC_URL; ?>/plugins/fullcalendar/locales/es.global.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Sidebar -->
  <?php include BASE_PATH . '/system/includes/sidebar.php'; ?>
  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Agendar Cita Previa</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Datos de la Cita</h3>
              </div>
              <div class="card-body">
                <!-- Búsqueda Paciente por DNI -->
                <div class="form-group">
                  <label for="inputDNI">DNI del Paciente</label>
                  <input type="text" id="inputDNI" class="form-control" placeholder="Ingrese DNI" maxlength="10">
                </div>
                <!-- Datos del Paciente -->
                <div class="form-group">
                  <label>Paciente</label>
                  <input type="text" id="inputPaciente" class="form-control" readonly>
                  <input type="hidden" id="hiddenIdPaciente">
                </div>
                <!-- Especialidad -->
                <div class="form-group">
                  <label for="selectEspecialidad">Especialidad</label>
                  <select id="selectEspecialidad" class="form-control select2" style="width: 100%;">
                    <option value="">Seleccione especialidad</option>
                  </select>
                </div>
                <!-- Médico -->
                <div class="form-group">
                  <label for="selectMedico">Médico</label>
                  <select id="selectMedico" class="form-control select2" style="width: 100%;">
                    <option value="">Seleccione médico</option>
                  </select>
                </div>
                <!-- Fecha -->
                <div class="form-group">
                  <label for="inputFecha">Fecha Seleccionada</label>
                  <input type="text" id="inputFecha" class="form-control" readonly>
                </div>
                <!-- Hora -->
                <div class="form-group">
                  <label for="inputHora">Hora Seleccionada</label>
                  <input type="text" id="inputHora" class="form-control" readonly>
                </div>
                <!-- Motivo -->
                <div class="form-group">
                  <label for="inputMotivo">Motivo de la Consulta</label>
                  <textarea id="inputMotivo" class="form-control" rows="4" placeholder="Describa el motivo de la consulta"></textarea>
                </div>
                <!-- Botón guardar -->
                <button type="button" id="btnGuardarCita" class="btn btn-primary btn-block" style="display:none;">
                  <i class="fas fa-check"></i> Agendar Cita
                </button>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Citas del Paciente</h3>
              </div>
              <div class="card-body">
                <div id="calendarPaciente"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Calendario -->
  <div class="modal fade" id="modalCalendario" tabindex="-1" role="dialog" aria-labelledby="modalCalendarioLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="modalCalendarioLabel">
            Seleccionar Fecha y Hora - <span id="nombreMedicoModal"></span>
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="calendarContainer"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Horarios -->
  <div class="modal fade" id="modalHorarios" tabindex="-1" role="dialog" aria-labelledby="modalHorariosLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title" id="modalHorariosLabel">Horarios Disponibles - <span id="fechaSeleccionada"></span></h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="listaHorarios" class="text-center"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Confirmación -->
  <div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="modalConfirmacionLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="modalConfirmacionLabel">Cita Agendada Exitosamente</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="detalleConfirmacion"></div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php
  $additionalJS = [
    PUBLIC_URL . '/plugins/select2/js/select2.full.min.js',
    PUBLIC_URL . '/plugins/toastr/toastr.min.js',
    PUBLIC_URL . '/plugins/moment/moment.min.js',
    PUBLIC_URL . '/plugins/moment/locale/es.js',
    PUBLIC_URL . '/plugins/fullcalendar/main.min.js',
    PUBLIC_URL . '/plugins/fullcalendar/locales/es.global.js',
    PUBLIC_URL . '/plugins/bootstrap/js/bootstrap.bundle.min.js', // Asegura Bootstrap JS para .modal()
  ];
  include __DIR__ . '/../layout/footer.php';
  ?>
</div>

<script>
$(document).ready(function() {
  const dniPaciente = $('#inputDNI');
  const nombrePaciente = $('#inputPaciente');
  const idPaciente = $('#hiddenIdPaciente');
  const selectEspecialidad = $('#selectEspecialidad');
  const selectMedico = $('#selectMedico');
  const inputFecha = $('#inputFecha');
  const inputHora = $('#inputHora');
  const inputMotivo = $('#inputMotivo');
  const btnGuardar = $('#btnGuardarCita');

  let calendar;
  let citasDelPaciente = [];
  let horariosDisponibles = {};
  let calendarPaciente;

  // Al inicio del script principal, declara un array global para los médicos
  let listaMedicos = [];

  // Carga la lista de médicos al cargar la página
  $.getJSON('system/api/listar-medicos.php', function(data) {
    listaMedicos = data || [];
  });

  // Debugging: Check if jQuery and Select2 are loaded
  console.log('jQuery version:', typeof $ !== 'undefined' && $.fn ? $.fn.jquery : 'NOT LOADED');
  console.log('Select2 function:', typeof $.fn.select2);
  console.log('selectEspecialidad exists:', selectEspecialidad.length);
  console.log('selectMedico exists:', selectMedico.length);

  // Try-catch for Select2 initialization
  try {
    selectEspecialidad.select2();
    selectMedico.select2();
    console.log('Select2 initialized successfully');
  } catch (e) {
    console.error('Error initializing Select2:', e);
  }

  // Cargar especialidades
  function cargarEspecialidades() {
    $.getJSON('system/api/listar-especialidades.php', function(data) {
      selectEspecialidad.find('option:not(:first)').remove();
      if (data && data.length > 0) {
        data.forEach(function(e) {
          selectEspecialidad.append(`<option value="${e.id_especialidad}">${e.desc_especialidad}</option>`);
        });
      }
    });
  }

  cargarEspecialidades();

  // Inicializar calendario principal para citas del paciente
  function renderCalendarPaciente(events) {
    if (calendarPaciente) {
      calendarPaciente.destroy();
    }
    const calendarEl = document.getElementById('calendarPaciente');
    calendarPaciente = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      events: events,
      eventColor: '#007bff',
      eventClick: function(info) {
        // Mostrar modal con detalle de la cita
        const cita = info.event.extendedProps.citaData;
        let detalle = '';
        if (cita) {
          // Buscar nombre del médico por id_medico
          let nombreMedico = 'No registrado';
          if (cita.id_medico && listaMedicos.length > 0) {
            const medico = listaMedicos.find(m => m.id_medico == cita.id_medico);
            if (medico) {
              nombreMedico = (medico.sex_medico === 'M' ? 'DR. ' : 'DRA. ') + medico.nom_medico + ' ' + medico.apepat_medico;
            }
          }
          detalle = `<div class='alert alert-info'>
            <h5><i class='fas fa-calendar-check'></i> Detalle de la Cita</h5>
            <hr>
            <p><strong>Especialidad:</strong> ${cita.desc_especialidad || 'No registrado'}</p>
            <p><strong>Médico:</strong> ${nombreMedico}</p>
            <p><strong>Fecha:</strong> ${cita.fecha_cita}</p>
            <p><strong>Hora:</strong> ${cita.hora_cita}</p>
            <p><strong>Motivo:</strong> ${cita.motivo_cita}</p>
          </div>`;
        } else {
          detalle = `<div class='alert alert-warning'>No hay detalles disponibles.</div>`;
        }
        $('#detalleConfirmacion').html(detalle);
        $('#modalConfirmacion').modal('show');
      }
    });
    calendarPaciente.render();
  }

  // Buscar paciente por DNI
  dniPaciente.on('blur', function() {
    const dni = $(this).val().trim();
    if (!dni) {
      nombrePaciente.val('');
      idPaciente.val('');
      citasDelPaciente = [];
      renderCalendarPaciente([]);
      return;
    }

    $.ajax({
      url: 'system/api/buscar-paciente.php',
      method: 'POST',
      data: { dni: dni },
      dataType: 'json'
    })
    .done(function(resp) {
      if (resp.success && resp.paciente) {
        const p = resp.paciente;
        nombrePaciente.val(`${p.nom_paciente} ${p.apepat_paciente} ${p.apemat_paciente}`);
        idPaciente.val(p.id_paciente);
        inputMotivo.val(p.nom_paciente);
        cargarCitasDelPaciente(dni);
      } else {
        toastr.error('Paciente no encontrado');
        nombrePaciente.val('');
        idPaciente.val('');
        renderCalendarPaciente([]);
      }
    })
    .fail(function() {
      toastr.error('Error al buscar paciente');
      renderCalendarPaciente([]);
    });
  });

  // Cargar citas del paciente y actualizar calendario
  function cargarCitasDelPaciente(dni) {
    $.ajax({
      url: 'system/api/listar-citas-paciente.php',
      method: 'POST',
      data: { dni: dni },
      dataType: 'json'
    })
    .done(function(data) {
      citasDelPaciente = data && data.length > 0 ? data : [];
      // Mapear citas a eventos para el calendario
      const events = (citasDelPaciente || []).map(function(cita) {
        return {
          title: cita.especialidad + ' - ' + cita.medico,
          start: cita.fecha_cita,
          description: cita.motivo_cita,
          citaData: cita
        };
      });
      renderCalendarPaciente(events);
    });
  }

  // Cargar médicos por especialidad
  selectEspecialidad.on('change', function() {
    const idEsp = $(this).val();
    selectMedico.find('option:not(:first)').remove();

    if (!idEsp) return;

    $.ajax({
      url: 'system/api/listar-medicos-especialidad.php',
      method: 'POST',
      data: { id_especialidad: idEsp },
      dataType: 'json'
    })
    .done(function(data) {
      if (data && data.length > 0) {
        data.forEach(function(m) {
          const nombreMedico = m.sex_medico === 'M' ? `DR. ${m.nom_medico} ${m.apepat_medico}` : `DRA. ${m.nom_medico} ${m.apepat_medico}`;
          selectMedico.append(`<option value="${m.id_medico}">${nombreMedico}</option>`);
        });
      }
    });
  });

  // Cuando selecciona un médico, mostrar modal con calendario
  selectMedico.on('change', function() {
    const idMedico = $(this).val();
    const nombreMedico = selectMedico.find('option:selected').text();
    if (!idMedico) {
      toastr.warning('Seleccione un médico primero');
      return;
    }
    $('#nombreMedicoModal').text(nombreMedico);
    abrirModalCalendario(idMedico);
  });

  function abrirModalCalendario(idMedico) {
    $('#modalCalendario').modal('show');
    if (calendar) {
      calendar.destroy();
    }
    const calendarEl = document.getElementById('calendarContainer');
    calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth'
      },
      locale: 'es',
      datesSet: function(info) {
        // Pre-cargar horarios de todo el mes visible para mejor UX
        const start = moment(info.start).format('YYYY-MM-DD');
        const end = moment(info.end).format('YYYY-MM-DD');
        $.ajax({
          url: 'system/api/listar-horarios-disponibles-mes.php',
          method: 'POST',
          data: { id_medico: idMedico, start: start, end: end },
          dataType: 'json',
          success: function(data) {
            // Limpiar todos los días
            calendarEl.querySelectorAll('[data-date]').forEach(function(cell) {
              cell.style.backgroundColor = '';
              cell.style.cursor = '';
              cell.style.fontWeight = '';
              cell.onclick = null;
            });
            // Pintar solo los días con horarios disponibles
            Object.keys(data).forEach(function(fechaStr) {
              const cell = calendarEl.querySelector('[data-date="'+fechaStr+'"]');
              const horarios = data[fechaStr] || [];
              if (cell && horarios.length > 0) {
                cell.style.backgroundColor = '#90EE90';
                cell.style.cursor = 'pointer';
                cell.style.fontWeight = 'bold';
                cell.onclick = function() {
                  mostrarHorarios(fechaStr, horarios);
                };
              }
            });
          }
        });
      }
    });
    calendar.render();
  }

  function mostrarHorarios(fecha, horarios) {
    const lista = $('#listaHorarios');
    lista.empty();
    const fechaFormato = moment(fecha).format('DD/MM/YYYY');
    $('#fechaSeleccionada').text(fechaFormato);
    if (!horarios || horarios.length === 0) {
      lista.append('<p class="text-muted">No hay horarios disponibles</p>');
      $('#modalHorarios').modal('show');
      return;
    }
    horarios.forEach(function(h) {
      const btn = $(`<button type="button" class="btn btn-outline-primary mr-2 mb-2 btn-horario" style="font-size: 1.1em; padding: 10px 20px;">
        ${h.hora}
      </button>`);
      btn.on('click', function() {
        inputFecha.val(fechaFormato);
        inputHora.val(h.hora);
        btnGuardar.show();
        $('#modalHorarios').modal('hide');
        $('#modalCalendario').modal('hide');
        toastr.success('Horario seleccionado correctamente');
      });
      lista.append(btn);
    });
    $('#modalHorarios').modal('show');
  }

  // Guardar cita
  btnGuardar.on('click', function() {
    const dni = dniPaciente.val().trim();
    const idEsp = selectEspecialidad.val();
    const idMed = selectMedico.val();
    const fecha = inputFecha.val();
    const hora = inputHora.val();
    const motivo = inputMotivo.val().trim();

    if (!dni || !idEsp || !idMed || !fecha || !hora || !motivo) {
      toastr.error('Complete todos los campos');
      return;
    }

    // Convertir fecha de DD/MM/YYYY a YYYY-MM-DD
    const fechaParts = fecha.split('/');
    const fechaISO = `${fechaParts[2]}-${fechaParts[1]}-${fechaParts[0]}`;

    $.ajax({
      url: 'system/api/crear-cita.php',
      method: 'POST',
      data: {
        numdoc_paciente: dni,
        id_especialidad: idEsp,
        id_medico: idMed,
        fecha_cita: fechaISO,
        hora_cita: hora,
        motivo_cita: motivo
      },
      dataType: 'json'
    })
    .done(function(resp) {
      if (resp.success) {
        const detalleHTML =
          `<div class="alert alert-success">
            <h5><i class="fas fa-check-circle"></i> Cita Registrada Exitosamente</h5>
            <hr>
            <p><strong>Paciente:</strong> ${nombrePaciente.val()}</p>
            <p><strong>Especialidad:</strong> ${selectEspecialidad.find('option:selected').text()}</p>
            <p><strong>Médico:</strong> ${selectMedico.find('option:selected').text()}</p>
            <p><strong>Fecha:</strong> <span style="background-color:#28a745;color:white;padding:5px;border-radius:3px;">` + fecha + `</span></p>
            <p><strong>Hora:</strong> ${hora}</p>
            <p><strong>Motivo:</strong> ${motivo}</p>
          </div>
        `;
        $('#detalleConfirmacion').html(detalleHTML);
        $('#modalConfirmacion').modal('show');

        setTimeout(function() {
          dniPaciente.val('');
          nombrePaciente.val('');
          selectEspecialidad.val('').trigger('change');
          selectMedico.val('').trigger('change');
          inputFecha.val('');
          inputHora.val('');
          inputMotivo.val('');
          btnGuardar.hide();
          citasDelPaciente = [];
          horariosDisponibles = {};
          $('#modalConfirmacion').modal('hide');
        }, 3000);
      } else {
        toastr.error(resp.message || 'Error al guardar la cita');
      }
    })
    .fail(function() {
      toastr.error('Error en la solicitud');
    });
  });
});
</script>

</body>
</html>
