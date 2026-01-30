// Migrated JS from system/js/agendarcitas.js
// (no server calls; pure client-side calendar + localStorage)

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

  const weekDays = ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'];
  let currentYear, currentMonth;

  btnRegister?.addEventListener('click', () => {
    btnRegister.classList.add('active');
    btnRegister.setAttribute('aria-pressed', 'true');
    btnCalendar?.classList.remove('active');
    btnCalendar?.setAttribute('aria-pressed', 'false');
    viewRegister.style.display = 'block';
    viewCalendar.style.display = 'none';
  });
  btnCalendar?.addEventListener('click', () => {
    btnCalendar.classList.add('active');
    btnCalendar.setAttribute('aria-pressed', 'true');
    btnRegister?.classList.remove('active');
    btnRegister?.setAttribute('aria-pressed', 'false');
    viewCalendar.style.display = 'block';
    viewRegister.style.display = 'none';
    const today = new Date();
    currentYear = today.getFullYear();
    currentMonth = today.getMonth();
    renderCalendar(currentYear, currentMonth);
  });

  form?.addEventListener('submit', (e) => {
    e.preventDefault();
    if (!form.checkValidity()) { form.reportValidity(); return; }
    const patientName = form.patientName.value.trim();
    const appointmentDate = form.appointmentDate.value;
    const appointmentTime = form.appointmentTime.value;
    const appointmentReason = form.appointmentReason.value.trim();

    if (!patientName || !appointmentDate || !appointmentTime) {
      alert('Por favor, complete los campos requeridos.');
      return;
    }

    const existingAppointments = getAppointments();
    const overlap = existingAppointments.some(app => app.date === appointmentDate && app.time === appointmentTime);
    if (overlap) {
      alert('Ya hay una cita reservada a esa fecha y hora. Por favor elija otra.');
      return;
    }

    const newAppointment = { id: Date.now(), patient: patientName, date: appointmentDate, time: appointmentTime, reason: appointmentReason };
    existingAppointments.push(newAppointment);
    saveAppointments(existingAppointments);
    alert('Cita guardada correctamente.');
    form.reset();
  });

  function getAppointments() { const data = localStorage.getItem('appointments'); return data ? JSON.parse(data) : []; }
  function saveAppointments(appointments) { localStorage.setItem('appointments', JSON.stringify(appointments)); }

  function renderCalendar(year, month) {
    calendarMonthYear.textContent = `${getMonthName(month)} ${year}`;
    while(calendarGrid.children.length > 7){ calendarGrid.removeChild(calendarGrid.lastChild); }
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    let startDay = firstDay.getDay() - 1; if (startDay < 0) startDay = 6;
    const daysPrevMonth = startDay;
    const daysInMonth = lastDay.getDate();
    const totalCells = 42;
    const appointments = getAppointments();
    const monthAppointments = appointments.filter(app => { const d = new Date(app.date); return d.getFullYear() === year && d.getMonth() === month; });
    const prevMonthLastDay = new Date(year, month, 0).getDate();

    for (let i = 0; i < totalCells; i++) {
      const dayDiv = document.createElement('div'); dayDiv.classList.add('calendar-day');
      let dayNum = i - daysPrevMonth + 1; let dateObj;
      if (i < daysPrevMonth) { dayDiv.classList.add('outside'); dayNum = prevMonthLastDay - daysPrevMonth + i + 1; dateObj = new Date(year, month - 1, dayNum); }
      else if (dayNum > daysInMonth) { dayDiv.classList.add('outside'); dayNum = dayNum - daysInMonth; dateObj = new Date(year, month + 1, dayNum); }
      else { dateObj = new Date(year, month, dayNum); }
      const dateISO = dateObj.toISOString().slice(0,10);
      const dateNumber = document.createElement('div'); dateNumber.classList.add('date-number'); dateNumber.textContent = dayNum; dayDiv.appendChild(dateNumber);
      const appointmentsContainer = document.createElement('div'); appointmentsContainer.classList.add('appointments');
      const appsForDay = monthAppointments.filter(app => app.date === dateISO); appsForDay.sort((a,b) => a.time.localeCompare(b.time));
      appsForDay.forEach(app => { const appDiv = document.createElement('div'); appDiv.classList.add('appointment'); appDiv.textContent = `${app.time} - ${app.patient}`; appDiv.tabIndex = 0; appDiv.setAttribute('role', 'button'); appDiv.setAttribute('aria-label', `Cita a las ${app.time} con ${app.patient}`); appDiv.addEventListener('click', () => openModal(app)); appDiv.addEventListener('keydown', (e) => { if (e.key === 'Enter' || e.key === ' ') openModal(app); }); appointmentsContainer.appendChild(appDiv); });
      dayDiv.appendChild(appointmentsContainer);
      calendarGrid.appendChild(dayDiv);
    }
  }

  function openModal(app) {
    modalPatient.textContent = app.patient; modalDate.textContent = formatDate(app.date); modalTime.textContent = app.time; modalReason.textContent = app.reason ? app.reason : 'Ninguno';
    modal.style.display = 'block'; modal.setAttribute('aria-hidden', 'false');
  }
  modalCloseBtn?.addEventListener('click', () => { modal.style.display = 'none'; modal.setAttribute('aria-hidden', 'true'); });
  window.addEventListener('click', (e) => { if (e.target === modal) { modal.style.display = 'none'; modal.setAttribute('aria-hidden', 'true'); } });

  function formatDate(dateStr) { const [y,m,d] = dateStr.split('-'); return `${d}/${m}/${y}`; }
  function getMonthName(monthIndex) { const months = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre']; return months[monthIndex]; }

  prevMonthBtn?.addEventListener('click', () => { currentMonth--; if (currentMonth < 0) { currentMonth = 11; currentYear--; } renderCalendar(currentYear, currentMonth); });
  nextMonthBtn?.addEventListener('click', () => { currentMonth++; if (currentMonth > 11) { currentMonth = 0; currentYear++; } renderCalendar(currentYear, currentMonth); });
