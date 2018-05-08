$(document).ready(function () {
    var button_addproduto = $('#button-addproduto');
    var button_saveproduto = $('#button-saveproduto');
    var button_deleteproduto = $('#button-deleteproduto');
    var form_addproduto = $('#addprodutoForm');

    // Seta a validação dos campos do formulário
    setFormValidation();

    // Inicializa os dropdowns
    initDropdowns();

    // Inicialização das tabs
    $('.tabular.menu .item').tab();
        
    button_addproduto.on('click', function (event) {
        $('#addProdutoModal').modal('show');
    });

    $('#dropdown_rg').dropdown();
});