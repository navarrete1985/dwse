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

function genericAjax (url, data, type, callBackDone, callbackFail, callbackAlways) {
    $.ajax({
        url: url,
        data: data,
        type: type,
        dataType : 'json',
    })
    .done(function( json ) {
        callBackDone(json);
    })
    .fail(function( xhr, status, errorThrown ) {
        if (callbackFail !== undefined && callbackFail !== null) {
        	callbackFail(status, errorThrown);
        }
    })
    .always(function( xhr, status ) {
        if (callbackAlways !== undefined && callbackAlways !== null) {
        	callbackAlways(status);
        }
    });
}

function add(action, data, completeCallback) {
	genericAjax(action, data, 'post', response => {
		switch (response.result){
			case -1:
				showMessage('Error', 'La categoría que intenta insertar está ya en uso', 'danger');
				break;
			case 0:
				showMessage('Error', 'Ha ocurrido un error inesperado', 'danger');
				break;
			default:
				completeCallback(response);
				break;
		}
	}, error => console.log('error en la petición ajax status --> ' + error ));

}

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

$(function() {
	if ($('#form-link').length > 0) {
		
		$('#add-category').on('click', event => {
			let catValue = $('#category-name').val().trim();
			if (catValue.length > 0){
				add($(event.currentTarget).attr('data-action'), {category: catValue}, response => addCategory(catValue, response.result));
			}
		})
		
		$('#save').on('click', event => {
			if (validateFields()) {
				add($(event.currentTarget).attr('data-action'), {href: $('#link').val(), comentario: $('textarea').val(), categoryId: $('#selectList').val()}, response => {
					clearInputs();
					showMessage('Éxito', 'El link se ha agragdo satisfactoriamente', 'success');
				})
			}
		})
	}
	
	function addCategory(category, value) {
		$("#selectList").append(new Option(category, value));
		showMessage('Éxito', 'La insercción de la nueva categoría se ha realizado con éxito', 'success');
		$('#category-name').val('');
	}
	
	function validateFields() {
		let expression = /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/gi;
		let regex = new RegExp(expression);
		let error = 0;
		error += $('#link').val().trim().match(regex) ? 0 : 1;
		error += $('textarea').val().trim().length > 0 ? 0 : 1;
		return error === 0 ? true : false;
	}
	
	function clearInputs() {
		$('#link').val('');
		$('textarea').val('');
		$("#selectList").val($("#selectList option:first").val());
	}
});

$(function() {
	if ($('#links-table').length > 0) {
		$('#links-table thead a').on('click', event => {
			event.preventDefault();
			genericAjax('ajax/getLinks', {pagina: $(event.currentTarget).attr('data-page'),
										  orden: $(event.currentTarget).attr('data-value')}, 'post', response => {
				renderTable(response);
				renderPagination(response);
			})
		});
		addPaginationListener();
	}
	
	function renderTable(data) {
		let table = '';
		Array.from(data.links).forEach(item => {
			table += `
			<tr>
			<td>
				${item.link.categoria}
			</td>
			<td>
				${item.link.href}
			</td>
			<td>
				${item.link.comentario}
			</td>
			<td>
				<a href='#' data-action='ajax/deleteLink' data-id='${item.link.id}' class='borrar'>
					<button type='button' class='btn btn-inverse-danger btn-rounded btn-sm'>
						<i class='mdi mdi-alert-outline'></i>
						Eliminar
					</button>
				</a>
            </td>
            </tr>`;
		});
		
		$('#links-table tbody').empty();
		$('#links-table tbody').append(table);
	}
	
	function renderPagination(data) {
		let paginacion = '';
		if(data.paginas.actual != 1) {
			paginacion += `<div class='btn-group'>`;
			if (data.paginas.actual > 2) {
				paginacion += `
					<a class='btn btn-primary' data-page='${data.paginas.primero}'>
		                <i class="fa fa-angle-double-left text-white"></i>
		              </a>	
				`;
			}
			paginacion += `
				<a class='btn btn-primary' data-page='${data.paginas.anterior}'>
	              <i class="fa fa-angle-left text-white"></i>
	            </a>  
	          </div>
			`;
		}
		
		paginacion += `<div class='btn-group ml-1'>`;
		Array.from(data.paginas.range).forEach(item => paginacion += `<a class='btn ${data.paginas.actual == item ? 'btn-light' : 'btn-primary'}' data-page='${item}'>${item}</a>`);
		paginacion += `</div>`;
		if (data.paginas.actual != data.paginas.ultimo) {
			paginacion += `
				<div class='btn-group ml-1'>
		          <a class='btn btn-primary' data-page='${data.paginas.siguiente}'>
		            <i class="fa fa-angle-right text-white"></i>
		          </a>
			`;
			if (data.paginas.actual != data.paginas.ultimo - 1) {
				paginacion += `
					<a class='btn btn-primary' data-page='${data.paginas.ultimo}'>
		              <i class="fa fa-angle-double-right text-white"></i>
		            </a>
				`;
			}
			paginacion += `</div>`;
		}
		$('#pagination-order').val(data.paginas.order);
		$('#paginacion').empty();
		$('#paginacion').append(paginacion);
		addPaginationListener();
	}
	
	function addPaginationListener() {
		$('#paginacion a').on('click', event => {
			event.preventDefault();
			genericAjax('ajax/getLinks', {pagina: $(event.currentTarget).attr('data-page'),
										  orden: $('#pagination-order').val()}, 'post', response => {
				renderTable(response);
				renderPagination(response);
				addDeleteListener();
			})
		})
	}
	
	function addDeleteListener() {
		$('.borrar').on('click', function(e){
	        e.preventDefault();
	        var target = e.currentTarget;
	        var fClose = function(){
	            modal.modal("hide");
	        };
	        var onConfirm = function() {
				add($(e.currentTarget).attr('data-action'), {link: $(e.currentTarget).attr('data-id')}, response => {
					$(e.currentTarget).closest('tr').remove();
					showMessage('Éxito', 'El link se ha eliminado con éxito');
				})
	        };
	        var modal = $("#confirmSimple");
	        modal.modal("show");
	        $("#btConfirmSimpleDelete").unbind().one('click', onConfirm).one('click', fClose);
	        $("#btCerrarmSimpleDelete").unbind().one("click", fClose);
	    });
	}
	
	addDeleteListener();
});

$(document).ajaxStart(function () {
    $('#wrapper-loader').removeClass('hidden');
});

$(document).ajaxStop(function () {
    $('#wrapper-loader').addClass('hidden');
});