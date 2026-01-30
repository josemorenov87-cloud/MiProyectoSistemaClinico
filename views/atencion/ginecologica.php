<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../app/controllers/AuthController.php';
\App\Controllers\AuthController::checkAuth();
$pageTitle = 'Atención Ginecológica';
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
            background-color: #fde0fcff;
            border-left: 4px solid #f012be;
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
            <h1 class="m-0">Atención Ginecológica</h1>
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
            <div class="card card-fuchsia">            
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
                        <!-- <label>Textarea</label> -->
                          <label>Maniobras realizadas en el Examen</label>
                        <textarea class="form-control" rows="3"></textarea>
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
                  <div class="row">
                    <div class="col-sm-6 text-center">
                      <label for="" class="font-weight-bold">Utero</label><br>
                      <img id="img-utero" src="/www.sistemaclinico2.com/public/img/utero-removebg-preview.png" alt="utero" style="max-width: 90%; max-height: 250px; cursor:pointer; border:2px solid #f012be; border-radius:8px;" onclick="openImageEditor('utero')">
                    </div>
                    <div class="col-sm-6 text-center">
                      <label for="" class="font-weight-bold">Cérvix</label><br>
                      <img id="img-cervix" src="/www.sistemaclinico2.com/public/img/cervix-removebg-preview.png" alt="cervix" style="max-width: 90%; max-height: 250px; cursor:pointer; border:2px solid #f012be; border-radius:8px;" onclick="openImageEditor('cervix')">
                    </div>
                  </div>
                  <!-- Modal Editor de Imagen -->
                  <div class="modal fade" id="imageEditorModal" tabindex="-1" role="dialog" aria-labelledby="imageEditorModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                      <div class="modal-content shadow-lg" style="border-radius: 18px;">
                        <div class="modal-header bg-fuchsia-100" style="border-top-left-radius: 18px; border-top-right-radius: 18px;">
                          <h4 class="modal-title font-weight-bold text-fuchsia-900" id="imageEditorModalLabel">
                            <i class="fas fa-edit"></i> Editor de Imagen Didáctico
                          </h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size:2rem;">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body bg-light" style="padding: 2rem;">
                          <div class="d-flex flex-wrap align-items-center mb-3 gap-2" style="gap: 0.5rem;">
                            <button class="btn btn-outline-primary btn-sm mx-1" id="btnAddRect" title="Dibujar rectángulo"><i class="fas fa-vector-square"></i></button>
                            <button class="btn btn-outline-success btn-sm mx-1" id="btnAddCircle" title="Dibujar círculo"><i class="fas fa-circle"></i></button>
                            <button class="btn btn-outline-secondary btn-sm mx-1" id="btnAddArrow" title="Dibujar flecha"><i class="fas fa-long-arrow-alt-right"></i></button>
                            <button class="btn btn-outline-info btn-sm mx-1" id="btnAddText" title="Agregar texto"><i class="fas fa-font"></i></button>
                            <button class="btn btn-outline-warning btn-sm mx-1" id="btnAddDate" title="Agregar fecha"><i class="fas fa-calendar-alt"></i></button>
                            <input type="color" id="rectColor" value="#f012be" title="Color de figura" class="mx-1" style="width:32px; height:32px; border:none;">
                            <input type="color" id="textColor" value="#222222" title="Color de texto" class="mx-1" style="width:32px; height:32px; border:none;">
                            <select id="textSize" class="form-control form-control-sm d-inline-block mx-1" style="width:80px;">
                              <option value="16">16px</option>
                              <option value="20" selected>20px</option>
                              <option value="28">28px</option>
                              <option value="36">36px</option>
                              <option value="48">48px</option>
                            </select>
                            <button class="btn btn-outline-danger btn-sm mx-1" id="btnDeleteObject" title="Eliminar seleccionado"><i class="fas fa-trash"></i></button>
                            <button class="btn btn-outline-dark btn-sm mx-1" id="btnUndo" title="Deshacer"><i class="fas fa-undo"></i></button>
                            <button class="btn btn-outline-dark btn-sm mx-1" id="btnRedo" title="Rehacer"><i class="fas fa-redo"></i></button>
                            <button class="btn btn-outline-secondary btn-sm mx-1" id="btnClearCanvas" title="Limpiar todo"><i class="fas fa-eraser"></i></button>
                            <button class="btn btn-outline-success btn-sm mx-1" id="btnDownloadImage" title="Descargar imagen"><i class="fas fa-download"></i></button>
                          </div>
                          <div class="d-flex justify-content-center">
                            <canvas id="editorCanvas" width="700" height="400" style="border:2px solid #f012be; border-radius:12px; background:#fff;"></canvas>
                          </div>
                        </div>
                        <div class="modal-footer bg-fuchsia-50" style="border-bottom-left-radius: 18px; border-bottom-right-radius: 18px;">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                          <button type="button" class="btn btn-success" id="btnSaveImage">Guardar Cambios</button>
                          <button type="button" class="btn btn-fuchsia" id="btnSaveServer" style="background:#f012be; color:#fff;">Guardar en Servidor</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <br>
                  <h2 class="section-title text-lg font-semibold p-2 mb-3">Orden de Análisis Clínicos</h2>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Tipo de Examen</label>
                        <select class="form-control" id="grupo_analisis" name="grupo_analisis">
                          <option value="">Seleccionar Grupo de Análisis</option>
                          <?php
                          // Llenar el select con los grupos desde la BD
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
                        <!-- <label>Textarea</label>                         
                        <textarea class="form-control" rows="3"></textarea>--> 
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
                            <!-- Vacío al cargar, se llenará por JS -->
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
                    <!-- Script de autollenado movido al final del body -->
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
<script src="/www.sistemaclinico2.com/public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/www.sistemaclinico2.com/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/www.sistemaclinico2.com/public/dist/js/adminlte.min.js"></script>
<!-- Script para análisis clínicos -->
<script src="/www.sistemaclinico2.com/public/js/ginecologica-analisis.js"></script>
<!-- Fabric.js para edición avanzada -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.0/fabric.min.js"></script>
<script>

let fabricCanvas, currentImgType = null, originalImgUrl = '', undoStack = [], redoStack = [];
function openImageEditor(type, retryCount = 0) {
  currentImgType = type;
  let imgUrl = '';
  if(type === 'utero') imgUrl = document.getElementById('img-utero').src;
  if(type === 'cervix') imgUrl = document.getElementById('img-cervix').src;
  originalImgUrl = imgUrl;
  $('#imageEditorModal').modal('show');
  setTimeout(() => {
    if(fabricCanvas) {
      fabricCanvas.dispose();
      fabricCanvas = null;
    }
    fabricCanvas = new fabric.Canvas('editorCanvas');
    fabricCanvas.setWidth(700); fabricCanvas.setHeight(400);
    // Cargar imagen de fondo y forzar renderizado inmediato
    fabric.Image.fromURL(imgUrl, function(img) {
      if (!img && retryCount < 2) {
        // Si no carga, reintentar una vez más tras 200ms
        setTimeout(() => openImageEditor(type, retryCount + 1), 200);
        return;
      }
      if (img) {
        fabricCanvas.setBackgroundImage(img, fabricCanvas.renderAll.bind(fabricCanvas), {
          scaleX: 700/img.width,
          scaleY: 400/img.height
        });
        fabricCanvas.requestRenderAll();
      }
    }, { crossOrigin: 'anonymous' });
    undoStack = [];
    redoStack = [];
    fabricCanvas.on('object:added', saveState);
    fabricCanvas.on('object:modified', saveState);
    fabricCanvas.on('object:removed', saveState);
  }, 10);
}

function saveState() {
  if (fabricCanvas) {
    undoStack.push(JSON.stringify(fabricCanvas.toDatalessJSON()));
    if (undoStack.length > 50) undoStack.shift();
    redoStack = [];
  }
}

$('#btnUndo').on('click', function() {
  if (undoStack.length > 1) {
    redoStack.push(undoStack.pop());
    fabricCanvas.loadFromJSON(undoStack[undoStack.length-1], fabricCanvas.renderAll.bind(fabricCanvas));
  }
});
$('#btnRedo').on('click', function() {
  if (redoStack.length > 0) {
    const state = redoStack.pop();
    undoStack.push(state);
    fabricCanvas.loadFromJSON(state, fabricCanvas.renderAll.bind(fabricCanvas));
  }
});
$('#btnClearCanvas').on('click', function() {
  if (confirm('¿Seguro que deseas limpiar todo el canvas?')) {
    fabricCanvas.getObjects().forEach(obj => { if (!obj.backgroundImage) fabricCanvas.remove(obj); });
    fabricCanvas.clear();
    fabric.Image.fromURL(originalImgUrl, function(img) {
      fabricCanvas.setBackgroundImage(img, fabricCanvas.renderAll.bind(fabricCanvas), {
        scaleX: 700/img.width,
        scaleY: 400/img.height
      });
    });
    undoStack = [];
    redoStack = [];
  }
});
$('#btnDownloadImage').on('click', function() {
  const dataUrl = fabricCanvas.toDataURL({format: 'png'});
  const a = document.createElement('a');
  a.href = dataUrl;
  a.download = 'imagen_editada.png';
  a.click();
});


$('#btnAddRect').on('click', function(e) {
  e.preventDefault();
  const color = document.getElementById('rectColor').value;
  const rect = new fabric.Rect({
    left: 100, top: 100, fill: color, width: 80, height: 60, opacity: 0.5, selectable: true
  });
  fabricCanvas.add(rect).setActiveObject(rect);
});

$('#btnAddCircle').on('click', function(e) {
  e.preventDefault();
  const color = document.getElementById('rectColor').value;
  const circle = new fabric.Circle({
    left: 150, top: 150, fill: color, radius: 40, opacity: 0.5, selectable: true
  });
  fabricCanvas.add(circle).setActiveObject(circle);
});

$('#btnAddArrow').off('click').on('click', function(e) {
  e.preventDefault();
  const color = document.getElementById('rectColor').value;
  // Flecha proporcionada y alineada
  const startX = 0, startY = 25, endX = 100, endY = 25;
  const line = new fabric.Line([startX, startY, endX, endY], {
    stroke: color, strokeWidth: 5, selectable: false, evented: false
  });
  // Triángulo en la punta de la flecha
  const angle = Math.atan2(endY - startY, endX - startX);
  const arrowHead = new fabric.Triangle({
    left: endX, top: endY,
    originX: 'center', originY: 'center',
    angle: angle * 180 / Math.PI + 90,
    width: 20, height: 20, fill: color,
    selectable: false, evented: false
  });
  const group = new fabric.Group([line, arrowHead], {
    left: 200, top: 200, selectable: true, hasControls: true
  });
  fabricCanvas.add(group).setActiveObject(group);
});

$('#btnAddText').on('click', function(e) {
  e.preventDefault();
  const color = document.getElementById('textColor').value;
  const size = parseInt(document.getElementById('textSize').value) || 20;
  // Modal para texto personalizado
  const userText = prompt('Ingrese el texto a agregar:', 'Texto aquí');
  if (userText) {
    const text = new fabric.IText(userText, {
      left: 200, top: 200, fill: color, fontSize: size, fontWeight: 'bold', editable: true
    });
    fabricCanvas.add(text).setActiveObject(text);
  }
});

$('#btnAddDate').on('click', function(e) {
  e.preventDefault();
  const color = document.getElementById('textColor').value;
  const size = parseInt(document.getElementById('textSize').value) || 18;
  // Modal para fecha personalizada
  let today = new Date();
  let defaultDate = today.toLocaleDateString();
  const dateStr = prompt('Ingrese la fecha:', defaultDate);
  if (dateStr) {
    const text = new fabric.IText(dateStr, {
      left: 300, top: 300, fill: color, fontSize: size, fontStyle: 'italic', fontWeight: 'bold', editable: false
    });
    fabricCanvas.add(text).setActiveObject(text);
  }
});

$('#btnDeleteObject').on('click', function(e) {
  e.preventDefault();
  const obj = fabricCanvas.getActiveObject();
  if(obj) fabricCanvas.remove(obj);
});

$('#btnSaveServer').on('click', function(e) {
  e.preventDefault();
  const dataUrl = fabricCanvas.toDataURL({format: 'png'});
  // Enviar por AJAX a PHP para guardar en servidor
  $.ajax({
    url: '/www.sistemaclinico2.com/system/save_edited_image.php',
    method: 'POST',
    data: { imgType: currentImgType, imgData: dataUrl },
    success: function(resp) {
      if(resp && resp.success && resp.url) {
         if(currentImgType === 'utero') {
          document.getElementById('img-utero').src = resp.url + '?t=' + Date.now();
        } else if(currentImgType === 'cervix') {
          document.getElementById('img-cervix').src = resp.url + '?t=' + Date.now();
        }
        // Solo cerrar el modal, no actualizar la imagen ni recargar la vista
        $('#imageEditorModal').modal('hide');
        alert('Imagen guardada en el servidor correctamente.');
        // Opcional: mostrar notificación
        // alert('Imagen guardada en el servidor correctamente.');
      } else {
        alert('Error al guardar en el servidor.');
      }
    },
    error: function() { alert('Error de red al guardar en el servidor.'); }
  });
});

$('#btnSaveImage').on('click', function() {
  // Exportar canvas a dataURL y reemplazar imagen principal
  const dataUrl = fabricCanvas.toDataURL({format: 'png'});
  if(currentImgType === 'utero') {
    document.getElementById('img-utero').src = dataUrl;
  } else if(currentImgType === 'cervix') {
    document.getElementById('img-cervix').src = dataUrl;
  }
  // Exportar canvas a dataURL y solo cerrar el modal
  // (No actualizar||| la imagen principal en la vista)
  $('#imageEditorModal').modal('hide');
});
</script>
<script>
// --- Lógica de tratamiento igual a vista médica ---
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
});
</script>
</body>
<script>
// --- Lógica de búsqueda y autollenado igual a vista médica ---
const BASE_URL = '<?php echo BASE_URL; ?>';
let countDiagSecundarios = 0;
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
    // No hay triaje hoy, limpiar campos
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
  // Establecer la fecha de atención automáticamente a hoy
  const fechaAtencion = document.getElementById('fechaAtencion');
  if (fechaAtencion) {
    const today = new Date().toISOString().split('T')[0];
    fechaAtencion.value = today;
  }

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
  // Serializar y guardar atención ginecológica igual que médica
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
    $.post('/www.sistemaclinico2.com/system/registrar_atencion_ginecologica.php', formData, function(resp) {
      if (resp.success) {
        alert('Registro ginecológico exitoso');
        $('#imageEditorModal').modal('hide');
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
