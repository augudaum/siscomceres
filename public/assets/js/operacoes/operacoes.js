$(document).ready(() => {
    var button_addrequisicao = $('#button-addrequisicao');
    var button_addpedido = $('#button-addpedido');

    // Abre o modal para cadastrar uma requisição
    button_addrequisicao.on('click', (event) => {
        $('#addRequisicaoModal').modal('show');
    });

    // Abre o modal para montar um pedido de compra
    button_addpedido.on('click', (event) => {
        $('#addPedidoModal').modal('show');
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
                    'title', 'cpf_cnpj'
                ],
                error: {
                    noResults: 'Nenhuma transportadora dentre as cadastradas foi encontrada'
                }
            });
        }
    });
});