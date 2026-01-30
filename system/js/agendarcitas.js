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

  // Modal abrir cita
  function openModal(app) {
    modalPatient.textContent = app.patient;
    modalDate.textContent = formatDate(app.date);
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