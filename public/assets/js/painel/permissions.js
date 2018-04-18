$(document).ready(function () {

	var button_permission = $('.button-permission');

	button_permission.on('click', function (event) {
		event.preventDefault();

		var data = $(this).attr('data-action');

		$.ajax({
			url: '/permissoes/update',
			data: 'data=' + data,
			type: 'post',
			success: function (response) {
				if (response == 'atualizado') {
					swal({
						title: 'Atualização realizada',
						text: 'As permissões foram alteradas.',
						icon: 'success',
						button: 'OK'
					}).then(() => {
						location.reload();
					});
				} else {
					swal('Falha ao atualizar', 'Você não tem permissões para executar essa ação', 'warning');
				}
			}
		});
	});

});