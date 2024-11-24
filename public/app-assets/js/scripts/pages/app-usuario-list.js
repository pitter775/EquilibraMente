$(function () {
  'use strict';
  
  var dtUserTable = $('.user-list-table');
  var newUserModal = $('#newUserModal');
  var newUserForm = $('#newUserForm');
  var tableUser = false;

  // Função para carregar os dados na DataTable
  function datauser() {
      if (tableUser) {
          tableUser.destroy();
      }
      
      tableUser = dtUserTable.DataTable({
        ajax: { url: "/admin/usuarios/listar", dataSrc: "" },
        columns: [
            {
                data: function (dados) {
                    let image = dados.photo 
                        ? `<img src="${dados.photo}" alt="Avatar" class="user-avatar" height="26" width="26" data-id="${dados.id}"/>`
                        : `<img src="/app-assets/images/avatars/avatar.png" alt="Avatar" class="user-avatar" height="26" width="26" data-id="${dados.id}"/>`;
                    return `<div class="avatar">${image}</div>`;
                }
            },
            {
                data: function (dados) {
                    return `<span class="user-name" style="cursor:pointer" data-id="${dados.id}">${dados.name}</span>`;
                }
            },
            { data: 'email' },
            { data: 'telefone' }, // Exibe o telefone
            { 
                data: function (dados) {
                    return dados.tipo_usuario === 'cliente' ? 'Cliente' : 'Administrador';
                }
            },
            {
                data: function (dados) {
                    return dados.status === 'ativo'
                        ? '<span class="badge bg-success">Ativo</span>'
                        : '<span class="badge bg-danger">Inativo</span>';
                }
            }
        ],
        order: [[1, 'asc']], // Ordenação por Nome
        language: {
            url: datatablesLangUrl
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
        $('#id_geral').val(data.id);
        $('#fullname').val(data.name);
        $('#email').val(data.email);
        $('#cpf').val(data.cpf);
        $('#sexo').val(data.sexo);
        $('#idade').val(data.idade);
        $('#telefone').val(data.telefone);
        $('#photo').val(data.photo);
        $('#status').val(data.status);
        $('#perfil').val(data.tipo_usuario);
        $('#senha').prop('required', false); // Senha não obrigatória na edição

        // Informações profissionais
        $('#registro_profissional').val(data.registro_profissional);
        $('#tipo_registro_profissional').val(data.tipo_registro_profissional);

        // Informações de endereço - Verifica se o endereço existe antes de tentar preencher
        if (data.endereco) {
            $('#endereco_rua').val(data.endereco.rua);
            $('#endereco_numero').val(data.endereco.numero);
            $('#endereco_complemento').val(data.endereco.complemento);
            $('#endereco_bairro').val(data.endereco.bairro);
            $('#endereco_cidade').val(data.endereco.cidade);
            $('#endereco_estado').val(data.endereco.estado);
            $('#endereco_cep').val(data.endereco.cep);
        } else {
            // Limpar campos de endereço caso não exista um endereço associado
            $('#endereco_rua').val('');
            $('#endereco_numero').val('');
            $('#endereco_complemento').val('');
            $('#endereco_bairro').val('');
            $('#endereco_cidade').val('');
            $('#endereco_estado').val('');
            $('#endereco_cep').val('');
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

  datauser();
});
