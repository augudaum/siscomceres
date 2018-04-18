$(document).ready(function () {
    var button_addparticipante = $('#button-addparticipante');
    var button_saveparticipante = $('#button-saveparticipante');
    var button_deleteparticipante = $('#button-deleteparticipante');
    var button_addcontato = $('#button-addcontato');
    var form_addparticipante = $('#addParticipanteForm');

    // Seta a validação dos campos do formulário
    setFormValidation();

    // Inicializa os dropdowns
    initDropdowns();

    // Inicialização das tabs
    $('.tabular.menu .item').tab();

    // Manipula as tabs referentes a pessoa física e jurídica
    $('.ui.checkbox').checkbox({
        onChange: function (event) {
            if ($(this)[0].id == 'f') {
                form_addparticipante.form('clear');
                $(this).click();
                $('fieldset#fieldset-juridica').css('display', 'none');
                $('fieldset#fieldset-fisica').css('display', '');
            } else {
                form_addparticipante.form('clear');
                $(this).click();
                $('fieldset#fieldset-juridica').css('display', '');
                $('fieldset#fieldset-fisica').css('display', 'none');
            }
        }
    });

    // Submete os dados do participante
    button_saveparticipante.on('click', function (event) {
        if (form_addparticipante.form('is valid')) {
            if ($(this).attr('data-action') == 'create') {
                $.ajax({
                    url: '/Participantes/store',
                    type: 'POST',
                    data: form_addparticipante.serialize(),
                    dataType: 'json',
                    success: function (response, status, request) {
                        $('#addParticipanteModal').modal('hide');
                        if (response > 0) {
                            var contatos = getTableValues();
                            if (contatos.length > 0) {
                                for (var i = 0; i < contatos.length; i++) {
                                    contatos[i].participante_id = response;
                                    $.ajax({
                                        url: '/Participantes/storeContato',
                                        type: 'POST',
                                        data: {
                                            tipo_contato: contatos[i].tipo_contato,
                                            valor: contatos[i].valor,
                                            participante_id: contatos[i].participante_id,
                                            categoria: contatos[i].categoria,
                                            observacao: contatos[i].observacao,
                                            whatsapp: contatos[i].whatsapp,
                                        },
                                        dataType: 'json'
                                    });
                                }
                                swal({
                                    title: 'Operação realizada!',
                                    text: 'Participante cadastrado com sucesso!',
                                    icon: 'success',
                                    button: 'OK'
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                swal({
                                    title: 'Operação realizada!',
                                    text: 'Participante cadastrado com sucesso!',
                                    icon: 'success',
                                    button: 'OK'
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        }
                    }
                });
            } else {
                $.ajax({
                    url: '/Participantes/update',
                    type: 'POST',
                    data: form_addparticipante.serialize(),
                    dataType: 'json',
                    success: function (response, status, request) {
                        $('#addParticipanteModal').modal('hide');
                        if (response > 0) {
                            var contatos = getTableValues();
                            if (contatos.length > 0) {
                                for (var i = 0; i < contatos.length; i++) {
                                    contatos[i].participante_id = $('input[name=id]').val();
                                    $.ajax({
                                        url: '/Participantes/storeContato',
                                        type: 'POST',
                                        data: {
                                            tipo_contato: contatos[i].tipo_contato,
                                            valor: contatos[i].valor,
                                            participante_id: contatos[i].participante_id,
                                            categoria: contatos[i].categoria,
                                            observacao: contatos[i].observacao,
                                            whatsapp: contatos[i].whatsapp,
                                        },
                                        dataType: 'json'
                                    });
                                }
                                swal({
                                    title: 'Operação realizada!',
                                    text: 'Participante cadastrado com sucesso!',
                                    icon: 'success',
                                    button: 'OK'
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                swal({
                                    title: 'Operação realizada!',
                                    text: 'Participante atualizado com sucesso!',
                                    icon: 'success',
                                    button: 'OK'
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        }
                    }
                })
            }
        } else {
            form_addparticipante.form('validate form');
        }
    });

    //Remove um participante
    button_deleteparticipante.on('click', function (event) {
        var id = $('input[name=id').val();
        var action = $(this).attr('data-action');
        $.ajax({
            url: '/Participantes/destroy',
            type: 'POST',
            data: {
                id: id,
                action: action
            },
            dataType: 'json',
            success: function (response, status, request) {
                if (response > 0) {
                    $('#addParticipanteModal').modal('hide');
                    swal({
                        title: 'Operação realizada!',
                        text: 'Participante removido com sucesso!',
                        icon: 'success',
                        button: 'OK'
                    }).then(() => {
                        location.reload();
                    });
                }
            }
        });
    });

    // Abre o modal para cadastrar o participante
    button_addparticipante.on('click', function (event) {
        buttonNewInterface();
        $('#addParticipanteModal .header')[0].innerHTML = "Cadastrar participante";
        $('#addParticipanteModal').modal('show');
    });

    // Adiciona um contato na tabela
    button_addcontato.on('click', function (event) {
        event.preventDefault();
        var icon = '';
        if ($('input[name=whatsapp]').val() == 1) {
            icon = $('<i>').prop('class', 'whatsapp green icon');
        }
        $('table#table-contatos tbody').append(
            $('<tr>').append(
                $('<td>').html($('#dropdown-tipo-contato').dropdown('get value')).append(icon),
                $('<td>').html($('input[name=valor]').val()),
                $('<td>').html($('#dropdown-categoria-contato').dropdown('get value')),
                $('<td>').html($('input[name=observacao]').val()),
                $('<td>').prop('colspan', 2).append(
                    $('<button>').prop({ class: 'ui red tiny button' }).text('Remover').click(function (e) {
                        $(this).parent().parent().remove();
                    })
                )
            )
        );
        getTableValues();
    });

    // Reseta o form e limpa a tabela de contatos quando o modal fechar
    $('#addParticipanteModal').modal({
        onHidden: function () {
            form_addparticipante.form('clear');
            $('table#table-contatos tbody').empty();
        }
    });

    // Evento de clique sobre uma linha da tabela
    $('#table-participantes tbody tr td').on('click', function (event) {
        buttonUpdateInterface();
        var id = $(this).parent().attr('data-id');
        $.ajax({
            url: '/Participantes/show',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function (response, status, request) {
                $('input[name=id]').val(response.participante.id);
                // Definindo o tipo de pessoa
                if (response.participante.cpf_cnpj.length > 11) {
                    $('#j').click();
                    $('fieldset#fieldset-juridica').css('display', '');
                    $('fieldset#fieldset-fisica').css('display', 'none');
                    $('input[name=razao_social]').val(response.participante.razao_social);
                    $('input[name=nome_fantasia]').val(response.participante.nome_fantasia);
                    $('input[name=cnpj]').val(response.participante.cpf_cnpj);
                    $('input[name=ie]').val(response.participante.ie);
                    $('#dropdown-ie').dropdown('set selected', response.participante.uf_ie);
                    $('input[name=im]').val(response.participante.im);
                    $('input[name=cnae]').val(response.participante.cnae);
                    $('#dropdown-crt').dropdown('set selected', response.participante.crt);
                    $('input[name=data_fundacao]').val(response.participante.data_fundacao);
                } else {
                    $('#f').click();
                    $('fieldset#fieldset-juridica').css('display', 'none');
                    $('fieldset#fieldset-fisica').css('display', '');
                    $('input[name=cpf]').val(response.participante.cpf_cnpj);
                    $('input[name=nome_pessoa]').val(response.participante.nome_pessoa);
                    $('input[name=data_nascimento]').val(response.participante.data_nascimento);
                    $('input[name=apelido]').val(response.participante.apelido);
                    $('input[name=numero_rg]').val(response.participante.numero_rg);
                    $('input[name=data_expedicao_rg]').val(response.participante.data_expedicao_rg);
                    $('input[name=orgao_rg]').val(response.participante.orgao_rg);
                    $('#dropdown-rg').dropdown('set selected', response.participante.uf_rg);
                }
                $('input[name=cep]').val(response.participante.cep);
                $('#dropdown-pais').dropdown('set selected', response.participante.pais);
                $('#dropdown-estado').dropdown('set selected', response.participante.estado);
                $.ajax({
                    url: '/Cidades/cidades',
                    type: 'POST',
                    data: {
                        codigo_estado: response.participante.estado
                    },
                    dataType: 'json',
                    success: function (r) {
                        $('#dropdown-cidade .menu').empty();
                        for (var i = 0; i < r.length; i++) {
                            $('#dropdown-cidade .menu').append($('<div>').addClass('item').attr('data-value', r[i].codigo).html(r[i].nome));
                        }
                        $('#dropdown-cidade').dropdown('set selected', response.participante.cidade);
                    }
                });
                $('input[name=nome_bairro]').val(response.participante.nome_bairro);
                $('input[name=nome_rua]').val(response.participante.nome_rua);
                $('input[name=numero_casa]').val(response.participante.numero_casa);
                $('input[name=complemento]').val(response.participante.complemento);
                $('input[name=referencia]').val(response.participante.referencia);

                // Configurando os dados do contato
                if (response.contato) {
                    // Limpa a tabela, antes de adicionar os novos contatos
                    $('table#table-contatos tbody').empty();

                    // Caso o participante disponha de apenas contato...
                    if (response.contato.length == undefined) {
                        setContatosInTable(response.contato);

                    } else { // Caso o participante disponha de mais de um contato
                        for (var i = 0; i < response.contato.length; i++) {
                            setContatosInTable(response.contato[i]);
                        }
                    }
                }
            }
        });
        $('#addParticipanteModal .header')[0].innerHTML = "Atualizar participante";
        $('#addParticipanteModal').modal('show');
    });
});

// Cria o botão de remover contatos
function setContatosInTable(contato) {
    var buttonRemover = $('<button>').prop({ class: 'ui red tiny button', id: 'remover-contato' }).text('Remover').click(function (e) {
        e.preventDefault();
        $(this).parent().parent().remove();
        $('input[name=observacao]').val(contato.observacao);
        $('#dropdown-tipo-contato').dropdown('set selected', contato.tipo_contato);
        $('#dropdown-categoria-contato').dropdown('set selected', contato.categoria);
        $('input[name=valor]').val(contato.valor);
        $('.whatsapp.icon').addClass('green');
        if (contato.whatsapp == 1) {
            $('#whatsapp').val(1);
        }
    });
    var icon = '';
    if (contato.whatsapp == 1) {
        icon = $('<i>').prop('class', 'whatsapp green icon');
    }
    $('table#table-contatos tbody').append(
        $('<tr>').attr('data-id', contato.participante_id).append(
            $('<td>').html(contato.tipo_contato).append(icon),
            $('<td>').html(contato.valor),
            $('<td>').html(contato.categoria),
            $('<td>').html(contato.observacao),
            $('<td>').prop('colspan', 2).append(
                buttonRemover
            )
        )
    );
}

// Função que percorre os elementos da tabela e retorna um array preenchido
function getTableValues() {
    var table = document.getElementById('table-contatos');
    var contatos = [];
    for (var r = 1, n = table.rows.length; r < n; r++) {
        var contato = {
            tipo_contato: table.rows[r].cells[0].innerHTML,
            valor: table.rows[r].cells[1].innerHTML,
            categoria: table.rows[r].cells[2].innerHTML,
            observacao: table.rows[r].cells[3].innerHTML,
            whatsapp: table.rows[r].cells[0].innerHTML.indexOf('whatsapp') > -1 ? 1 : 0
        }
        if (contato.tipo_contato.indexOf('<') > -1) {
            contato.tipo_contato = contato.tipo_contato.substring(0, contato.tipo_contato.search('<'));
        }
        contatos.push(contato);
    }
    return contatos;
}

function initDropdowns() {
    // Preenche os dropdowns que utilizam estados
    $.ajax({
        url: '/Estados/estados',
        type: 'POST',
        dataType: 'json',
        success: function (response, status, request) {
            // Inicializando os dropdowns que utilizam estados
            for (var i = 0; i < response.length; i++) {
                $('#dropdown-estado .menu').append($('<div>').addClass('item').attr('data-value', response[i].codigo).html(response[i].nome));
                $('#dropdown-rg .menu').append($('<div>').addClass('item').attr('data-value', response[i].codigo).html(response[i].nome));
                $('#dropdown-rg').dropdown({
                    context: '[data-tab=tipo-participante]'
                });
                $('#dropdown-ie .menu').append($('<div>').addClass('item').attr('data-value', response[i].codigo).html(response[i].nome)).dropdown();
                $('#dropdown-ie').dropdown({
                    direction: 'upward'
                });
            }
        }
    });

    // Inicializa o dropdown de países
    $('#dropdown-pais').dropdown();

    // Inicializa o dropdown de cidades, passando o código do estado na busca
    $('#dropdown-estado').dropdown({
        onChange: function (value, text, $choice) {
            $.ajax({
                url: '/Cidades/cidades',
                type: 'POST',
                data: {
                    codigo_estado: value
                },
                dataType: 'json',
                success: function (response, status, request) {
                    $('#dropdown-cidade .menu').empty();
                    for (var i = 0; i < response.length; i++) {
                        $('#dropdown-cidade .menu').append($('<div>').addClass('item').attr('data-value', response[i].codigo).html(response[i].nome));
                    }
                    $('#dropdown-cidade').dropdown();
                }
            });
        }
    });

    // Inicializa o dropdown de CRT
    $('#dropdown-crt').dropdown({
        context: '[data-tab=tipo-participante]'
    })

    // Inicializa o dropdown de tipos de contatos e faz o tratamento do evento onChange, ativado ao selecionar um valor do dropdown
    $('#dropdown-tipo-contato').dropdown({
        onChange: function (value, text, $choice) {
            var container = $('#field-container');
            if (container.children().length > 2) {
                container[0].lastChild.remove();
            }
            var field = $('<div>').addClass('field');
            switch (value) {
                case 'E-mail':
                    field.append($('<label>').html('E-mail:'));
                    field.append($('<input>').prop({
                        type: 'email',
                        name: 'valor',
                        placeholder: 'email@exemplo.com'
                    }));
                    container.append(field);
                    break;
                case 'Telefone Celular':
                    var icon = $('<i>').addClass('whatsapp icon').css('cursor', 'pointer');
                    icon.click(function (event) {
                        $(this).toggleClass('green');
                        if ($('#whatsapp').val() == 0) {
                            $('#whatsapp').val(1);
                        } else {
                            $('#whatsapp').val(0);
                        }
                    });
                    var label = $('<label>').html('Celular:').append(icon);
                    field.append(label);
                    field.append($('<input>').prop({
                        type: 'tel',
                        name: 'valor',
                        placeholder: '55 84 123456789'
                    }));
                    var checkbox = $('<input>').prop({
                        type: 'hidden',
                        name: 'whatsapp',
                        value: '0',
                        id: 'whatsapp',
                        class: 'hidden',
                        tabindex: '0'
                    });
                    field.append(checkbox);
                    container.append(field);
                    break;
                case 'Fax':
                    field.append($('<label>').html('Fax:'));
                    field.append($('<input>').prop({
                        type: 'tel',
                        name: 'valor',
                        placeholder: 'Número do fax'
                    }));
                    container.append(field);
                    break;
                case 'Rede Social':
                    field.append($('<label>').html('Rede Social:'));
                    field.append($('<input>').prop({
                        type: 'text',
                        name: 'valor',
                        placeholder: ''
                    }));
                    container.append(field);
                    break;
                case 'Telefone Fixo':
                    field.append($('<label>').html('Telefone Fixo:'));
                    field.append($('<input>').prop({
                        type: 'tel',
                        name: 'valor',
                        placeholder: '84 3421-1234'
                    }));
                    container.append(field);
                    break;
            }
        }
    });

    // Inicializa o dropdown das categorias de contato
    $('#dropdown-categoria-contato').dropdown();
}

// Muda a interface do botão para atualização
function buttonUpdateInterface() {
    $('#button-saveparticipante').removeClass('primary').addClass('green').html("Atualizar").attr('data-action', 'update');
    $('#button-deleteparticipante').removeClass('disabled');
}

// Muda a interface do botão para adição
function buttonNewInterface() {
    $('#button-saveparticipante').removeClass('green').addClass('primary').html("Salvar").attr('data-action', 'create');
    $('#button-deleteparticipante').addClass('disabled');
}

// Configura a validação do front end dos campos
function setFormValidation() {
    $('#addParticipanteForm').form({
        fields: {
            tipo_pessoa: {
                identifier: 'tipo_pessoa',
                rules: [
                    {
                        type: 'checked',
                        prompt: 'Selecione o tipo de pessoa'
                    }
                ]
            },
            cpf_cnpj: {
                identifier: 'cpf_cnpj',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Informe o CPF/CNPJ'
                    }
                ]
            }
        },
        inline: true
    });
}