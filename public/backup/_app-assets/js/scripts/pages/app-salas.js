/*=========================================================================================
    File Name: app-salas.js
    Description: criação edição das salas
    --------------------------------------------------------------------------------------
    autor: Pitter R. Bico
    contato: pitter775@gmail.com / 11-9 4950 6267
==========================================================================================*/
$(function () { 
  'use strict';
  var password = true;
  var row_edit = '';
  var confirmText = $('#confirm-text');
  var dtSalaTable = $('.sala-list-table'), //id da tabela q esta na div  
    newSalaSidebar = $('.new-sala-modal'), //name do modal
    isRtl = $('html').attr('data-textdirection') === 'rtl',
    newSalaForm = $('.add-new-sala'); //formulário

  // Datatable
  if (dtSalaTable.length) {
    dtSalaTable.DataTable({
      // busca uma rota para carregar as salas via AJAX
      ajax: { url: "/salas/all", dataSrc: "" },
      columns: [
        { data: 'id' },
        { data: 'nome' },
        { data: 'descricao' },
        { data: 'endereco.rua' },  // Aqui o nome da rua do relacionamento com a tabela endereços
        { data: 'status' },
        { data: '' }  // Para as ações (editar/excluir)
      ],
      columnDefs: [      
        {
          className: 'control',
          orderable: false,
          responsivePriority: 2,
          targets: 0
        },
        {
          targets: -1,
          title: 'Ação',
          orderable: false,
          render: function (data, type, full, meta) {
            var $id = full['id'],
               $nome = full['nome'];

            return (
              '<div class="btn-group">' +
              '<a class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">' +
              feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
              '</a>' +
              '<div class="dropdown-menu dropdown-menu-right">' +
                '<a class="dropdown-item">' + feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) + 'Detalhes</a>' +
                '<a data-nome="'+ $nome +'" data-id="'+ $id +'" class="dropdown-item" data-toggle="modal" data-target="#modals-slide-in" id="editar_td">' + feather.icons['archive'].toSvg({ class: 'font-small-4 mr-50' }) + 'Editar</a>' +
                '<a href="javascript:;" class="dropdown-item delete-record" data-id="'+ $id +'" data-nome="'+ $nome +'" id="deletar_td">' + feather.icons['trash-2'].toSvg({ class: 'font-small-4 mr-50' }) + 'Deletar</a></div>' +
              '</div>' +
              '</div>'
            );
          }
        }
      ],
      order: [[1, 'asc']],
      dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>>' +
           '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t' +
           '<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 10,
      lengthMenu: [10, 25, 50, 75, 100],
      language: {
        paginate: {
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      },
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-outline-secondary dropdown-toggle mr-2 waves-effect',
          text: feather.icons['share'].toSvg({ class: 'font-small-4 mr-50 ' }) + 'Export',
          buttons: [
            {
              extend: 'print',
              text: feather.icons['printer'].toSvg({ class: 'font-small-4 mr-50' }) + 'Print',
              className: 'dropdown-item',
              exportOptions: { columns: [0, 1, 2, 3, 4] }
            },
            {
              extend: 'csv',
              text: feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) + 'Csv',
              className: 'dropdown-item',
              exportOptions: { columns: [0, 1, 2, 3, 4] }
            },
            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 mr-50' }) + 'Excel',
              className: 'dropdown-item',
              exportOptions: { columns: [0, 1, 2, 3, 4] }
            },
            {
              extend: 'copy',
              text: feather.icons['copy'].toSvg({ class: 'font-small-4 mr-50' }) + 'Copy',
              className: 'dropdown-item',
              exportOptions: { columns: [0, 1, 2, 3, 4] }
            }
          ],
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function () {
              $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
            }, 50);
          }
        },
        {
          text: feather.icons['plus'].toSvg({ class: 'mr-50 font-small-4 ' }) + 'Nova Sala',
          className: 'create-new btn btn-primary waves-effect',
          attr: {
            'data-toggle': 'modal',
            'data-target': '#modals-slide-in'
          },
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
          }
        }
      ],
      language: {
        "url": "/app-assets/pt_br.json",
        paginate: {
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      },
      initComplete: function () {
        this.api().columns(1).every(function () {
          var column = this;
          var select = $('<select id="salaRole" class="form-control select2"><option value=""> Nome </option></select>')
            .appendTo('.sala_role')
            .on('change', function () {
              var val = $.fn.dataTable.util.escapeRegex($(this).val());
              column.search(val ? '^' + val + '$' : '', true, false).draw();
            });

          column.data().unique().sort().each(function (d, j) {
            select.append('<option value="' + d + '" class="text-capitalize">' + d + '</option>');
          });
        });
      }
    });
    $('div.head-label').html('<h6 class="mb-0">Listando todas as salas</h6>');
  }

  // Função para editar a sala
  function editarlinha(serealize, data) {
    $(row_edit).addClass('alteraressatr');
    dtSalaTable.DataTable().row($('.alteraressatr')).data({
      "id": serealize[1]['value'],
      "nome": serealize[2]['value'],
      "descricao": serealize[3]['value'],
      "endereco.rua": serealize[4]['value'],
      "status": serealize[5]['value'],
      "": ""
    }).draw();

    $(row_edit).css('background-color', '#749efe');
    $(row_edit).css('color', '#fff');
    $(row_edit).animate({
      color: "#555",
      backgroundColor: 'transparent'
    }, 1000, "linear");
    $(row_edit).removeClass('alteraressatr');

    toastr['success']('👋 Sala alterada.', 'Sucesso!', {
      closeButton: true,
      tapToDismiss: false,
      rtl: isRtl
    });
  }

  // Função para adicionar nova linha
  function addnovalinha(serealize, data) {
    var t = dtSalaTable.DataTable();    
    var rowNode = t.row.add({
      "id": data,
      "nome": serealize[1]['value'],
      "descricao": serealize[2]['value'],
      "endereco.rua": serealize[3]['value'],
      "status": serealize[4]['value'],
      "": ""
    }).draw().node();

    $(rowNode).css('opacity', '0');
    $(rowNode).css('background-color', '#71c754');
    $(rowNode).animate({
      opacity: 1,
      left: "0",
      backgroundColor: '#fff'
    }, 1000, "linear");
  }

  // Função para deletar sala
  $(document).on('click', '#deletar_td', function() {
    var t = dtSalaTable.DataTable();
    var row = dtSalaTable.DataTable().row($(this).parents('tr')).node();
    var id = $(this).data('id');

    Swal.fire({
      title: 'Remover Sala',
      text: $(this).data('nome') + '?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sim, pode deletar!',
      customClass: {
        confirmButton: 'btn btn-primary',
        cancelButton: 'btn btn-outline-danger ml-1'
      },
      buttonsStyling: false
    }).then(function (result) {
      if (result.value) {
        $.get('/salas/delete/' + id, function(retorno) {
          if (retorno == 'Erro') {
            toastr['danger']('👋 Arquivo comprometido, não pode excluir.', 'Erro!', {
              closeButton: true,
              tapToDismiss: false,
              rtl: isRtl
            });
          } else {
            $(row).css('background-color', '#fe7474');
            $(row).animate({
              opacity: 0,
              left: "0",
              backgroundColor: '#c74747'
            }, 1000, "linear", function() {
              var linha = $(this).closest('tr');
              t.row(linha).remove().draw();
            });

            toastr['success']('👋 Sala removida.', 'Sucesso!', {
              closeButton: true,
              tapToDismiss: false,
              rtl: isRtl
            });
          }
        });
      }
    });
  });
});
