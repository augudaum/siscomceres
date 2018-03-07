$(document).ready(function () {
    // Botão que abrirá o form modal
    var button_adduser = $('#button-adduser');
    // Botão que submete os dados do formulário
    var button_saveuser = $('#button-saveuser');
    // Formulário para adicionar um novo usuário
    var form_adduser = $('#form-adduser');

    // Evento chamado quando o usuário clicar para adicionar um novo usuário
    button_adduser.on('click', function (event) {
        event.preventDefault();
        $('#addUsuarioModal').modal('show');
    });

    // Evento chamado quando o usuário tentar salvar um usuário
    button_saveuser.on('click', function (event) {
        $.ajax({
            url: '/usuarios/store',
            data: form_adduser.serialize(),
            type: 'POST',
            dataType: 'json', // Retorno do php
            success: function (response, status, request) {
                if (response > 0) {
                    swal({
                        title: 'Cadastro concluído',
                        text: 'Usuário cadastrado com sucesso!',
                        type: 'success',
                        confirmButtonText: 'OK'
                    }, function () {
                        location.reload();
                    });
                } else {
                    // Caso ocorra algum erro, tratar aqui
                }
            },
            error: function (request, status, error) {
                swal('Operação não concluída', 'Não foi possível realizar o cadastro. Se o erro persistir, contate o administrador!', 'error');
            }

        });
    });
});