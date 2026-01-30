$(document).ready(function() {
    // Cargar horarios al iniciar
    cargarHorarios();

    // Manejar envío del formulario
    $('#formHorario').on('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        $.ajax({
            url: BASE_URL + '/guardar-horario-medico',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: response.mensaje,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    $('#formHorario')[0].reset();
                    cargarHorarios();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.mensaje
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error al guardar el horario'
                });
                console.error('Error:', error);
            }
        });
    });

    // Función para cargar horarios
    function cargarHorarios() {
        $.ajax({
            url: BASE_URL + '/listar-horarios-medico',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success && response.horarios) {
                    mostrarHorarios(response.horarios);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar horarios:', error);
            }
        });
    }

    // Función para mostrar horarios en la tabla
    function mostrarHorarios(horarios) {
        const tbody = $('#bodyHorarios');
        tbody.empty();

        if (horarios.length === 0) {
            tbody.append('<tr><td colspan="5" class="text-center">No hay horarios registrados</td></tr>');
            return;
        }

        horarios.forEach(function(horario) {
            const estadoTexto = horario.estado == 1 ? '<span class="badge badge-success">Activo</span>' : '<span class="badge badge-secondary">Inactivo</span>';
            
            const tr = `
                <tr>
                    <td>${horario.fecha}</td>
                    <td>${horario.hora}</td>
                    <td>${horario.hora_fin}</td>
                    <td>${estadoTexto}</td>
                    <td>
                        <button class="btn btn-sm btn-danger btn-eliminar" data-id="${horario.id_horariomed}">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </td>
                </tr>
            `;
            tbody.append(tr);
        });

        // Manejar eliminación
        $('.btn-eliminar').on('click', function() {
            const id = $(this).data('id');
            eliminarHorario(id);
        });
    }

    // Función para eliminar horario
    function eliminarHorario(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esta acción",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: BASE_URL + '/eliminar-horario-medico',
                    type: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Eliminado',
                                text: response.mensaje,
                                timer: 2000,
                                showConfirmButton: false
                            });
                            cargarHorarios();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.mensaje
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Ocurrió un error al eliminar el horario'
                        });
                        console.error('Error:', error);
                    }
                });
            }
        });
    }
});
