$(document).ready(function () {
    var button_addfuncionario = $('#button-addfuncionario');

    button_addfuncionario.on('click', function (event) {
        $('#addFuncionarioModal').modal('show');
    });

    $('#dropdown_rg').dropdown();
});