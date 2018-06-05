$(document).ready(() => {
    var button_requisicaoresumida = $('#button-requisicaoresumida');
    var button_saveRequisicaoResumida = $('#button-saveRequisicaoResumida');
    var button_requisicaodetalhada = $('#button-requisicaodetalhada');
    var buttonAddProdutoToTableResumida = $('#buttonAddProdutoToTableResumida');
    var button_addtotable = $('#button-addprodutototable');
    var form_addRequisicaoResumida = $('#addRequisicaoResumidaForm');
    // PEDIDO DE COMPRA
    var buttonAddProdutoToTablePreco = $('#buttonAddProdutoToTablePreco');
    var buttonRemoveProdutoToTablePreco = $('#buttonRemoveProdutoToTablePreco');
    var buttonMontarPedido = $('#buttonMontarPedido');
    var buttonSavePedido = $('#buttonSavePedido');
    var formAddPedidoCompra = $('#addPedidoCompraForm');

    setFormRequisicaoResumidaValidate();
    setFormPedidoCompraValidate();
    initDropdownsOperacoes();

    // REQUISIÇÕES DE COMPRA
    // Botão 'Adicionar' do formulário resumido
    buttonAddProdutoToTableResumida.on('click', function () {
        console.log($(this).parent().parent().children()[0].innerText);
    });

    // Salva uma requisição de compra
    button_saveRequisicaoResumida.on('click', (event) => {
        var dataRequisicao = $('input[name=data_requisicao_resumida]').val();
        $.ajax({
            url: '/Requisicoes/store',
            type: 'POST',
            data: {
                data_requisicao: dataRequisicao,
                produtos: getTableProdutos()
            },
            dataType: 'json',
            success: function (response, status, request) {
                console.log(response);
            }
        });
    });

    // Abre o modal para cadastrar uma requisição resumida
    button_requisicaoresumida.on('click', (event) => {
        $('#addRequisicaoResumidaModal').modal('show');
    });

    // Abre o modal para cadastrar uma requisição detalhada
    button_requisicaodetalhada.on('click', (event) => {
        $('#addRequisicaoDetalhadaModal').modal('show');
    });

    // Adiciona o produto e a quantidade à tabela de requisições
    button_addtotable.on('click', (event) => {
        if (form_addRequisicaoResumida.form('is valid')) {
            var codigo = $('input[name=codigo_produto]').val();
            var quantidade = $('input[name=quantidade]').val();
            var descricao = $('#dropdown-produtos').dropdown('get text');
            var unidade = $('#dropdown-unidades-disabled').dropdown('get text');
            addProdutoInTable(codigo, descricao, unidade, quantidade);
        } else {
            form_addRequisicaoResumida.form('validate form');
        }
    });

    // PEDIDO DE COMPRA
    // Botão que transfere os produtos selecionados para a tabela de determinação de preços
    buttonAddProdutoToTablePreco.on('click', (event) => {
        $('#table-produtos-requisicao tr.active').each(function (index, element) {
            var codigoProduto = element.getAttribute('data-codigo');
            var descricaoProduto = element.children[0].innerText;
            var quantidadeProduto = element.children[1].innerText;
            // $(this).removeClass('active').addClass('disabled');
            $(this).removeClass('active').fadeOut("slow");
            $('#table-produtos-requisicao-preco tbody').append(
                $('<tr>').attr('data-codigo', codigoProduto).css('cursor', 'pointer').append(
                    $('<td>').html(descricaoProduto).prop('title', descricaoProduto),
                    $('<td>').html(quantidadeProduto),
                    $('<td contenteditable>').html(0.00)
                )
            );
        });
    });

    // Evento que escuta o 'Enter' em uma célula da tabela de determinação de preços
    $('body').on('keydown', '[contenteditable]', function (event) {
        if (event.which == 13) {
            event.preventDefault();
            $(this).blur();
            var table = document.getElementById('table-produtos-requisicao-preco');
            var total = 0;
            for (var r = 1, n = table.rows.length; r < n - 1; r++) {
                console.log(parseInt(table.rows[r].cells[1].innerHTML, 10), parseFloat(table.rows[r].cells[2].innerHTML, 10));
                total += parseInt(table.rows[r].cells[1].innerHTML, 10) * parseFloat(table.rows[r].cells[2].innerHTML, 10);
            }
            $('#total').html("R$ " + total.toFixed(2));
        }
    });

    // Salvando o pedido de compra
    buttonSavePedido.on('click', (event) => {
        if (formAddPedidoCompra.form('is valid')) {
            var codigo_fornecedor = $('#select-fornecedores').search('get result', $('#select-fornecedores').search('get value'))['id'];
            var numero_requisicao = $('input[name=numero_requisicao]').val();
            var data_pedido = $('input[name=data_pedido]').val();
            var total_pedido_compra = $('#total')[0].innerHTML.substring(3);
            $.ajax({
                url: 'PedidosCompra/store',
                type: 'POST',
                data: {
                    codigo_fornecedor: codigo_fornecedor,
                    numero_requisicao: numero_requisicao,
                    data_pedido: data_pedido,
                    produtos: getTableProdutosPreco(),
                    total_pedido_compra: total_pedido_compra
                },
                dataType: 'json',
                success: function (response, status, request) {
                    console.log(response);
                }
            });
        } else {
            formAddPedidoCompra.form('validate form');
        }
    });

    // Quando o campo perder o foco, a requisição é realizada
    $('input[name=numero_requisicao]').on('focusout', (event) => {
        let requisicaoID = event.target.value;
        if (requisicaoID != '') {
            $.ajax({
                url: 'Requisicoes/show',
                type: 'POST',
                data: { id: requisicaoID },
                dataType: 'json',
                success: function (response, status, request) {
                    console.log(response);
                    if (response.length > 0) {
                        for (var i = 0; i < response.length; i++) {
                            $('#table-produtos-requisicao tbody').append(
                                $('<tr>').attr('data-codigo', response[i].produto['codigo']).css('cursor', 'pointer').append(
                                    $('<td>').html(response[i].produto['descricao']).prop('title', response[i].produto['descricao']),
                                    $('<td>').html(response[i].quantidade)
                                ).on('click', function (event) {
                                    $(this).toggleClass('active');
                                })
                            );
                        }
                    }
                }
            });
        }
    });

    // Abre o modal para montar um pedido de compra
    buttonMontarPedido.on('click', (event) => {
        $('#addPedidoCompraModal').modal('show');
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

    $.ajax({
        url: '/Unidades/unidades',
        type: 'POST',
        dataType: 'json',
        success: function (response, status, request) {
            for (var i = 0; i < response.length; i++) {
                $('#dropdown-unidades-disabled .menu').append(
                    $('<div>').addClass('item').attr('data-value', response[i].id).html(response[i].descricao)
                );
            }
        }
    });
});

function initDropdownsOperacoes() {
    $.ajax({
        url: '/Produtos/produtos',
        type: 'POST',
        data: { action: 'request' },
        dataType: 'json',
        success: function (response, status, request) {
            for (var i = 0; i < response.length; i++) {
                $('#dropdown-produtos .menu').append(
                    $('<div>').addClass('item').attr('data-value', (response[i].codigo != "" ? response[i].codigo : response[i].cean)).html(response[i].descricao).attr('data-und', response[i].unidade_id)
                );
            }
            $('#dropdown-produtos').dropdown({
                context: '#addRequisicaoResumidaModal',
                onChange: function (value, text, $choice) {
                    $('#dropdown-unidades-disabled').dropdown('set selected', $choice.attr('data-und'));
                }
            });
        }
    });
}

// Adiciona um produto à tabela
function addProdutoInTable(codigo, produto, unidade, quantidade) {
    var table = document.getElementById('table-produtos-requisicao');
    var existe = false;
    if (table.rows.length > 1) {
        for (var r = 1, n = table.rows.length; r < n; r++) {
            if (produto == table.rows[r].cells[0].innerHTML) {
                table.rows[r].cells[2].innerHTML = parseInt(table.rows[r].cells[2].innerHTML, 10) + parseInt(quantidade, 10);
                existe = true;
                break;
            }
        }
        if (!existe) {
            $('table#table-produtos-requisicao tbody').append(
                $('<tr>').attr('data-id', codigo).append(
                    $('<td>').html(produto),
                    $('<td>').html(unidade),
                    $('<td>').html(quantidade)
                )
            );
        }
    } else {
        $('table#table-produtos-requisicao tbody').append(
            $('<tr>').attr('data-id', codigo).append(
                $('<td>').html(produto),
                $('<td>').html(unidade),
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
            quantidade: table.rows[r].cells[2].innerHTML
        }
        produtos.push(produto);
    }
    return produtos;
}

// Percorre a tabela e retorna os produtos e os precos determinados pelo usuário
function getTableProdutosPreco() {
    var table = document.getElementById('table-produtos-requisicao-preco');
    var produtos = [];
    for (var r = 1, n = table.rows.length; r < n - 1; r++) {
        var produto = {
            codigo_produto: table.rows[r].getAttribute('data-codigo'),
            quantidade: table.rows[r].cells[1].innerHTML,
            preco_produto: table.rows[r].cells[2].innerHTML
        }
        produtos.push(produto);
    }
    return produtos;
}

function setFormPedidoCompraValidate() {
    $('#addPedidoCompraForm').form({
        fields: {
            numero_requisicao: {
                identifier: 'numero_requisicao',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Informe o número da requisição de compra'
                    }
                ]
            },
            codigo_fornecedor: {
                identifier: 'codigo_fornecedor',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Selecione um fornecedor'
                    }
                ]
            },
            data_pedido: {
                identifier: 'data_pedido',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Informe a data do pedido'
                    }
                ]
            }
        },
        inline: true
    });
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