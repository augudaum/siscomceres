$(document).ready(function () {
    var button_addproduto = $('#button-addproduto');
    var button_saveproduto = $('#button-saveproduto');
    var button_deleteproduto = $('#button-deleteproduto');
    var form_addproduto = $('#addProdutoForm');

    // Seta a validação dos campos do formulário
    setFormProdutosValidation();

    // Inicializa os dropdowns
    initDropdownsProdutos();

    // Inicialização das tabs
    $('.tabular.menu .item').tab();

    // Reseta o form e limpa a tabela de contatos quando o modal fechar
    $('#addProdutoModal').modal({
        onHidden: function () {
            form_addproduto.form('clear');
        }
    });

    // Evento de clique sobre uma linha da tabela abrindo o form para atualização
    $('#table-produtos tbody tr td').on('click', function (event) {
        buttonUpdateInterface();
        // Recuperando o código do produto selecionado
        var codigo = $(this).parent().children()[0].innerText;
        $.ajax({
            url: '/Produtos/show',
            type: 'POST',
            data: { codigo: codigo },
            dataType: 'json',
            success: function (response, status, request) {
                $('input[name=codigo]').val(response.produto.codigo);
                $('input[name=cean]').val(response.produto.cean);
                $('input[name=marca]').val(response.produto.marca);
                $('input[name=fabricante]').val(response.produto.fabricante);
                $('input[name=descricao_fiscal]').val(response.produto.descricao_fiscal);
                $('input[name=descricao]').val(response.produto.descricao);
                $('input[name=ncm]').val(response.produto.ncm);
                $('#dropdown-unidades').dropdown('set selected', response.produto.unidade_id);
                $('#dropdown-tipo-itens').dropdown('set selected', response.produto.tipo_item_codigo);
                $('#dropdown-generos').dropdown('set selected', response.produto.genero_codigo);
                $('input[name=estoque_minimo]').val(response.produto.estoque_minimo);
                $('input[name=pc_compra]').val(response.produto.pc_compra);
                $('input[name=pc_custo]').val(response.produto.pc_custo);
                $('input[name=pc_venda]').val(response.produto.pc_venda);
            }
        });
        $('#addProdutoModal .header')[0].innerHTML = '<i class="archive icon"></i> Atualizar participante';
        $('#addProdutoModal').modal('show');
    });

    button_addproduto.on('click', function (event) {
        buttonNewInterface();
        $('#addProdutoModal .header')[0].innerHTML = '<i class="archive icon"></i> Cadastrar Produto';
        $('#addProdutoModal').modal('show');
    });

    button_saveproduto.on('click', function (event) {
        event.preventDefault();
        if (form_addproduto.form('is valid')) {
            if ($(this).attr('data-action') == 'create') {
                $.ajax({
                    url: '/Produtos/store',
                    type: 'POST',
                    data: form_addproduto.serialize(),
                    dataType: 'json',
                    success: function (response, status, request) {
                        $('#addProdutoModal').modal('hide');
                        if (response > 0) {
                            swal({
                                title: 'Operação realizada!',
                                text: 'Produto cadastrado com sucesso!',
                                icon: 'success',
                                button: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            swal({
                                title: 'Operação não realizada!',
                                text: 'Não foi possível cadastrar o produto!',
                                icon: 'error',
                                button: 'OK'
                            });
                        }
                    }
                });
            } else {
                $.ajax({
                    url: '/Produtos/update',
                    type: 'POST',
                    data: form_addproduto.serialize(),
                    dataType: 'json',
                    success: function (response, status, request) {
                        $('#addProdutoModal').modal('hide');
                        if (response > 0) {
                            swal({
                                title: 'Operação realizada!',
                                text: 'Produto atualizado com sucesso!',
                                icon: 'success',
                                button: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            swal({
                                title: 'Operação não realizada!',
                                text: 'Não foi possível atualizar o produto!',
                                icon: 'error',
                                button: 'OK'
                            });
                        }
                    }
                });
            }
        } else {
            form_addproduto.form('validate form');
        }
    });
});

// Muda a interface do botão para atualização
function buttonUpdateInterface() {
    $('#button-saveproduto').removeClass('primary').addClass('green').html("Atualizar").attr('data-action', 'update');
}

// Muda a interface do botão para adição
function buttonNewInterface() {
    $('#button-saveproduto').removeClass('green').addClass('primary').html("Salvar").attr('data-action', 'create');
}

function initDropdownsProdutos() {
    $.ajax({
        url: '/Unidades/unidades',
        type: 'POST',
        dataType: 'json',
        success: function (response, status, request) {
            for (var i = 0; i < response.length; i++) {
                $('#dropdown-unidades .menu').append(
                    $('<div>').addClass('item').attr('data-value', response[i].id).html(response[i].descricao)
                );
            }
            $('#dropdown-unidades').dropdown({
                context: '[data-tab=dados-produtos]'
            });
        }
    });

    $.ajax({
        url: '/Produtos/generos',
        type: 'POST',
        dataType: 'json',
        success: function (response, status, request) {
            for (var i = 0; i < response.length; i++) {
                $('#dropdown-generos .menu').append(
                    $('<div>').addClass('item').attr('data-value', response[i].codigo).html(response[i].descricao)
                );
            }
            $('#dropdown-generos').dropdown({
                context: '[data-tab=dados-produtos]',
                action: function (text, value) {
                    $('#dropdown-generos').dropdown('set text', text.substring(0, 19) + '...');
                }
            });
        }
    });

    $.ajax({
        url: '/Produtos/tipoItens',
        type: 'POST',
        dataType: 'json',
        success: function (response, status, request) {
            for (var i = 0; i < response.length; i++) {
                $('#dropdown-tipo-itens .menu').append(
                    $('<div>').addClass('item').attr('data-value', response[i].codigo).html(response[i].descricao)
                );
            }
            $('#dropdown-tipo-itens').dropdown({
                context: '[data-tab=dados-produtos]'
            });
        }
    });
}

$.fn.form.settings.rules.greaterThan = function (inputValue, validationValue) {
    return inputValue > validationValue;
}

function setFormProdutosValidation() {
    $('#addProdutoForm').form({
        fields: {
            estoque_minimo: {
                identifier: 'estoque_minimo',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Este campo não pode ficar vazio'
                    },
                    {
                        type: 'greaterThan[0]',
                        prompt: 'Insira valores maiores do que 0'
                    }
                ]
            },
            descricao_fiscal: {
                identifier: 'descricao_fiscal',
                rules: [
                    {
                        type: 'maxLength[40]',
                        prompt: 'Inisira, no máximo, 40 caracteres'
                    }
                ]
            },
            descricao: {
                identifier: 'descricao',
                rules: [
                    {
                        type: 'maxLength[120]',
                        prompt: 'Inisira, no máximo, 120 caracteres'
                    }
                ]
            }
        },
        inline: true
    });
}