<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../app/controllers/AuthController.php';
use App\Controllers\AuthController;
AuthController::checkAuth();
$pageTitle = 'Atención Médica General';
$additionalCSS = ['https://cdn.tailwindcss.com'];
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
            margin-top: 25px;
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }
        .table tbody tr {
            vertical-align: middle;
        }
        .btn-block {
            width: 100%;
        }
        .d-flex.align-items-end {
            display: flex;
            align-items: flex-end;
        }
        .mt-3 {
            margin-top: 20px !important;
        }
    </style>

  <link rel="icon" href="ruta/a/tu/icono.png" type="image/png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo PUBLIC_URL; ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo PUBLIC_URL; ?>/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<?php include BASE_PATH . '/system/includes/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Atención Médica del Paciente</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xl">            
            <div class="card card-primary">            
              <div class="card-header">
                <h2 class="card-title text-lg font-semibold">Registro de Atención</h2>
              </div>
              <div class="card-body">
                <form id="formAtencion" action="<?php echo BASE_URL; ?>/system/registrar_atencion" method="POST">
                <input type="hidden" name="id_cita" value="<?php echo $_GET['id_cita'] ?? ''; ?>">
                <input type="hidden" name="id_triaje" value="<?php echo $_GET['id_triaje'] ?? ''; ?>">
                <input type="hidden" name="id_paciente" id="id_paciente" value="<?php echo $_GET['id_paciente'] ?? ''; ?>">
                <input type="hidden" name="id_medico" value="<?php echo $_SESSION['idUser'] ?? ''; ?>">
                <input type="hidden" name="id_especialidad" id="id_especialidad" value="<?php echo $_GET['id_especialidad'] ?? ''; ?>">
                <input type="hidden" name="codigo_historial" id="codigo_historial" value="<?php echo $_GET['hc'] ?? ''; ?>">
                <h2 class="section-title text-lg font-semibold p-2 mb-3">Datos del Paciente</h2>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Nro Documento</label>
                        <input type="text" class="form-control" name="numdoc_paciente" id="numdoc_paciente" value="<?php echo $_GET['numdoc'] ?? ''; ?>" placeholder="Ej. 32228669">
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <div class="form-group">
                        <label>Paciente</label>
                        <input type="text" class="form-control" name="paciente" id="paciente_nombre" value="<?php echo $_GET['paciente'] ?? ''; ?>" readonly>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Historia Clinica</label>
                        <input type="text" class="form-control" id="historia" value="<?php echo $_GET['hc'] ?? ''; ?>" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Edad</label>
                        <input type="text" id="edad" class="form-control" disabled>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Fecha de Nacimiento</label>
                        <input type="date" id="fechaNacimiento" class="form-control" onchange="calcularEdad()" value="<?php echo $_GET['fnac'] ?? ''; ?>">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Fecha de Atención</label>
                        <input type="date" id="fechaAtencion" class="form-control" name="fecha_atencion" readonly>
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
                        <input type="number" step="0.1" class="form-control" name="talla" id="talla" placeholder="170">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Peso (kg)</label>
                        <input type="number" step="0.1" class="form-control" name="peso" id="peso" placeholder="70">
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
                        <textarea class="form-control" name="alergias" id="alergias" rows="2" placeholder="Ej. Penicilina, Sulfonamidas"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <!-- <label>Textarea</label> -->
                          <label>Maniobras realizadas en el Examen</label>
                        <textarea class="form-control" rows="3" name="maniobras"></textarea>
                      </div>
                    </div>
                  </div>
                  <h2 class="section-title text-lg font-semibold p-2 mb-3">Descripción de la Atención</h2>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Diagnostico</label>
                        <textarea class="form-control" rows="3" name="desc_diagnostico"></textarea>
                      </div>
                    </div>
                  </div>
                  <div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Antecedentes</label>
                        <textarea class="form-control" rows="3" name="desc_antecedentes"></textarea>
                      </div>
                    </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>CIE10 principal</label>
                        <select class="form-control" name="cie10_principal" id="cie10_principal">
                          <option value="">Seleccionar diagnóstico</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nota diagnóstico principal</label>
                        <input type="text" class="form-control" name="nota_diag_principal" />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Diagnósticos secundarios (CIE10)</label>
                        <div id="diagnosticos_secundarios_container">
                          <!-- Se agregan dinámicamente aquí -->
                        </div>
                        <button type="button" class="btn btn-sm btn-info mt-2" id="btn_agregar_diagnostico">
                          <i class="fas fa-plus"></i> 
                        </button>
                      </div>
                    </div>
                  </div>
                  
                  </div>
                  
<div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Motivo de consulta</label>
                        <textarea class="form-control" rows="3" name="motivo_consulta" placeholder="Describir el motivo de la consulta del paciente"></textarea>
                      </div>
                    </div>
                  </div>

                  <!-- EXÁMENES MÉDICOS -->
                  <h2 class="section-title text-lg font-semibold p-2 mb-3">Exámenes Médicos</h2>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Tipo de Examen</label>
                        <select class="form-control" id="grupo_analisis" name="grupo_analisis">
                          <option value="">Seleccionar Grupo de Análisis</option>
                          <?php
                          $grupos = $conn->query("SELECT id_grpexam, nom_grpexam FROM tb_grpexam ORDER BY nom_grpexam");
                          while ($g = $grupos->fetch_assoc()): ?>
                            <option value="<?= $g['id_grpexam'] ?>"><?= htmlspecialchars($g['nom_grpexam']) ?></option>
                          <?php endwhile; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Examen Médico</label>
                        <select class="form-control" id="sel_examen_medico" name="examen_medico">
                          <option value="">Seleccionar Examen Médico</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Observación</label>
                        <input type="text" class="form-control" id="observacion_examen" placeholder="Observación">
                      </div>
                    </div>
                    <div class="col-sm-2 d-flex align-items-end">
                      <div class="form-group">
                        <button type="button" class="btn btn-info btn-block" id="btn_agregar_examen">
                          <i class="fas fa-plus"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <table class="table table-sm table-hover">
                          <thead class="thead-light">
                            <tr>
                              <th style="width: 10px">#</th>
                              <th>Tipo de Examen</th>
                              <th>Examen Médico</th>
                              <th>Observación</th>
                              <th style="width: 60px">Acción</th>
                            </tr>
                          </thead>
                          <tbody id="examenes_tabla">
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                  <!-- TRATAMIENTO - RECETA MÉDICA -->
                  <h2 class="section-title text-lg font-semibold p-2 mb-3">Tratamiento - Receta Médica</h2>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Medicamento</label>
                        <select class="form-control" id="sel_medicamento">                            
                          <option value="">Cargando medicamentos...</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Presentación</label>
                        <input type="text" class="form-control" id="presentacion_med" placeholder="Se llena automáticamente" readonly>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Dosis</label>
                        <input type="text" class="form-control" id="dosis_med" placeholder="Ej. 250mg">
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Frecuencia (horas)</label>
                        <input type="number" class="form-control" id="frecuencia_med" placeholder="Ej. 8">
                      </div>
                    </div>
                    <div class="col-sm-1">
                      <div class="form-group">
                        <label>Días</label>
                        <input type="number" class="form-control" id="dias_med" placeholder="5">
                      </div>
                    </div>
                    <div class="col-sm-1 d-flex align-items-end">
                      <div class="form-group">
                      <button type="button" class="btn btn-info btn-block" id="btn_agregar_medicamento" style="margin-top: 0;">
                        <i class="fas fa-plus"></i>
                      </button>
                    </div>
                    </div>
                  </div>

                 

                  <div class="row mt-3">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <table class="table table-sm table-hover">
                          <thead class="thead-light">
                            <tr>
                              <th style="width: 10px">#</th>
                              <th>Medicamento</th>
                              <th>Presentación</th>
                              <th>Dosis</th>
                              <th>Frecuencia</th>
                              <th>Días</th>
                              <th>Total</th>
                              <th style="width: 60px">Acción</th>
                            </tr>
                          </thead>
                          <tbody id="medicamentos_tabla">
                          </tbody>
                        </table>
                      </div>
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
  <script src="<?php echo PUBLIC_URL; ?>/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo PUBLIC_URL; ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo PUBLIC_URL; ?>/dist/js/adminlte.min.js"></script>
    <!-- Toastr -->
    <link rel="stylesheet" href="<?php echo PUBLIC_URL; ?>/plugins/toastr/toastr.min.css">
    <script src="<?php echo PUBLIC_URL; ?>/plugins/toastr/toastr.min.js"></script>
  <script>
    const BASE_URL = '<?php echo BASE_URL; ?>';
    let countDiagSecundarios = 0; // Contador para IDs únicos

    // Serializar diagnósticos secundarios antes de enviar el formulario
    $('#formAtencion').on('submit', function(e) {
      e.preventDefault();
      // Diagnóstico principal
      const diagPrincipal = {
        id_cie10: $('#cie10_principal').val(),
        es_principal: 1,
        nota: $('input[name="nota_diag_principal"]').val() || ''
      };
      // Diagnósticos secundarios
      const secundarios = [];
      $('#diagnosticos_secundarios_container .row').each(function() {
        const id_cie10 = $(this).find('select').val();
        const nota = $(this).find('input[type="text"]').val() || '';
        if (id_cie10) {
          secundarios.push({ id_cie10, es_principal: 0, nota });
        }
      });
      const diagnosticos = [diagPrincipal, ...secundarios];

      // Serializar exámenes médicos (ahora con observación)
      const examenes = [];
      $('#examenes_tabla tr').each(function() {
        const tds = $(this).find('td');
        if (tds.length >= 4) {
          const id_tipexam = tds.eq(2).data('id');
          const observacion = tds.eq(3).text() || '';
          if (id_tipexam) {
            examenes.push({ id_tipexam, observacion });
          }
        }
      });

      // Validar que al menos un examen médico haya sido agregado
      console.log('Examenes serializados:', examenes);
      if (examenes.length === 0) {
        toastr.error('Debe agregar al menos un examen médico.');
        return;
      }

      // Serializar tratamientos (receta médica)
      const tratamientos = [];
      $('#medicamentos_tabla tr').each(function() {
        const tds = $(this).find('td');
        if (tds.length >= 7) {
          // Buscar el id_medicamento por el texto del medicamento
          const nombreMed = tds.eq(1).text();
          let id_medicamento = null;
          $('#sel_medicamento option').each(function() {
            if ($(this).text() === nombreMed) {
              id_medicamento = $(this).val();
            }
          });
          const dosis = tds.eq(3).text();
          const frecuencia = parseInt((tds.eq(4).text() || '').replace(/\D/g, '')) || 0;
          const dias = parseInt(tds.eq(5).text()) || 0;
          const total = parseInt((tds.eq(6).text() || '').replace(/\D/g, '')) || 0;
          if (id_medicamento) {
            tratamientos.push({ id_medicamento, dosis, valor_frecuencia: frecuencia, dias_tratamiento: dias, total });
          }
        }
      });

      // Crear/actualizar inputs ocultos para enviar como JSON
      let inputDiag = $(this).find('input[name="diagnosticos"]');
      if (inputDiag.length === 0) {
        inputDiag = $('<input type="hidden" name="diagnosticos" />');
        $(this).append(inputDiag);
      }
      inputDiag.val(JSON.stringify(diagnosticos));

      let inputTrat = $(this).find('input[name="tratamientos"]');
      if (inputTrat.length === 0) {
        inputTrat = $('<input type="hidden" name="tratamientos" />');
        $(this).append(inputTrat);
      }
      inputTrat.val(JSON.stringify(tratamientos));

      let inputExam = $(this).find('input[name="examenes"]');
      if (inputExam.length === 0) {
        inputExam = $('<input type="hidden" name="examenes" />');
        $(this).append(inputExam);
      }
      inputExam.val(JSON.stringify(examenes));

      // Enviar por AJAX
      const formData = $(this).serialize();
      $.post(BASE_URL + '/system/registrar_atencion', formData, function(resp) {
        if (resp.success) {
          toastr.success('Registro exitoso');
        } else {
          toastr.error('Error al registrar: ' + (resp.message || ''));
        }
      }, 'json').fail(function() {
        toastr.error('Error de conexión al registrar');
      });
    });

    function calcularEdad() {
      const fechaInput = document.getElementById('fechaNacimiento');
      const edadInput = document.getElementById('edad');
      if (!fechaInput || !edadInput || !fechaInput.value) return;
      const fechaNacimiento = new Date(fechaInput.value);
      if (isNaN(fechaNacimiento.getTime())) return;
      const hoy = new Date();
      let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
      const mes = hoy.getMonth() - fechaNacimiento.getMonth();
      if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
        edad--;
      }
      edadInput.value = edad;
    }

    function cargarCie10() {
      const esp = document.getElementById('id_especialidad')?.value || '';
      const select = document.getElementById('cie10_principal');
      if (!select) return;
      $.getJSON(BASE_URL + '/api/cie10', { esp: esp }, function(resp) {
        if (!resp || !resp.success) return;
        select.innerHTML = '<option value="">Seleccionar diagnóstico</option>';
        resp.cie10.forEach(function(item) {
          const opt = document.createElement('option');
          opt.value = item.id_cie10;
          opt.textContent = item.diag_cie10;
          select.appendChild(opt);
        });
      });
    }

    function cargarCie10Secondary(selectId) {
      // Cargar CIE-10 para select secundario
      const esp = document.getElementById('id_especialidad')?.value || '';
      const select = document.getElementById(selectId);
      if (!select) return;
      $.getJSON(BASE_URL + '/api/cie10', { esp: esp }, function(resp) {
        if (!resp || !resp.success) return;
        select.innerHTML = '<option value="">Seleccionar diagnóstico</option>';
        resp.cie10.forEach(function(item) {
          const opt = document.createElement('option');
          opt.value = item.id_cie10;
          opt.textContent = item.diag_cie10;
          select.appendChild(opt);
        });
      });
    }

    // Cargar exámenes médicos filtrados por grupo
    function cargarExamenesPorGrupo(idGrupo) {
      const select = document.getElementById('sel_examen_medico');
      if (!select) return;
      select.innerHTML = '<option value="">Seleccionar Examen Médico</option>';
      if (!idGrupo) return;
      $.getJSON(BASE_URL + '/system/ajax_examenes.php', { id_grpexam: idGrupo }, function(resp) {
        if (resp && resp.success && resp.data) {
          resp.data.forEach(function(exam) {
            const opt = document.createElement('option');
            opt.value = exam.id_tipexam;
            opt.textContent = exam.nom_tipexam;
            select.appendChild(opt);
          });
        }
      });
    }

    function cargarMedicamentos() {
      const select = document.getElementById('sel_medicamento');
      if (!select) return;
      $.getJSON(BASE_URL + '/api/medicamento', function(resp) {
        if (!resp || !resp.success) return;
        select.innerHTML = '<option value="">Seleccionar Medicamento</option>';
        resp.medicamentos.forEach(function(item) {
          const opt = document.createElement('option');
          opt.value = item.id_medicamento;
          opt.textContent = item.desc_medicamento;
          opt.setAttribute('data-presentacion', item.presentacion_medicamento || '');
          select.appendChild(opt);
        });
      }).fail(function() {
        select.innerHTML = '<option value="">Error al cargar medicamentos</option>';
      });
    }

    function agregarDiagnosticoSecundario() {
      countDiagSecundarios++;
      const container = document.getElementById('diagnosticos_secundarios_container');
      
      const rowDiv = document.createElement('div');
      rowDiv.className = 'row mb-2';
      rowDiv.id = 'diag_secundario_' + countDiagSecundarios;
      rowDiv.innerHTML = `
        <div class="col-sm-8">
          <select class="form-control cie10-secondary" id="cie10_secundario_${countDiagSecundarios}" name="cie10_secundarios[]">
            <option value="">Seleccionar diagnóstico</option>
          </select>
        </div>
        <div class="col-sm-3">
          <input type="text" class="form-control" name="nota_diag_secundario_${countDiagSecundarios}" placeholder="Nota diagnóstico (opcional)">
        </div>
        <div class="col-sm-1">
          <button type="button" class="btn btn-sm btn-danger" onclick="removerDiagnosticoSecundario(${countDiagSecundarios})">
            <i class="fas fa-trash"></i>
          </button>
        </div>
      `;
      container.appendChild(rowDiv);
      
      // Cargar opciones CIE-10
      cargarCie10Secondary('cie10_secundario_' + countDiagSecundarios);
    }

    function removerDiagnosticoSecundario(id) {
      const row = document.getElementById('diag_secundario_' + id);
      if (row) {
        row.remove();
      }
    }

    function llenarPresentacionMedicamento() {
      const selectMed = document.getElementById('sel_medicamento');
      const presentacionField = document.getElementById('presentacion_med');
      
      if (!selectMed || !presentacionField) return;
      
      const selectedOption = selectMed.options[selectMed.selectedIndex];
      // Intentar obtener la presentación del atributo data
      const presentacion = selectedOption.getAttribute('data-presentacion') || '';
      presentacionField.value = presentacion;
    }

    function cargarSignosVitalesTriaje(numdoc) {
      if (!numdoc) return;
      $.getJSON(BASE_URL + '/triaje/hoy', { numdoc: numdoc }, function(resp) {
        if (resp && resp.success && resp.triaje) {
          const t = resp.triaje;
          $('#temp').val(t.temp || '');
          $('#presion').val(t.presion || '');
          $('#spo2').val(t.spo2 || '');
          $('#pulso').val(t.pulso || '');
          $('#talla').val(t.talla || '');
          $('#peso').val(t.peso || '');
          $('#imc').val(t.IMC || '');
          $('#imc_interp').val(t.interp || '');
          $('#alergias').val(t.Alergias || '');
        }
      }).fail(function() {
        // No hay triaje hoy, limpiar campos de signos vitales
        $('#temp').val('');
        $('#presion').val('');
        $('#spo2').val('');
        $('#pulso').val('');
        $('#talla').val('');
        $('#peso').val('');
        $('#imc').val('');
        $('#imc_interp').val('');
        $('#alergias').val('');
      });
    }

    function llenarPaciente(data) {
      if (!data) return;
      const p = data.paciente || {};
      $('#id_paciente').val(p.id_paciente || '');
      $('#numdoc_paciente').val(p.numdoc_paciente || '');
      $('#paciente_nombre').val(p.nombre_completo || '');
      $('#historia').val(p.codigo_historial || '');
      $('#codigo_historial').val(p.codigo_historial || '');
      if (p.fnac_paciente) {
        $('#fechaNacimiento').val(p.fnac_paciente);
        calcularEdad();
      }
      if (p.edad !== null && p.edad !== undefined && p.edad !== '') {
        $('#edad').val(p.edad);
      }
      // Cargar signos vitales del triaje de hoy
      cargarSignosVitalesTriaje(p.numdoc_paciente || '');
    }

    function buscarPaciente(numdoc) {
      if (!numdoc) return;
      $.getJSON(BASE_URL + '/api/paciente', { action: 'buscarPorDocumento', numdoc: numdoc }, function(resp) {
        if (resp && resp.success) {
          llenarPaciente(resp);
        } else {
          alert(resp && resp.message ? resp.message : 'Paciente no encontrado');
        }
      }).fail(function() {
        alert('No se pudo buscar al paciente');
      });
    }

    $(function() {
      const fechaAtencion = document.getElementById('fechaAtencion');
      if (fechaAtencion) {
        const today = new Date().toISOString().split('T')[0];
        fechaAtencion.value = today;
      }

      cargarCie10();
      // Al cambiar grupo, cargar exámenes médicos filtrados
      $('#grupo_analisis').on('change', function() {
        cargarExamenesPorGrupo($(this).val());
      });
      // Inicializar selects vacíos
      $('#sel_examen_medico').html('<option value="">Seleccionar Examen Médico</option>');
      cargarMedicamentos();

      // Botón para agregar diagnóstico secundario
      $('#btn_agregar_diagnostico').on('click', function(e) {
        e.preventDefault();
        agregarDiagnosticoSecundario();
      });

      // Botón para agregar examen médico
      $('#btn_agregar_examen').on('click', function(e) {
        e.preventDefault();
        const selectGrupo = $('#grupo_analisis');
        const selectExamen = $('#sel_examen_medico');
        const observacion = $('#observacion_examen');
        if (!selectGrupo.val()) {
          alert('Por favor selecciona un tipo de examen');
          return;
        }
        if (!selectExamen.val()) {
          alert('Por favor selecciona un examen médico');
          return;
        }
        const tabla = $('#examenes_tabla');
        const filas = tabla.find('tr').length;
        const nombreGrupo = selectGrupo.find('option:selected').text();
        const nombreExamen = selectExamen.find('option:selected').text();
        const id_tipexam = selectExamen.val();
        const newRow = `
          <tr>
            <td>${filas + 1}.</td>
            <td>${nombreGrupo}</td>
            <td data-id="${id_tipexam}">${nombreExamen}</td>
            <td>${observacion.val() || ''}</td>
            <td><button type="button" class="btn btn-sm btn-danger btn-eliminar"><i class="fas fa-trash"></i></button></td>
          </tr>
        `;
        tabla.append(newRow);
        selectGrupo.val('');
        selectExamen.html('<option value="">Seleccionar Examen Médico</option>');
        observacion.val('');
      });

      // Botón para agregar medicamento
      $('#btn_agregar_medicamento').on('click', function(e) {
        e.preventDefault();
        const selectMed = $('#sel_medicamento');
        const presentacion = $('#presentacion_med');
        const dosis = $('#dosis_med');
        const frecuencia = $('#frecuencia_med');
        const dias = $('#dias_med');

        if (!selectMed.val()) {
          alert('Por favor selecciona un medicamento');
          return;
        }

        const tabla = $('#medicamentos_tabla');
        const filas = tabla.find('tr').length;
        const nombreMed = selectMed.find('option:selected').text();
        const total = (frecuencia.val() ? (24 / frecuencia.val()) * dias.val() : dias.val()) || '-';

        const newRow = `
          <tr>
            <td>${filas + 1}.</td>
            <td>${nombreMed}</td>
            <td>${presentacion.val() || '-'}</td>
            <td>${dosis.val() || '-'}</td>
            <td>Cada ${frecuencia.val() || '-'} horas</td>
            <td>${dias.val() || '-'}</td>
            <td>${total} unidades</td>
            <td><button type="button" class="btn btn-sm btn-danger btn-eliminar"><i class="fas fa-trash"></i></button></td>
          </tr>
        `;

        tabla.append(newRow);
        selectMed.val('');
        presentacion.val('');
        dosis.val('');
        frecuencia.val('');
        dias.val('');
      });

      // Eliminar filas (usar delegación de eventos)
      $(document).on('click', '.btn-eliminar', function(e) {
        e.preventDefault();
        $(this).closest('tr').remove();
      });

      // Evento para llenar presentación automáticamente
      $('#sel_medicamento').on('change', function() {
        llenarPresentacionMedicamento();
      });

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
      } else if ($('#fechaNacimiento').val()) {
        calcularEdad();
      }
    });
  </script>
</body>
</html>
<?php include __DIR__ . '/../layout/footer.php'; ?>
