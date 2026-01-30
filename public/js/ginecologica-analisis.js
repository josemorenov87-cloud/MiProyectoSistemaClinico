$(function() {
  // Al cambiar el grupo, cargar exámenes médicos filtrados
  $('#grupo_analisis').on('change', function() {
    var idGrupo = $(this).val();
    $('#examen_medico').html('<option value="">Seleccionar Examen Médico</option>');
    if (!idGrupo) return;
    $.getJSON('/www.sistemaclinico2.com/system/ajax_examenes.php', { id_grpexam: idGrupo }, function(resp) {
      if (resp && resp.success && resp.data) {
        resp.data.forEach(function(exam) {
          $('#examen_medico').append('<option value="'+exam.id_tipexam+'">'+exam.nom_tipexam+'</option>');
        });
      }
    });
  });

  // Tabla de análisis en memoria
  var analisisList = [];

  function renderAnalisisTable() {
    var tbody = $('#tabla_analisis_body');
    tbody.empty();
    if (analisisList.length === 0) return;
    analisisList.forEach(function(item, idx) {
      tbody.append('<tr>' +
        '<td>'+(idx+1)+'.</td>'+
        '<td>'+item.grupo+'</td>'+
        '<td>'+item.examen+'</td>'+
        '<td>'+item.comentario+'</td>'+
      '</tr>');
    });
  }

  // Añadir análisis
  $('#btn_add_analisis').on('click', function() {
    var grupoText = $('#grupo_analisis option:selected').text();
    var grupoVal = $('#grupo_analisis').val();
    var examenText = $('#examen_medico option:selected').text();
    var examenVal = $('#examen_medico').val();
    var comentario = $('#comentarios_analisis').val();
    if (!grupoVal || !examenVal) {
      alert('Seleccione grupo y examen');
      return;
    }
    analisisList.push({ grupo: grupoText, examen: examenText, comentario: comentario });
    renderAnalisisTable();
    // Limpiar campos
    $('#examen_medico').val('');
    $('#comentarios_analisis').val('');
  });

  // Guardar análisis (a implementar: AJAX a backend)
  $('#btn_save_analisis').on('click', function() {
    // Aquí puedes enviar analisisList por AJAX para guardar en BD
    alert('Funcionalidad de guardado pendiente de implementar.');
  });

  // Imprimir análisis (a implementar)
  $('#btn_print_analisis').on('click', function() {
    alert('Funcionalidad de impresión pendiente de implementar.');
  });

  // Al cargar, tabla vacía
  renderAnalisisTable();
});
