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

    getCiudades(1);
    /*genericAjax('ajax/listaciudades', null, 'get', function(json) {
        //$('#verListaDeValores').append('ha llegado el resultado');
        procesarCiudades(json.ciudades);
        procesarPaginas(json.paginas);
    });*/
        
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
    
    function getTrCiudades (value) {
        return `<tr>
                    <td>${value.id}</td>
                    <td>${value.name}</td>
                    <td>${value.countrycode}</td>
                    <td>${value.district}</td>
                    <td>${value.population}</td>
                </tr>`;
    }
    
    function procesarCiudades(ciudades) {
        var listaitems = '';
        $.each(ciudades, function(key, value) {
            //listitems += '<tr><td>' + key + '</td><td><td>' + value.codigo + '</td><td>' + value.descripcion + '</td></tr>';
            listaitems += getTrCiudades(value);
            console.log(listaitems);
        });
        borrarHijos("#cuerpoTablaCiudades");
        $('#cuerpoTablaCiudades').append(listaitems);
    }
    
    function procesarPaginas(paginas) {
        // "paginas":{"primero":1,"anterior":4,"siguiente":6,"ultimo":408,"cuenta":4079,"pagina":"5","rango":[1,2,3,4,5,6,7,8,9,10]}}
        
        var stringFirst = "<a href='' class='btn btn-primary'>"+paginas.primero+"</a>";
        var stringPrev = "<a href='' class='btn btn-primary'>"+paginas.anterior+"</a>";
        var stringRange='';
        
        $.each(paginas.rango, function(key, value) {
            stringRange += "<a href='#' class='btnPagina btn btn-primary' data-pagina='"+value+"'>"+value+"</a>";
        });
            
        var stringNext = "<a href='' class='btnPagina btn btn-primary'>"+paginas.siguiente+"</a>";
        var stringLast = "<a href='' class='btnPagina btn btn-primary'>"+paginas.ultimo+"</a>";
        
        var finalString = stringFirst + stringPrev + stringRange + stringNext + stringLast;
        
        borrarHijos("#pintarPaginas");
        $("#pintarPaginas").append(stringRange);
        $(".btnPagina").on("click",function(e){
            e.preventDefault();
            var p = e.target.getAttribute("data-pagina");
           
           getCiudades(p); 
        });
    }
    
    function getCiudades(pagina){
        genericAjax('ajax/listaciudades?pagina=' + pagina, null, 'get', function(json) {
            procesarCiudades(json.ciudades);
            procesarPaginas(json.paginas);
        }); 
    }
    
    function borrarHijos(padre){
        $(padre).empty();
    }

})();