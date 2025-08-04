$(function () {
  'use strict';
  
  var dtUserTable = $('.user-list-table');
  var newUserModal = $('#newUserModal');
  var newUserForm = $('#newUserForm');
  var tableUser = false;

  function dataReservas() {
    if (tableUser) {
        tableUser.destroy();
    }

    tableUser = dtUserTable.DataTable({
        ajax: { url: "/admin/reservas/listar", dataSrc: "" },
        columns: [
            {
                data: function (dados) {
                  
                    let image = dados.usuario && dados.usuario.photo 
                        ? `<img src="${dados.usuario.photo}" alt="Avatar" class="user-avatar" height="26" width="26" data-id="${dados.usuario.id || ''}"/>`
                        : `<img src="/app-assets/images/avatars/avatar.png" alt="Avatar" class="user-avatar" height="26" width="26" data-id="${dados.usuario ? dados.usuario.id : ''}"/>`;
                    return `<div class="avatar">${image}</div>`;
                }
            },
            {
                data: function (dados) {
                    return dados.usuario 
                        ? `<span class="user-name" style="cursor:pointer" data-id="${dados.usuario.id || ''}">${dados.usuario.name}</span>`
                        : `<span class="user-name">Usuário não encontrado</span>`;
                }
            },
            { 
                data: function(dados) {
                    return dados.usuario && dados.usuario.email 
                        ? dados.usuario.email 
                        : 'Não disponível';
                }
            },
            { 
                data: function(dados) {
                    return dados.usuario && dados.usuario.telefone 
                        ? dados.usuario.telefone 
                        : 'Não disponível';
                }
            },
            {
                data: function (dados) {
                    return dados.sala 
                        ? `<span>${dados.sala.nome}</span>` 
                        : 'Sala não encontrada';
                }
            },
            {
                data: function (dados) {
                    if (dados.data_reserva) {
                        const dataReserva = new Date(dados.data_reserva).toLocaleDateString('pt-BR', {
                            weekday: 'long', // para o dia da semana, remova se não quiser exibir
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });
                        return `${dataReserva} às ${dados.hora_inicio} - ${dados.hora_fim}`;
                    } else {
                        return 'Não disponível';
                    }
                }
            },
            {
                data: function (dados) {
                    return dados.sala 
                        ? `<span>${dados.sala.valor}</span>` 
                        : 'Não disponível';
                }
            },
            {
                data: function (dados) {
                    const status = (dados.status || '').toUpperCase();
                    let badgeClass = 'secondary';
                    let label = 'Desconhecido';

                    switch (status) {
                        case 'CONFIRMADA':
                        badgeClass = 'success';
                        label = 'Confirmada';
                        break;
                        case 'PENDENTE':
                        badgeClass = 'warning';
                        label = 'Pendente';
                        break;
                        case 'CANCELADA':
                        badgeClass = 'danger';
                        label = 'Cancelada';
                        break;
                        default:
                        badgeClass = 'secondary';
                        label = status || 'Desconhecido';
                    }

                    return `<span class="badge badge-${badgeClass}">${label}</span>`;
                    }
            },
            {
              data: function (dados) {
                return `<button class="btn btn-outline-primary abrir-modal-reserva btn-sm" data-dados='${JSON.stringify(dados)}'>Detalhes</button>`;
              }
            }
            ],
            order: [[1, 'asc']],
            language: {
                url: datatablesLangUrl,
                paginate: { previous: '&nbsp;', next: '&nbsp;' }
            }
        });   
    }





  // Resetar o modal para criação de novo usuário
  $(document).on('click', '.create-new', function () {
      newUserForm.trigger("reset"); // Reseta todos os campos do formulário
      $('#id_geral').val(''); // Limpa o campo de ID para indicar criação
      $('#senha').prop('required', true); // Exige a senha para novos usuários
      newUserModal.modal('show'); // Abre o modal
  });

  // Evento para abrir o modal ao clicar no nome ou na foto do usuário para edição
  $(document).on('click', '.user-avatar, .user-name', function () {
    let id = $(this).data('id');
    $.get(`/admin/usuarios/detalhes/${id}`, function (data) {
        // Informações do usuário
        $('#id_geral').text(data.id);
        $('#fullname').text(data.name);
        $('#email').text(data.email);
        $('#cpf').text(data.cpf);
        $('#sexo').text(data.sexo);
        $('#idade').text(data.idade);
        $('#telefone').text(data.telefone);
        $('#photo').text(data.photo);
        $('#status').text(data.status);
        $('#perfil').text(data.tipo_usuario);
        $('#senha').prop('required', false); // Senha não obrigatória na edição

        // Informações profissionais
        $('#registro_profissional').text(data.registro_profissional);
        $('#tipo_registro_profissional').text(data.tipo_registro_profissional);

        // Informações de endereço - Verifica se o endereço existe antes de tentar preencher
        if (data.endereco) {
            $('#endereco_rua').text(data.endereco.rua);
            $('#endereco_numero').text(data.endereco.numero);
            $('#endereco_complemento').text(data.endereco.complemento);
            $('#endereco_bairro').text(data.endereco.bairro);
            $('#endereco_cidade').text(data.endereco.cidade);
            $('#endereco_estado').text(data.endereco.estado);
            $('#endereco_cep').text(data.endereco.cep);
        } else {
            // Limpar campos de endereço caso não exista um endereço associado
            $('#endereco_rua').text('');
            $('#endereco_numero').text('');
            $('#endereco_complemento').text('');
            $('#endereco_bairro').text('');
            $('#endereco_cidade').text('');
            $('#endereco_estado').text('');
            $('#endereco_cep').text('');
        }

        newUserModal.modal('show'); // Abre o modal para edição
    });
  });


  // Evento de submissão do formulário para criar ou editar
  newUserForm.on('submit', function (e) {
      e.preventDefault();
      let data = newUserForm.serialize();
      let url = $('#id_geral').val() ? `/admin/usuarios/atualizar/${$('#id_geral').val()}` : '/admin/usuarios/cadastrar';

      $.ajax({
          type: "POST",
          url: url,
          data: data,
          success: function () {
              datauser(); // Recarrega a tabela de usuários
              newUserModal.modal('hide'); // Fecha o modal após salvar
              toastr.success('Usuário salvo com sucesso!');
          },
          error: function (e) {
            let mensagemAmigavel = interpretarErro(e);
            toastr.error(mensagemAmigavel);
          }
      });
  });
  
  $(document).on('click', '.cancelar-reserva', function () {
    const reservaId = $(this).data('id');
  
    $.ajax({
      url: '/reserva/cancelar',
      method: 'POST',
      data: {
        reference_id: `reserva_${reservaId}`,
        _token: $('meta[name="csrf-token"]').attr('content')
      },
      success: function (response) {
        if (response.success) {
          toastr.success('Reserva cancelada com sucesso!');
          $('#modalReservaDetalhe').modal('hide');
          tableUser.ajax.reload(); // recarrega a tabela
        } else {
          toastr.error('Falha ao cancelar reserva!');
        }
      },
      error: function () {
        toastr.error('Erro no servidor ao cancelar a reserva.');
      }
    });
  });
  

  $(document).on('click', '.abrir-modal-reserva', function () {
    const dados = $(this).data('dados');
    const horarios = Array.isArray(dados.horarios)
  ? dados.horarios.map(h => `<li>${h.hora_inicio} às ${h.hora_fim}</li>`).join('')
  : '<li>Horário único: ' + dados.hora_inicio + ' às ' + dados.hora_fim + '</li>';

    const modalHtml = `
      <div class="modal fade" id="modalReservaDetalhe" tabindex="-1" role="dialog" aria-labelledby="modalReservaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title" id="modalReservaLabel">Detalhes da Reserva</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span>&times;</span>
              </button>
            </div>

            <div class="modal-body row">
              <div class="col-md-5">
                <img src="${dados.sala?.imagens?.[0]?.imagem_base64 || '/sem-imagem.jpg'}" class="img-fluid rounded" style="height: 220px; object-fit: cover;">
              </div>
              <div class="col-md-7">
                <h5>${dados.sala?.nome || 'Sala'}</h5>
                <p><strong>Endereço:</strong><br>
                  ${dados.sala?.endereco?.rua || ''}, ${dados.sala?.endereco?.numero || ''}<br>
                  ${dados.sala?.endereco?.bairro || ''} - ${dados.sala?.endereco?.cidade || ''}/${dados.sala?.endereco?.estado || ''}
                </p>
                <p><strong>Horários reservados:</strong></p>
                <ul>${horarios}</ul>
              </div>
            </div>

            <div class="modal-footer">
            <button type="button" class="btn btn-danger cancelar-reserva" data-id="${dados.id}">Cancelar Reserva</button>

            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>

          </div>
        </div>
      </div>
    `;

    $('#modalReservaDetalhe').remove();
    $('body').append(modalHtml);
    $('#modalReservaDetalhe').modal('show');
  });

  dataReservas();
});
