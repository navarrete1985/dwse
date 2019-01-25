(function () {

    /* global $ */

    $(document).ajaxStop(function () {
        console.log('post shadow');
        $('#loading').hide();
    });

    $(document).ajaxStart(function () {
        console.log('pre shadow');
        $('#loading').show();
    });

    var genericAjax = function(url, data, type, callBack) {
        $.ajax({
            url: url,
            data: data,
            type: type,
            dataType : 'json',
        })
        .done(function( json ) {
            console.log('ajax done');
            console.log(json);
            callBack(json);
        })
        .fail(function( xhr, status, errorThrown ) {
            console.log('ajax fail');
        })
        .always(function( xhr, status ) {
            console.log('ajax always');
        });
    }

    genericAjax('ajax/listavalores', null, 'get', function(json) {
        //$('#verListaDeValores').append('ha llegado el resultado');
        var listitems = '';
        $.each(json.resultado, function(key, value) {
            listitems += '<tr><td>' + key + '</td><td><td>' + value.codigo + '</td><td>' + value.descripcion + '</td></tr>';
        });
        $('#cuerpoTablaCiudades').append(listitems);
    });
        
    /*document.getElementById('btAjax').addEventListener('click', function(event) {
        event.preventDefault();
        genericAjax('ajax/listavalores', null, 'get', function(json) {
            $('#verListaDeValores').append('ha llegado el resultado');
        });
        
    });*/
    
    /*genericAjax('', null, 'get', function(json) {
    });*/

    /*genericAjax('listavalores', null, 'get', function(json) {
        var listitems = '';
        $.each(json, function(key, value) {
            listitems += key + value.codigo + value.descripcion;
        });
        $('#id').append(listitems);
    });*/

})();