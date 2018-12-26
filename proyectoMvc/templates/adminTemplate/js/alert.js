if ($('#my-notify').length > 0) {
	window.setTimeout($.notify({
		title: '<strong>'+ $('#my-notify').attr('title') + '</strong><br>',
		message: $('#my-notify').attr('message')},
		{
		type: $('#my-notify').attr('type') == 1 ? 'danger' : 'success',
		delay: 3000,
		animate: {
			enter: 'animated zoomInDown',
			exit: 'animated zoomOutUp'
		},
		placement: {
			from: "top",
			align: "left"
		},
	}), 500);
}