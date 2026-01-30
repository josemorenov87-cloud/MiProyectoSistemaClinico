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
            border-left: 4px solid #6610f2;
        }
    </style>

  <link rel="icon" href="ruta/a/tu/icono.png" type="image/png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../public/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../public/dist/css/adminlte.min.css">
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
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Paciente</label>
                        <input type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Historia Clinica</label>
                        <input type="text" class="form-control" disabled>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Edad</label>
                        <input type="text" class="form-control" disabled>
                      </div>
                    </div>
                  </div>
                  <h2 class="section-title text-lg font-semibold p-2 mb-3">Signos Vitales</h2>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Temperatura (°C)</label>
                        <input type="text" class="form-control" disabled>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Presión Arterial (mmHg)</label>
                        <input type="text" class="form-control" disabled>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>SpO2 (%)</label>
                        <input type="text" class="form-control" disabled>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Pulso (lpm)</label>
                        <input type="text" class="form-control" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Talla (cm)</label>
                        <input type="text" class="form-control" disabled>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Peso (kg)</label>
                        <input type="text" class="form-control" disabled>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>IMC</label>
                        <input type="text" class="form-control" disabled>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Interpretación IMC</label>
                        <input type="text" class="form-control" disabled>
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
                        <label>Diagnostico</label>
                        <textarea class="form-control" rows="3"></textarea>
                      </div>
                    </div>
                  </div>
                  <div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Antecedentes</label>
                        <textarea class="form-control" rows="3"></textarea>
                      </div>
                    </div>
                  </div>
                  <h2 class="section-title text-lg font-semibold p-2 mb-3">Examenes Médicos</h2>
                  <div class="row">
                    <div class="col-sm-10">
                      <!-- select -->
                      <div class="form-group">
                        <label>Examen Medico</label>
                          <select class="form-control">                            
                            <option value="">Seleccionar Examen Médico</option>
                            <option>Ecografía</option>
                            <option>Mamografía</option>
                            <option>Papanicolao</option>
                            <option>Colposcopia</option>
                          </select>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Cantidad</label>
                        <input type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <button type="submit" class="btn btn-info">Agregar</button>
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
                              <th>Tipo de Examen</th>
                              <th>Cantidad</th>                              
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1.</td>
                              <td>Ecografía</td>
                              <td>1</td>
                            </tr>
                            <tr>
                              <td>2.</td>
                              <td>Colposcopia</td>
                              <td>1</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <h2 class="section-title text-lg font-semibold p-2 mb-3">Tratamiento - Receta Médica</h2>
                  <br>
                  <div class="row">
                    <div class="col-sm-5">
                      <!-- select -->
                      <div class="form-group">
                        <label>Medicamento</label>
                        <select class="form-control">                            
                            <option value="">Seleccionar Medicamento</option>
                            <option>Levonorgestrel 100mg</option>
                            <option>Medroxiprogesterona 325mg</option>
                            <option>Piperacilina 250mg</option>
                            <option>Tramadol 35mg + Paracetamol 50mg</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Presentación</label>
                        <input type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-sm-1">
                      <div class="form-group">
                        <label>Dosis</label>
                        <input type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Frec. de admin.</label>
                        <input type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Durac. del Trat.</label>
                        <input type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <button type="submit" class="btn btn-info">Agregar</button>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <!-- <label>Textarea</label> 
                        <textarea class="form-control" rows="3"></textarea> -->
                        <table class="table table-sm">
                          <thead>
                            <tr>
                              <th style="width: 10px">#</th>
                              <th>Medicamento</th>
                              <th>Presentación</th>
                              <th>Dosis</th>
                              <th>Frecuencia</th>
                              <th>Dias</th>
                              <th>Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1.</td>
                              <td>Levonorgestrel 100mg</td>
                              <td>Capsulas</td>
                              <td>2 unidades</td>
                              <td>Cada 8 Horas</td>
                              <td>x 5 dias</td>
                              <td>90 unidades</td>
                            </tr>
                            <tr>
                              <td>2.</td>
                              <td>Medroxiprogesterona 325mg</td>
                              <td>Comprimidos</td>
                              <td>1.5 unidades</td>
                              <td>Cada 12 Horas</td>
                              <td>x 5 dias</td>
                              <td>15 unidades</td>
                            </tr>
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
</body>
</html>