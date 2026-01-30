$(function() {
    const calendarEl = document.getElementById('calendar');
    let calendar = null;
    let citas = [];
    let citasPorId = {};

    function initCalendar() {
        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },
            eventTimeFormat: { hour: '2-digit', minute: '2-digit', hour12: false },
            events: [],
            eventContent: function(arg) {
                // Show the time once across all views inside a green pill
                const time = arg.timeText || (arg.event.start ? arg.event.start.toLocaleTimeString('es-PE', { hour: '2-digit', minute: '2-digit', hour12: false }) : '');
                return { html: '<div class="fc-time-only-wrapper"><span class="fc-time-only">' + time + '</span></div>' };
            },
            dateClick: function(info) {
                mostrarModal(info.dateStr);
            },
            eventClick: function(info) {
                info.jsEvent.preventDefault();
                const dateStr = info.event.startStr.split('T')[0];
                mostrarModal(dateStr);
            }
        });
        calendar.render();
    }

    function cargarCitas() {
        $.ajax({
            url: BASE_URL + '/ver-cita-medico/listar',
            type: 'GET',
            dataType: 'json'
        }).done(function(response) {
            if (response.success) {
                citas = response.citas || [];
                sincronizarEventos();
            } else {
                mostrarError(response.mensaje || 'No se pudieron obtener las citas');
            }
        }).fail(function() {
            mostrarError('Error al obtener las citas');
        });
    }

    function sincronizarEventos() {
        if (!calendar) return;

        citasPorId = {};
        const eventos = citas.map(function(cita) {
            const titulo = ''; // we render time via eventContent to avoid duplication in list view
            citasPorId[cita.id_cita] = cita;

            return {
                id: cita.id_cita,
                title: titulo,
                start: cita.fecha_cita + 'T' + (cita.hora_cita || '00:00'),
                allDay: false
            };
        });

        calendar.removeAllEvents();
        calendar.addEventSource(eventos);
    }

    function mostrarModal(dateStr) {
        const citasDia = citas.filter(function(c) { return c.fecha_cita === dateStr; });
        $('#modalFecha').text(formatearFecha(dateStr));

        const contenedor = $('#citasList');
        contenedor.empty();

        if (citasDia.length === 0) {
            $('#alertSinCitas').removeClass('d-none');
        } else {
            $('#alertSinCitas').addClass('d-none');
            citasDia.forEach(function(cita) {
                const paciente = (cita.paciente_nombre && cita.paciente_nombre.trim().length > 0)
                    ? cita.paciente_nombre
                    : 'Paciente sin nombre';
                const documento = cita.numdoc_paciente ? cita.numdoc_paciente : 'Documento no registrado';
                const hora = cita.hora_cita || 'Hora no registrada';
                const especialidad = cita.especialidad_nombre || 'Especialidad no registrada';
                const motivo = cita.motivo_cita || 'Sin motivo';

                const item = [
                    '<div class="card mb-2 cita-card" data-id="' + cita.id_cita + '">',
                        '<div class="card-body p-3">',
                            '<div class="d-flex justify-content-between align-items-start">',
                                '<div>',
                                    '<h6 class="mb-1">' + paciente + '</h6>',
                                    '<div class="text-muted small">DNI: ' + documento + '</div>',
                                '</div>',
                                '<span class="badge badge-primary">' + hora + '</span>',
                            '</div>',
                            '<div class="mt-2">',
                                '<span class="badge badge-info mr-2">' + especialidad + '</span>',
                                '<span class="text-muted">' + motivo + '</span>',
                            '</div>',
                        '</div>',
                    '</div>'
                ].join('');

                contenedor.append(item);
            });

            $('.cita-card').off('click').on('click', function() {
                const id = $(this).data('id');
                mostrarDetalle(id);
            });
        }

        $('#modalCitas').modal('show');
    }

    function mostrarDetalle(idCita) {
        const cita = citasPorId[idCita] || citas.find(function(c) { return c.id_cita == idCita; });
        if (!cita) {
            mostrarError('No se encontró la cita seleccionada');
            return;
        }

        $('#detallePaciente').text(cita.paciente_nombre || 'Paciente sin nombre');
        $('#detalleDni').text(cita.numdoc_paciente || 'No registrado');
        $('#detalleEspecialidad').text(cita.especialidad_nombre || 'No registrada');
        $('#detalleFecha').text(formatearFecha(cita.fecha_cita));
        $('#detalleHora').text(cita.hora_cita || 'Hora no registrada');
        $('#detalleMotivo').text(cita.motivo_cita || 'Sin motivo');

        // Construir la URL con el número de documento y otros datos relevantes
        let url = '';
        const especialidad = (cita.especialidad_nombre || '').toUpperCase().trim();
        if (especialidad === 'GINECOLOGIA Y OBSTETRICIA') {
            url = BASE_URL + '/atencion/ginecologica?numdoc=' + encodeURIComponent(cita.numdoc_paciente || '');
            if (cita.paciente_nombre) url += '&paciente=' + encodeURIComponent(cita.paciente_nombre);
            if (cita.id_cita) url += '&id_cita=' + encodeURIComponent(cita.id_cita);
            if (cita.id_paciente) url += '&id_paciente=' + encodeURIComponent(cita.id_paciente);
            if (cita.id_especialidad) url += '&id_especialidad=' + encodeURIComponent(cita.id_especialidad);
            if (cita.hc) url += '&hc=' + encodeURIComponent(cita.hc);
            if (cita.fnac) url += '&fnac=' + encodeURIComponent(cita.fnac);
        } else {
            url = BASE_URL + '/atencion/medica?numdoc=' + encodeURIComponent(cita.numdoc_paciente || '');
            if (cita.paciente_nombre) url += '&paciente=' + encodeURIComponent(cita.paciente_nombre);
            if (cita.id_cita) url += '&id_cita=' + encodeURIComponent(cita.id_cita);
            if (cita.id_paciente) url += '&id_paciente=' + encodeURIComponent(cita.id_paciente);
            if (cita.id_especialidad) url += '&id_especialidad=' + encodeURIComponent(cita.id_especialidad);
            if (cita.hc) url += '&hc=' + encodeURIComponent(cita.hc);
            if (cita.fnac) url += '&fnac=' + encodeURIComponent(cita.fnac);
        }
        $('#btnIrAtencion').attr('href', url);
        $('#modalDetalleCita').modal('show');
    }

    function formatearFecha(dateStr) {
        const date = new Date(dateStr + 'T00:00:00');
        return date.toLocaleDateString('es-PE', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    }

    function mostrarError(mensaje) {
        if (window.Swal) {
            Swal.fire({ icon: 'error', title: 'Error', text: mensaje });
        } else {
            alert(mensaje);
        }
    }

    initCalendar();
    cargarCitas();
});
