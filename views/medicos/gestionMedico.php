<?php
// Vista: Gestión de Médicos
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../app/controllers/AuthController.php';
\App\Controllers\AuthController::checkAuth();
$pageTitle = 'Gestión de Médicos';
$additionalCSS = [
    'https://cdn.tailwindcss.com'
];
include __DIR__ . '/../layout/header.php';
include __DIR__ . '/../layout/sidebar.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestión de Médicos - Sistema Clínico</title>
  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/dist/css/adminlte.min.css">
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
            <h1 class="m-0">Gestión de Médicos</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Médicos Registrados</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalMedico">
                    <i class="fas fa-plus"></i> Nuevo Médico
                  </button>
                </div>
              </div>
              <div class="card-body">
                <table id="tablaMedicos" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Especialidades</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Especialidades del Médico -->
  <div class="modal fade" id="modalEspecialidades" tabindex="-1" role="dialog" aria-labelledby="modalEspecialidadesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Asignar Especialidades - <span id="nombreMedicoModal"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="idMedicoModal">
          <div id="listaEspecialidades"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>


</div>

<!-- Scripts -->

<script src="<?php echo BASE_URL; ?>/public/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo BASE_URL; ?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="<?php echo BASE_URL; ?>/public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo BASE_URL; ?>/public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

<script src="<?php echo BASE_URL; ?>/public/plugins/select2/js/select2.full.min.js"></script>
<script src="<?php echo BASE_URL; ?>/public/plugins/toastr/toastr.min.js"></script>

<script src="<?php echo BASE_URL; ?>/public/dist/js/adminlte.min.js"></script>

<script>
$(document).ready(function () {
  if (!$.fn.DataTable) {
    console.error('DataTables no está cargado');
    return;
  }

  let tablaMedicos = $('#tablaMedicos').DataTable({
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
    }
  });

  cargarMedicos();


  // Cargar médicos
  function cargarMedicos() {
    $.getJSON('api/listar-medicos.php', function(data) {
      tablaMedicos.clear();
      if (data && data.length > 0) {
        data.forEach(function(m) {
          const nombreMedico = m.sex_medico === 'M' ? `DR. ${m.nom_medico} ${m.apepat_medico}` : `DRA. ${m.nom_medico} ${m.apepat_medico}`;
          const especialidades = m.especialidades || 'Sin especialidades';
          const btnEspecialidades = `<button class="btn btn-sm btn-info btn-especialidades" data-id="${m.id_medico}" data-nombre="${nombreMedico}">
            <i class="fas fa-tasks"></i> Especialidades
          </button>`;
          
          tablaMedicos.row.add([
            m.id_medico,
            nombreMedico,
            especialidades,
            btnEspecialidades
          ]).draw();
        });
      }
    });
  }

  cargarMedicos();

  // Mostrar modal de especialidades
  $(document).on('click', '.btn-especialidades', function() {
    const idMedico = $(this).data('id');
    const nombreMedico = $(this).data('nombre');
    
    $('#idMedicoModal').val(idMedico);
    $('#nombreMedicoModal').text(nombreMedico);
    
    cargarEspecialidades(idMedico);
    $('#modalEspecialidades').modal('show');
  });

  function cargarEspecialidades(idMedico) {
    $.ajax({
      url: 'api/listar-especialidades-medico.php',
      method: 'POST',
      data: { id_medico: idMedico },
      dataType: 'json'
    })
    .done(function(data) {
      const lista = $('#listaEspecialidades');
      lista.empty();
      
      if (data && data.length > 0) {
        let html = '<div class="list-group">';
        data.forEach(function(e) {
          const checked = e.asignada ? 'checked' : '';
          const badge = e.asignada ? '<span class="badge badge-success float-right">Asignada</span>' : '';
          html += `
            <div class="list-group-item">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input checkbox-esp" id="esp${e.id_especialidad}" 
                       data-id="${e.id_especialidad}" ${checked}>
                <label class="custom-control-label" for="esp${e.id_especialidad}">
                  ${e.desc_especialidad}
                </label>
                ${badge}
              </div>
            </div>
          `;
        });
        html += '</div>';
        lista.html(html);
        
        // Manejar cambios
        $('.checkbox-esp').on('change', function() {
          const idEspecialidad = $(this).data('id');
          const accion = $(this).is(':checked') ? 'asignar' : 'desasignar';
          
          $.ajax({
            url: 'api/asignar-especialidad-medico.php',
            method: 'POST',
            data: {
              id_medico: idMedico,
              id_especialidad: idEspecialidad,
              accion: accion
            },
            dataType: 'json'
          })
          .done(function(resp) {
            if (resp.success) {
              toastr.success(resp.message);
              cargarMedicos();
            } else {
              toastr.error(resp.message || 'Error');
              $(this).prop('checked', !$(this).is(':checked'));
            }
          });
        });
      }
    });
  }
});
</script>

</body>
</html>
<?php $additionalJS = []; include __DIR__ . '/../layout/footer.php'; ?>
