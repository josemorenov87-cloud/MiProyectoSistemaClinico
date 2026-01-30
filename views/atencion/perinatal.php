<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../app/controllers/AuthController.php';
use App\Controllers\AuthController;
AuthController::checkAuth();
$pageTitle = 'Atención Perinatal';
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
<!-- En producción, instala Tailwind CSS localmente: https://tailwindcss.com/docs/installation -->
<!-- <script src="https://cdn.tailwindcss.com"></script> -->
<style>
  .required:after {
    content: " *";
    color: red;
  }
  .section-title {
    background-color: #E6F2FF;
    border-left: 4px solid #6610f2;
  }
</style>

  <link rel="icon" href="ruta/a/tu/icono.png" type="image/png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/www.sistemaclinico2.com/public/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/www.sistemaclinico2.com/public/dist/css/adminlte.min.css">
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
            <h1 class="m-0">Atención Perinatal</h1>
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
            <div class="card card-indigo">
              <div class="card-header">
                <h2 class="card-title text-lg font-semibold">Registro de Atención</h2>
              </div>
              <div class="card-body">
                <h2 class="section-title text-lg font-semibold p-2 mb-3">Datos del Paciente</h2>
                <form>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>N° Documento</label>
                        <input type="text" class="form-control" id="numdoc_paciente" name="numdoc_paciente" placeholder="Ingrese N° documento">
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <div class="form-group">
                        <label>Paciente</label>
                        <input type="text" class="form-control" id="paciente_nombre" name="paciente_nombre" readonly>
                        <input type="hidden" id="id_paciente" name="id_paciente">
                        <input type="hidden" id="codigo_historial" name="codigo_historial">
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Historia Clínica</label>
                        <input type="text" class="form-control" id="historia" name="historia" readonly>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Edad</label>
                        <input type="text" class="form-control" id="edad" name="edad" readonly>
                      </div>
                    </div>
                  </div>
                  <h2 class="section-title text-lg font-semibold p-2 mb-3">Signos Vitales</h2>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Temperatura (°C)</label>
                        <input type="text" class="form-control" id="temp" name="temp" readonly>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Presión Arterial (mmHg)</label>
                        <input type="text" class="form-control" id="presion" name="presion" readonly>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>SpO2 (%)</label>
                        <input type="text" class="form-control" id="spo2" name="spo2" readonly>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Pulso (lpm)</label>
                        <input type="text" class="form-control" id="pulso" name="pulso" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Talla (cm)</label>
                        <input type="text" class="form-control" id="talla" name="talla" readonly>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Peso (kg)</label>
                        <input type="text" class="form-control" id="peso" name="peso" readonly>
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
                        <label>Maniobras realizadas en el Examen</label>
                        <textarea class="form-control" name="maniobras_examen" id="maniobras_examen" rows="3"></textarea>
                      </div>
                    </div>
                  </div>
                  <h2 class="section-title text-lg font-semibold p-2 mb-3">Descripción de la Atención</h2>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Motivo de Consulta</label>
                        <textarea class="form-control" name="motivo_consulta" id="motivo_consulta" rows="2"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Diagnóstico CIE-10 principal</label>
                        <select class="form-control" name="cie10_principal" id="cie10_principal">
                          <option value="">Seleccionar diagnóstico</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <div class="form-group">
                        <label>Nota diagnóstico principal</label>
                        <input type="text" class="form-control" name="nota_diag_principal" />
                      </div>
                    </div>
                    <div class="col-sm-1 d-flex align-items-end">
                      <div class="form-group">
                        <button type="button" class="btn btn-info btn-block" id="btn_agregar_diagnostico" style="margin-top: 0;">
                          <i class="fas fa-plus"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  <div id="diagnosticos_secundarios_container"></div>
                  <input type="hidden" id="fechaAtencion" name="fechaAtencion">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Descripción Diagnóstico</label>
                        <textarea class="form-control" name="desc_diagnostico" id="desc_diagnostico" rows="2"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Antecedentes</label>
                        <textarea class="form-control" name="desc_antecedentes" id="desc_antecedentes" rows="2"></textarea>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="estado" id="estado" value="1">
                  <h2 class="section-title text-lg font-semibold p-2 mb-3">Orden de Análisis Clínicos</h2>
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
                        <label>Examen Medico</label>
                        <select class="form-control" id="examen_medico" name="examen_medico">
                          <option value="">Seleccionar Examen Médico</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Comentarios / Observaciones</label>
                        <input type="text" class="form-control" id="comentarios_analisis" name="comentarios_analisis">
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <button type="button" class="btn btn-info" id="btn_add_analisis">➕</button>
                        <button type="button" class="btn btn-info" id="btn_save_analisis">💾</button>
                        <button type="button" class="btn btn-info" id="btn_print_analisis">🖨️</button>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <table class="table table-sm">
                          <thead>
                            <tr>
                              <th style="width: 10px">#</th>
                              <th>Tipo de Analisis</th>
                              <th>Tipo de Examen</th>
                              <th>Comentarios / Observaciones</th>
                            </tr>
                          </thead>
                          <tbody id="tabla_analisis_body">
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
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
                  <!-- /.card-footer -->
                </form>
                    <script>
                        function calcularEdad() {
                            const fechaNacimiento = new Date(document.getElementById('fechaNacimiento').value);
                            const hoy = new Date();
                            
                            // Calcula la diferencia en años
                            let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
                            
                            // Ajusta si el cumpleaños aún no ha ocurrido este año
                            const mes = hoy.getMonth() - fechaNacimiento.getMonth();
                            if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
                                edad--;
                            }
                            
                            document.getElementById('edad').value = edad;
                        }
                        
                        // Establecer la fecha de atención automáticamente a hoy
                        document.addEventListener('DOMContentLoaded', function() {
                            const today = new Date().toISOString().split('T')[0];
                            document.getElementById('fechaAtencion').value = today;
                        });
                    </script>
            </div><!-- /.card -->
          </div>
  
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
<script src="/www.sistemaclinico2.com/public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/www.sistemaclinico2.com/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/www.sistemaclinico2.com/public/dist/js/adminlte.min.js"></script>
<!-- Script para análisis clínicos igual que ginecología -->
<script src="/www.sistemaclinico2.com/public/js/ginecologica-analisis.js"></script>
<script>
// --- Lógica de tratamiento igual a vista médica/ginecológica ---
const BASE_URL = '<?php echo BASE_URL; ?>';
let countDiagSecundarios = 0;
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
function llenarPresentacionMedicamento() {
  const selectMed = document.getElementById('sel_medicamento');
  const presentacionField = document.getElementById('presentacion_med');
  if (!selectMed || !presentacionField) return;
  const selectedOption = selectMed.options[selectMed.selectedIndex];
  const presentacion = selectedOption.getAttribute('data-presentacion') || '';
  presentacionField.value = presentacion;
}
function calcularEdad(fecha) {
  if (!fecha) return '';
  const fechaNacimiento = new Date(fecha);
  if (isNaN(fechaNacimiento.getTime())) return '';
  const hoy = new Date();
  let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
  const mes = hoy.getMonth() - fechaNacimiento.getMonth();
  if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
    edad--;
  }
  return edad;
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
    $('#temp, #presion, #spo2, #pulso, #talla, #peso, #imc, #imc_interp, #alergias').val('');
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
    $('#edad').val(calcularEdad(p.fnac_paciente));
  } else if (p.edad !== null && p.edad !== undefined && p.edad !== '') {
    $('#edad').val(p.edad);
  }
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
function cargarCie10() {
  const select = document.getElementById('cie10_principal');
  if (!select) return;
  $.getJSON(BASE_URL + '/api/cie10', function(resp) {
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
  const select = document.getElementById(selectId);
  if (!select) return;
  $.getJSON(BASE_URL + '/api/cie10', function(resp) {
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
function agregarDiagnosticoSecundario() {
  countDiagSecundarios++;
  const container = document.getElementById('diagnosticos_secundarios_container');
  const rowDiv = document.createElement('div');
  rowDiv.className = 'row mb-2';
  rowDiv.id = 'diag_secundario_' + countDiagSecundarios;
  rowDiv.innerHTML = `
    <div class="col-sm-6">
      <select class="form-control cie10-secondary" id="cie10_secundario_${countDiagSecundarios}" name="cie10_secundarios[]">
        <option value="">Seleccionar diagnóstico</option>
      </select>
    </div>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="nota_diag_secundario_${countDiagSecundarios}" placeholder="Nota diagnóstico (opcional)">
    </div>
    <div class="col-sm-1 d-flex align-items-end">
      <button type="button" class="btn btn-sm btn-danger" onclick="removerDiagnosticoSecundario(${countDiagSecundarios})">
        <i class="fas fa-trash"></i>
      </button>
    </div>
  `;
  container.appendChild(rowDiv);
  cargarCie10Secondary('cie10_secundario_' + countDiagSecundarios);
}
function removerDiagnosticoSecundario(id) {
  const row = document.getElementById('diag_secundario_' + id);
  if (row) {
    row.remove();
  }
}
$(function() {
  cargarMedicamentos();
  // Evento para llenar presentación automáticamente
  $('#sel_medicamento').on('change', function() {
    llenarPresentacionMedicamento();
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
  // Buscar paciente por documento
  $('#numdoc_paciente').on('blur', function() {
    buscarPaciente(this.value.trim());
  });
  $('#numdoc_paciente').on('keypress', function(e) {
    if (e.which === 13) {
      e.preventDefault();
      buscarPaciente(this.value.trim());
    }
  });
  cargarCie10();
  $('#btn_agregar_diagnostico').on('click', function(e) {
    e.preventDefault();
    agregarDiagnosticoSecundario();
  });
  // Serializar y guardar atención perinatal igual que ginecológica
  $('form').on('submit', function(e) {
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
    // Serializar exámenes médicos
    const examenes = [];
    $('#tabla_analisis_body tr').each(function() {
      const tds = $(this).find('td');
      if (tds.length >= 3) {
        const nombreExamen = tds.eq(2).text();
        const observacion = tds.eq(3).text() || '';
        let id_tipexam = null;
        $('#examen_medico option').each(function() {
          if ($(this).text() === nombreExamen) {
            id_tipexam = $(this).val();
          }
        });
        if (id_tipexam) {
          examenes.push({ id_tipexam, observacion });
        }
      }
    });
    // Serializar tratamientos
    const tratamientos = [];
    $('#medicamentos_tabla tr').each(function() {
      const tds = $(this).find('td');
      if (tds.length >= 7) {
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
    $.post(BASE_URL + '/system/registrar_atencion_perinatal.php', formData, function(resp) {
      if (resp.success) {
        alert('Registro perinatal exitoso');
      } else {
        alert('Error al registrar: ' + (resp.message || ''));
      }
    }, 'json').fail(function() {
      alert('Error de conexión al registrar');
    });
  });
});
</script>
</body>
</html>
<?php include __DIR__ . '/../layout/footer.php'; ?>
