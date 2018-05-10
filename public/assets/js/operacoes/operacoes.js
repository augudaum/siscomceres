$(document).ready(() => {
    var button_addrequisicao = $('#button-addrequisicao');
    var button_addpedido = $('#button-addpedido');
    var button_addtotable = $('#button-addprodutototable');
    var form_addrequisicao = $('#addRequisicaoForm');

    setFormRequisicaoValidate();

    // Abre o modal para cadastrar uma requisição
    button_addrequisicao.on('click', (event) => {
        $('#addRequisicaoModal').modal('show');
    });

    // Abre o modal para montar um pedido de compra
    button_addpedido.on('click', (event) => {
        $('#addPedidoModal').modal('show');
    });

    // Adiciona o produto e a quantidade à tabela de requisições
    button_addtotable.on('click', (event) => {
        if (form_addrequisicao.form('is valid')) {
            var codigo = $('input[name=codigo_produto]').val();
            var quantidade = $('input[name=quantidade]').val();
            var descricao = $('#dropdown-produtos').dropdown('get text');
            $('table#table-produtos-requisicao tbody').append(
                $('<tr>').attr('data-id', codigo).append(
                    $('<td>').html(descricao),
                    $('<td>').html(quantidade)
                )
            );
        } else {
            form_addrequisicao.form('validate form');
        }
    });

    // Inicializa o dropdown de fornecedores
    $.ajax({
        url: '/Participantes/participantes',
        type: 'POST',
        dataType: 'json',
        success: function (response, status, request) {
            var participantes = [];
            for (var i = 0; i < response.length; i++) {
                participantes.push({
                    title: (response[i].nome_pessoa != null ? response[i].nome_pessoa : response[i].razao_social),
                    description: (response[i].apelido != null ? response[i].apelido : response[i].nome_fantasia),
                    cpf_cnpj: response[i].cpf_cnpj,
                    id: response[i].id
                });
            }
            $('#select-fornecedores').search({
                source: participantes,
                fields: { id: 'id' },
                searchFields: [
                    'title', 'cpf_cnpj', 'description'
                ],
                error: {
                    noResults: 'Nenhuma transportadora dentre as cadastradas foi encontrada'
                }
            });
        }
    });
});

function initDropdowns() {
    $.ajax({
        url: '/Produtos/produtos',
        type: 'POST',
        data: { action: 'request' },
        dataType: 'json',
        success: function (response, status, request) {
            for (var i = 0; i < response.length; i++) {
                $('#dropdown-produtos .menu').append(
                    $('<div>').addClass('item').attr('data-value', (response[i].codigo != "" ? response[i].codigo : response[i].cean)).html(response[i].descricao)
                );
            }
            $('#dropdown-produtos').dropdown({
                context: '#addRequisicaoModal'
            });
        }
    });
}

function setFormRequisicaoValidate() {
    $('#addRequisicaoForm').form({
        fields: {
            quantidade: {
                identifier: 'quantidade',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Informe a quantidade desejada'
                    }
                ]
            },
            codigo_produto: {
                identifier: 'codigo_produto',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Selecione um produto'
                    }
                ]
            }
        },
        inline: true
    });
}