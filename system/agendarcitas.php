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

  <style>
  /* Reset & base */
  
/*   body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f0f4f8;
    margin: 0;
    padding: 0;
    color: #333;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
  } */
  header {
    background: #4c7ef3;
    width: 100%;
    padding: 1rem 2rem;
    color: white;
    font-weight: 700;
    font-size: 1.5rem;
    box-shadow: 0 3px 6px rgba(0,0,0,0.12);
  }
  main {
    width: 100%;
    max-width: 900px;
    padding: 2rem;
    flex-grow: 1;
  }
  .nav-buttons {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-bottom: 2rem;
  }
  button {
    background: #4c7ef3;
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
    border-radius: 6px;
    cursor: pointer;
    box-shadow: 0 3px 6px rgba(76,126,243,.4);
    transition: background 0.3s ease;
  }
  button:hover, button.active {
    background: #365dc1;
    box-shadow: 0 4px 8px rgba(54,93,193,.6);
  }
  form {
    background: white;
    padding: 1.5rem 2rem;
    border-radius: 10px;
    box-shadow: 0 6px 12px rgba(76,126,243, 0.15);
    max-width: 480px;
    margin: 0 auto;
  }
  form h2 {
    margin-top: 0;
    margin-bottom: 1.5rem;
    color: #4c7ef3;
  }
  label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
  }
  input, select, textarea {
    width: 100%;
    padding: 0.5rem 0.75rem;
    margin-bottom: 1.25rem;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 1rem;
    transition: border-color 0.3s ease;
  }
  input:focus, select:focus, textarea:focus {
    border-color: #4c7ef3;
    outline: none;
  }
  textarea {
    resize: vertical;
    min-height: 80px;
  }
  .calendar-container {
    background: white;
    padding: 1rem 1rem 1.5rem 1rem;
    border-radius: 10px;
    box-shadow: 0 6px 12px rgba(76,126,243, 0.15);
    max-width: 900px;
    margin: 0 auto;
  }
  .calendar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
  }
  .calendar-header h2 {
    margin: 0;
    color: #4c7ef3;
  }
  .calendar-header button {
    padding: 0.5rem 1rem;
    font-size: 1.1rem;
  }
  .calendar-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 5px;
  }
  .day-name {
    text-align: center;
    font-weight: 700;
    color: #4c7ef3;
    padding: 0.5rem 0;
    border-bottom: 2px solid #4c7ef3;
  }
  .calendar-day {
    background: #e4ecff;
    border-radius: 8px;
    min-height: 90px;
    padding: 6px 8px;
    display: flex;
    flex-direction: column;
  }
  .calendar-day.outside {
    background: #f9faff;
    color: #bbb;
  }
  .calendar-day .date-number {
    font-weight: 700;
    margin-bottom: 4px;
  }
  .appointments {
    flex-grow: 1;
    overflow-y: auto;
  }
  .appointment {
    background: #4c7ef3;
    color: white;
    font-size: 0.8rem;
    border-radius: 6px;
    padding: 2px 6px;
    margin-bottom: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  .appointment:hover {
    background: #365dc1;
  }
  /* Modal styles */
  .modal {
    position: fixed;
    top: 0;
    left: 0;
    right:0;
    bottom: 0;
    background: rgba(0,0,0,0.4);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 20;
  }
  .modal.active {
    display: flex;
  }
  .modal-content {
    background: white;
    padding: 1.5rem 2rem;
    border-radius: 12px;
    max-width: 400px;
    width: 90%;
    box-shadow: 0 8px 16px rgba(0,0,0,0.25);
    position: relative;
    text-align: center;
  }
  .modal-content h3 {
    margin-top: 0;
    margin-bottom: 1rem;
    color: #4c7ef3;
  }
  .modal-content p {
    margin-bottom: 1rem;
    font-size: 1rem;
  }
  .modal-close {
    position: absolute;
    top: 12px;
    right: 12px;
    background: transparent;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: #aaa;
    transition: color 0.3s ease;
  }
  .modal-close:hover {
    color: #4c7ef3;
  }
/* Responsive 
  @media (max-width: 640px) {
    main {
      padding: 1rem;
    }
    .calendar-day {
      min-height: 70px;
      font-size: 0.75rem;
    }
    .appointment {
      font-size: 0.7rem;
      padding: 1px 4px;
    }
  }*/
</style>

  <link rel="icon" href="ruta/a/tu/icono.png" type="image/png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
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
            <h1 class="m-0">Agendamiento de citas</h1>
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
            
            <div class="card card-primary card-outline">

              <main>
                <div class="nav-buttons">
                  <button id="btn-register" class="active" aria-pressed="true">Registrar Cita</button>
                  <button id="btn-calendar" aria-pressed="false">Ver Calendario</button>
                </div>
                  <!-- Vista Registro de Cita -->
                  <section id="view-register">
                    <form id="appointment-form" aria-label="Formulario de registro de citas médicas" novalidate>
                      <h2>Registrar Nueva Cita</h2>
                      <label for="patient-name" class="block text-sm font-medium text-gray-700 required">Nombre del Paciente</label>
                      <input type="text" id="patient-name" name="patientName" placeholder="Nombre completo" required minlength="3" />
                      <!--
                      <select id="patient-name" name="patient-name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                          <option value="">Seleccionar Paciente</option>
                          <option value="José Moreno">José Moreno</option>
                          <option value="Lorena Vega">Lorena Vega</option>
                          <option value="Juan Perez">Juan Perez</option>
                      </select>
                      -->
                      <label for="appointment-date">Fecha</label>
                      <input type="date" id="appointment-date" name="appointmentDate" required />
                      <label for="appointment-time">Hora</label>
                      <input type="time" id="appointment-time" name="appointmentTime" required />
                      <label for="appointment-reason">Motivo / Observaciones</label>
                      <textarea id="appointment-reason" name="appointmentReason" placeholder="Describa el motivo de la cita"></textarea>
                      <button type="submit">Guardar Cita</button>
                    </form>
                  </section>

                  <!-- Vista Calendario -->
                  <section id="view-calendar" style="display:none;">
                    <div class="calendar-container" aria-label="Calendario de citas médicas">
                      <div class="calendar-header">
                        <button id="prev-month" aria-label="Mes anterior">&lt;</button>
                        <h2 id="calendar-month-year"></h2>
                        <button id="next-month" aria-label="Mes siguiente">&gt;</button>
                      </div>
                      <div class="calendar-grid" aria-live="polite" aria-atomic="true">
                        <!-- Días de la semana -->
                        <div class="day-name">Lun</div>
                        <div class="day-name">Mar</div>
                        <div class="day-name">Mié</div>
                        <div class="day-name">Jue</div>
                        <div class="day-name">Vie</div>
                        <div class="day-name">Sáb</div>
                        <div class="day-name">Dom</div>
                        <!-- Los días se generan dinámicamente -->
                      </div>
                    </div>
                  </section>
                </main>

<!-- Modal detalle cita -->
<div id="modal-appointment" class="modal" role="dialog" aria-modal="true" aria-labelledby="modal-title" tabindex="-1">
  <div class="modal-content">
    <button class="modal-close" aria-label="Cerrar">&times;</button>
    <h3 id="modal-title">Detalle de la Cita</h3>
    <p><strong>Paciente:</strong> <span id="modal-patient"></span></p>
    <!-- <p><strong>Fecha:</strong> <span id="modal-date"></span></p> -->
    <p><strong>Hora:</strong> <span id="modal-time"></span></p>
    <p><strong>Motivo:</strong> <span id="modal-reason"></span></p>
  </div>
</div>

<script>
  // Variables de referencia DOM
  const btnRegister = document.getElementById('btn-register');
  const btnCalendar = document.getElementById('btn-calendar');
  const viewRegister = document.getElementById('view-register');
  const viewCalendar = document.getElementById('view-calendar');
  const form = document.getElementById('appointment-form');
  const calendarGrid = viewCalendar.querySelector('.calendar-grid');
  const calendarMonthYear = document.getElementById('calendar-month-year');
  const prevMonthBtn = document.getElementById('prev-month');
  const nextMonthBtn = document.getElementById('next-month');
  const modal = document.getElementById('modal-appointment');
  const modalCloseBtn = modal.querySelector('.modal-close');
  const modalPatient = document.getElementById('modal-patient');
  const modalDate = document.getElementById('modal-date');
  const modalTime = document.getElementById('modal-time');
  const modalReason = document.getElementById('modal-reason');

  // Variables calendario
  const weekDays = ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'];
  let currentYear, currentMonth;

  // Manejo vista: alternar entre registro y calendario
  btnRegister.addEventListener('click', () => {
    btnRegister.classList.add('active');
    btnRegister.setAttribute('aria-pressed', 'true');
    btnCalendar.classList.remove('active');
    btnCalendar.setAttribute('aria-pressed', 'false');
    viewRegister.style.display = 'block';
    viewCalendar.style.display = 'none';
  });
  btnCalendar.addEventListener('click', () => {
    btnCalendar.classList.add('active');
    btnCalendar.setAttribute('aria-pressed', 'true');
    btnRegister.classList.remove('active');
    btnRegister.setAttribute('aria-pressed', 'false');
    viewCalendar.style.display = 'block';
    viewRegister.style.display = 'none';
    // Renderizar calendario en mes/año actual
    const today = new Date();
    currentYear = today.getFullYear();
    currentMonth = today.getMonth();
    renderCalendar(currentYear, currentMonth);
  });

  // Formulario submit - guardar cita
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    if (!form.checkValidity()) {
      form.reportValidity();
      return;
    }
    const patientName = form.patientName.value.trim();
    const appointmentDate = form.appointmentDate.value;
    const appointmentTime = form.appointmentTime.value;
    const appointmentReason = form.appointmentReason.value.trim();

    if (!patientName || !appointmentDate || !appointmentTime) {
      alert('Por favor, complete los campos requeridos.');
      return;
    }

    const existingAppointments = getAppointments();
    // Validar que no haya cita en esa fecha y hora
    const overlap = existingAppointments.some(app =>
      app.date === appointmentDate && app.time === appointmentTime
    );
    if (overlap) {
      alert('Ya hay una cita reservada a esa fecha y hora. Por favor elija otra.');
      return;
    }

    const newAppointment = {
      id: Date.now(),
      patient: patientName,
      date: appointmentDate,
      time: appointmentTime,
      reason: appointmentReason
    };

    existingAppointments.push(newAppointment);
    saveAppointments(existingAppointments);
    alert('Cita guardada correctamente.');
    form.reset();
  });

  // Obtener citas de localStorage
  function getAppointments() {
    const data = localStorage.getItem('appointments');
    return data ? JSON.parse(data) : [];
  }
  // Guardar citas en localStorage
  function saveAppointments(appointments) {
    localStorage.setItem('appointments', JSON.stringify(appointments));
  }

  // Renderizar calendario
  function renderCalendar(year, month) {
    calendarMonthYear.textContent = `${getMonthName(month)} ${year}`;
    // Limpiar días (los 7 nombres de días no borrar)
    const totalGridChildren = calendarGrid.children.length;
    // Quitar todos menos los primeros 7 hijos (headers días)
    while(calendarGrid.children.length > 7){
      calendarGrid.removeChild(calendarGrid.lastChild);
    }

    // Primer día del mes y último día
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);

    // Día de la semana del primer día (lunes=1, domingo=7 y DOM es 0 en JS)
    // Ajustaremos para lunes=0 ... domingo=6 para la grid
    let startDay = firstDay.getDay() - 1;
    if (startDay < 0) startDay = 6; // si es domingo

    // Días previos del mes anterior para completar semana
    // Para mostrar días del mes anterior (relleno)
    const daysPrevMonth = startDay;

    // Días del mes
    const daysInMonth = lastDay.getDate();

    // Para la generación de días vamos a mostrar 42 días para tener 6 semanas completas
    // 42 = 7 días * 6 semanas (para igualar calendario)
    const totalCells = 42;

    // Obtener citas para el mes mostrado (string de formato aaaa-mm-dd)
    const appointments = getAppointments();
    // Filtrar citas solo de mes y año actual
    const monthAppointments = appointments.filter(app => {
      const d = new Date(app.date);
      return d.getFullYear() === year && d.getMonth() === month;
    });

    // Días del mes anterior (para relleno)
    const prevMonthLastDay = new Date(year, month, 0).getDate();

    for (let i = 0; i < totalCells; i++) {
      const dayDiv = document.createElement('div');
      dayDiv.classList.add('calendar-day');
      // Calcular el día relativo a la cuadrícula
      
      let dayNum = i - daysPrevMonth + 1;
      let dateObj;
      if (i < daysPrevMonth) {
        // Días del mes anterior
        dayDiv.classList.add('outside');
        dayNum = prevMonthLastDay - daysPrevMonth + i + 1;
        dateObj = new Date(year, month - 1, dayNum);
      } else if (dayNum > daysInMonth) {
        // Días del mes siguiente
        dayDiv.classList.add('outside');
        dayNum = dayNum - daysInMonth;
        dateObj = new Date(year, month + 1, dayNum);
      } else {
        // Días del mes actual
        dateObj = new Date(year, month, dayNum);
      }

      // Usar formato ISO yyyy-mm-dd para identificar el día
      const dateISO = dateObj.toISOString().slice(0,10);

      // Número de día
      const dateNumber = document.createElement('div');
      dateNumber.classList.add('date-number');
      dateNumber.textContent = dayNum;
      dayDiv.appendChild(dateNumber);

      // Contenedor para citas
      const appointmentsContainer = document.createElement('div');
      appointmentsContainer.classList.add('appointments');

      // Agregar citas de ese día
      const appsForDay = monthAppointments.filter(app => app.date === dateISO);
      // Ordenar por hora ascendente
      appsForDay.sort((a,b) => a.time.localeCompare(b.time));

      appsForDay.forEach(app => {
        const appDiv = document.createElement('div');
        appDiv.classList.add('appointment');
        appDiv.textContent = `${app.time} - ${app.patient}`;
        appDiv.tabIndex = 0;
        appDiv.setAttribute('role', 'button');
        appDiv.setAttribute('aria-label', `Cita a las ${app.time} con ${app.patient}`);
        appDiv.addEventListener('click', () => openModal(app));
        appDiv.addEventListener('keydown', (e) => { if (e.key === 'Enter' || e.key === ' ') openModal(app); });
        appointmentsContainer.appendChild(appDiv);
      });

      dayDiv.appendChild(appointmentsContainer);

      calendarGrid.appendChild(dayDiv);
    }
  }

  // Modal abrir cita - revisar cita
  function openModal(app) {
    modalPatient.textContent = app.patient;
    //modalDate.textContent = formatDate(app.date);
    modalTime.textContent = app.time;
    modalReason.textContent = app.reason ? app.reason : 'Ninguno';
    modal.classList.add('active');
    modal.focus();
  }
  // Modal cerrar cita
  modalCloseBtn.addEventListener('click', () => {
    modal.classList.remove('active');
  });
  // Permitir cerrar modal con Escape
  window.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && modal.classList.contains('active')) {
      modal.classList.remove('active');
    }
  });

  // Función para obtener nombre del mes
  function getMonthName(monthIndex) {
    const monthNames = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    return monthNames[monthIndex];
  }
  // Formatear fecha a dd/mm/aaaa
  function formatDate(dateStr) {
    const d = new Date(dateStr);
    const day = d.getDate().toString().padStart(2,'0');
    const month = (d.getMonth()+1).toString().padStart(2,'0');
    const year = d.getFullYear();
    return `${day}/${month}/${year}`;
  }

  // Navegar meses del calendario
  prevMonthBtn.addEventListener('click', () => {
    if (currentMonth === 0) {
      currentMonth = 11;
      currentYear--;
    } else {
      currentMonth--;
    }
    renderCalendar(currentYear, currentMonth);
  });
  nextMonthBtn.addEventListener('click', () => {
    if (currentMonth === 11) {
      currentMonth = 0;
      currentYear++;
    } else {
      currentMonth++;
    }
    renderCalendar(currentYear, currentMonth);
  });

  // Inicialización: mostrar vista de registro
  btnRegister.click();
</script>

            </div><!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          <!-- <div class="col-lg-4">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Featured</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">Special title treatment</h6>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
          </div> -->
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
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>