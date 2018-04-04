$(document).ready(function () {
    var button_addproduto = $('#button-addproduto');

    button_addproduto.on('click', function (event) {
        $('#addProdutoModal').modal('show');
    });

    $('#dropdown_rg').dropdown();
});