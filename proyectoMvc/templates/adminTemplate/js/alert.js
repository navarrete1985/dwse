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

(function() {
    $('.borrar').on('click', function(e){
        e.preventDefault();
        var target = e.currentTarget;
        var a = $('#enlace')[0];
        a.href = target.href;
        var fClose = function(){
            modal.modal("hide");
        };
        var onConfirm = function() {
           window.location = a.href;
        };
        var modal = $("#confirmSimple");
        modal.modal("show");
        $("#btConfirmSimpleDelete").unbind().one('click', onConfirm).one('click', fClose);
        $("#btCerrarmSimpleDelete").unbind().one("click", fClose);
    });
    
})();

$(function() {
	let form = $('#form-user');
	form.on('submit', event => {
		event.preventDefault();
		if ($('#clave').val() === $('#rclave').val()) {
			let modal = $('#confirmSimple');
			document.querySelector('.modal .title').textContent = 'Atención';
			document.querySelector('.modal .content').textContent = '¿Seguro que quiere realizar esta operación?';
			modal.modal('show');
			$("#btConfirmSimpleDelete").unbind().one('click', () =>{
				form[0].submit();
			}).one('click', () =>{
				modal.modal('hide');	
			});
	        $("#btCerrarmSimpleDelete").unbind().one("click", () => modal.modal('hide'));	
		} else {
			showMessage('Las contraseñas no coinciden', 'Asegúrese de que las contraseñas sean iguales', 'danger');
		}
	});
});