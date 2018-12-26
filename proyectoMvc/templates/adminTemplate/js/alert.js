$(function(){
	if ($('#my-notify').length > 0) {
		window.setTimeout(showMessage($('#my-notify').attr('title'), 
									  $('#my-notify').attr('message'),
									  $('#my-notify').attr('type')), 500);
	}
});

$(function() {
	if ($('#register').length > 0) {
		$('#register').submit(event => {
			event.preventDefault();
			if ($.trim($('#passwd').val()).length > 0 && $('#passwd').val() === $('#rpasswd').val()) {
				$("#register")[0].submit();
			}else {
				showMessage('Las contraseñas no coinciden', 'Asegúrese de que las contraseñas sean iguales', 'danger');
			}
		})
	}
});

function showMessage(title, message, type) {
	let titleContent = title == undefined ? '' : '<strong>'+ title + '</strong><br>'
	$.notify({
		title: titleContent,
		message: message
		
	},
	{
		type: type,
		delay: 3000,
		animate: {
			enter: 'animated zoomInDown',
			exit: 'animated zoomOutUp'
		},
		placement: {
			from: "top",
			align: "left"
		},
	});
}