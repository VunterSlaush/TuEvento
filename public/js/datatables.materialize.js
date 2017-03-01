$(document).ready(function(){
  
  iniciarDatatable('event');
  iniciarDatatable('comite');
  iniciarDatatable('presentador');
});

function iniciarDatatable(table){
  console.log("iniciando datatable: " + table);

  $('#' +  table + '_table').DataTable( {
    "pageLength": 4,
    "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
     },
    "initComplete": function(settings, json) {
      styleInputs(table);

      $('#' +  table + '_table_paginate').wrap('<ul class="pagination"></ul>'); // Encierra la paginacion con ul

      $('input').on('input', function(event) {
        stylePagination(table);
      });

      $('.dataTables_paginate').on('click', function(event) {
        stylePagination(table);
      });

      stylePagination(table);
    }
  });
}

// Agrega estilos css a la seccion de inputs
function styleInputs(table){
  $('#' + table + '_table_filter label').css('color', 'black');
  $('#' + table + '_table_length').css('display', 'none');
  // $('#' +  table + '_table_filter').css('width', '50%'); descomentar si lo quieres pequeño
}

// Agrega estilos css materialize a la seccion de paginacion
function stylePagination(table) {
  // Paginacion
  $('#' +  table + '_table_info').css('display', 'none');
  
  $('.pagination').css({
    'display': 'flex',
    'align-items': 'center',
    'justify-content': 'center'
  });
  $('.paginate_button').wrap('<li></li>'); // Encierra cada opcion con li
  $('li').has('.current').addClass('active'); // Si el li es el activo, agrega clase
  $('li .active').css('background-color', '#1565c0');
  $('ul div li').not('.active').addClass('waves-effect'); // Si no es activo, agrega efecto
  $('#' +  table + '_table_previous').html('<i class="material-icons">chevron_left</i>'); // Icono izq
  $('#' +  table + '_table_next').html('<i class="material-icons">chevron_right</i>'); // Icono der
}