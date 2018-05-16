$(document).ready(() => {
    var button_requisicaoresumida = $('#button-requisicaoresumida');
    var button_saveRequisicaoResumida = $('#button-saveRequisicaoResumida');
    var button_requisicaodetalhada = $('#button-requisicaodetalhada');
    var button_addpedido = $('#button-addpedido');
    var button_addtotable = $('#button-addprodutototable');
    var form_adddRequisicaoResumida = $('#addRequisicaoResumidaForm');

    setFormRequisicaoResumidaValidate();

    // Salva uma requisição de compra
    button_saveRequisicaoResumida.on('click', (event) => {
        console.log(getTableProdutos());
    });

    // Abre o modal para cadastrar uma requisição resumida
    button_requisicaoresumida.on('click', (event) => {
        $('#addRequisicaoResumidaModal').modal('show');
    });

    // Abre o modal para cadastrar uma requisição detalhada
    button_requisicaodetalhada.on('click', (event) => {
        $('#addRequisicaoDetalhadaModal').modal('show');
    });

    // Abre o modal para montar um pedido de compra
    button_addpedido.on('click', (event) => {
        $('#addPedidoModal').modal('show');
    });

    // Adiciona o produto e a quantidade à tabela de requisições
    button_addtotable.on('click', (event) => {
        if (form_adddRequisicaoResumida.form('is valid')) {
            var codigo = $('input[name=codigo_produto]').val();
            var quantidade = $('input[name=quantidade]').val();
            var descricao = $('#dropdown-produtos').dropdown('get text');
            addProdutoInTable(codigo, descricao, quantidade);
        } else {
            form_adddRequisicaoResumida.form('validate form');
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
                context: '#addRequisicaoResumidaModal'
            });
        }
    });
}

// Adiciona um produto à tabela
function addProdutoInTable(codigo, produto, quantidade) {
    var table = document.getElementById('table-produtos-requisicao');
    var existe = false;
    if (table.rows.length > 1) {
        for (var r = 1, n = table.rows.length; r < n; r++) {
            if (produto == table.rows[r].cells[0].innerHTML) {
                table.rows[r].cells[1].innerHTML = parseInt(table.rows[r].cells[1].innerHTML, 10) + parseInt(quantidade, 10);
                existe = true;
                break;
            }
        }
        if (!existe) {
            $('table#table-produtos-requisicao tbody').append(
                $('<tr>').attr('data-id', codigo).append(
                    $('<td>').html(produto),
                    $('<td>').html(quantidade)
                )
            );
        }
    } else {
        $('table#table-produtos-requisicao tbody').append(
            $('<tr>').attr('data-id', codigo).append(
                $('<td>').html(produto),
                $('<td>').html(quantidade)
            )
        );
    }
}

// Percorre a tabela e retorna os produtos selecionados pelo usuário
function getTableProdutos() {
    var table = document.getElementById('table-produtos-requisicao');
    var produtos = [];
    for (var r = 1, n = table.rows.length; r < n; r++) {
        var produto = {
            codigo_produto: table.rows[r].getAttribute('data-id'),
            descricao: table.rows[r].cells[0].innerHTML,
            quantidade: table.rows[r].cells[1].innerHTML
        }
        produtos.push(produto);
    }
    return produtos;
}

function setFormRequisicaoResumidaValidate() {
    $('#addRequisicaoResumidaForm').form({
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