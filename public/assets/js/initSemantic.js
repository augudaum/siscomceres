$('.ui.sidebar').sidebar({
    context: $('.bottom.segment')
}).sidebar('attach events', '.menu .item#sidebar-trigger');

// Fechar as mensagens ao clicar no close
$('.message .close').on('click', function () {
    $(this).closest('.message').transition('fade');
});

$('.ui.checkbox').checkbox();