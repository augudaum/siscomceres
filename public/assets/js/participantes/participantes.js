$(document).ready(function () {
    var button_addparticipante = $('#button-addparticipante');
    var button_saveparticipante = $('#button-saveparticipante');
    var form_addparticipante = $('#addParticipanteForm');
    setFormValidation();

    button_saveparticipante.on('click', function (event) {
        if (form_addparticipante.form('is valid')) {
            // $.ajax({
            //     url: '/participantes/store',
            //     type: 'POST',
            //     data: form_addparticipante.serialize(),
            //     dataType: 'json',
            //     success: function (response, status, request) {
            //         console.log(response);
            //     }
            // });
        } else {
            form_addparticipante.form('validate form');
        }
    });

    button_addparticipante.on('click', function (event) {
        $('#addParticipanteModal').modal('show');
    });

    $('#dropdown_rg').dropdown();
    $('#dropdown-pais').dropdown();
    $('#dropdown-estado').dropdown();
    $('#dropdown-cidade').dropdown();
});

function setFormValidation() {
    $('#addParticipanteForm').form({
        fields: {
            cpf: {
                identifier: 'cpf',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Informe o CPF'
                    }
                ]
            },
            cnpj: {
                identifier: 'cnpj',
                rules: [
                    {
                        type: 'maxLength[14]',
                        prompt: 'Você não digitou os 14 dígitos corretamente'
                    }
                ]
            }
        },
        inline: true
    });
}