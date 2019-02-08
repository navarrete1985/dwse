(function () {

    /* global $ */

    var aliasok = true;
    var emailok = false;
    var usuario = null;

    var genericAjax = function (url, data, type, callBack) {
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
    
    var genericUploadAjax = function (url, idFile, callBack) {
        let formData = new FormData();
        formData.append('image', document.getElementById(idFile).files[0]);
        $.ajax({
            url: url,
            data: formData,
            type: 'post',
            contentType: false,
            processData: false,
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

    var getCiudades = function (pagina) {
        genericAjax('ajax/listaciudades', {'pagina': pagina}, 'get', function(json) {
            procesarCiudades(json.ciudades);
            procesarPaginas(json.paginas);
        });
    }

    var getTrCiudades = function (value) {
        return `<tr>
                    <td>${value.id}</td>
                    <td>${value.name}</td>
                    <td>${value.countrycode}</td>
                    <td>${value.district}</td>
                    <td>${value.population}</td>
                </tr>`;
    };

    var initialAjax = function() {
        genericAjax('ajax/main', null, 'get', function(json) {
            if(json.login) {
                $('#verListaDeValores').show();
                usuario = json.usuario;
                mostrarLogin(json);
            } else {
                $('#verBotonesLoginRegistro').show();
            }
        });
    }

    var mostrarLogin = function(json) {
        $('#infoUsuario').append(' (' + usuario.nombre + ' ' + usuario.apellidos + ')');
        procesarCiudades(json.ciudades);
        procesarPaginas(json.paginas);
    };

    var procesarCiudades = function (ciudades) {
        var listaitems = '';
        $.each(ciudades, function(key, value) {
            listaitems += getTrCiudades(value);
        });
        $('#cuerpoTablaCiudades').empty();
        $('#cuerpoTablaCiudades').append(listaitems);
    }
    
    var procesarPaginas = function (paginas) {
        var stringFirst = '<a href = "#" class = "btn btn-primary">' + paginas.primero + '</a>';
        var stringPrev  = '<a href = "#" class = "btn btn-primary">' + paginas.anterior + '</a>';
        var stringRange = '';
        $.each(paginas.rango, function(key, value) {
            if(paginas.pagina == value) {
                stringRange += '<a href = "#" class = "btnNoPagina btn btn-info">' + value + '</a> ';
            } else {
                stringRange += '<a href = "#" class = "btnPagina btn btn-primary" data-pagina="' + value + '">' + value + '</a> ';
            }
        });
        var stringNext = '<a href = "#" class = "btnPagina btn btn-primary">' + paginas.siguiente + '</a>';
        var stringLast = '<a href = "#" class = "btnPagina btn btn-primary">' + paginas.ultimo + '</a>';
        var finalString = stringFirst + stringPrev + stringRange + stringNext + stringLast;
        $('#pintarPaginas').empty();
        $('#pintarPaginas').append(stringRange);
        $('.btnPagina').on('click', function(e) {
            e.preventDefault();
            var p = e.target.getAttribute('data-pagina');
            getCiudades(p); 
        });
        $('.btnNoPagina').on('click', function(e) {
            e.preventDefault();
        });
    }

    $(document).ajaxStart(function () {
        console.log('pre shadow');
        $('#loading').show();
    });

    $(document).ajaxStop(function () {
        console.log('post shadow');
        $('#loading').hide();
    });

    $('#alias').on( 'blur', function(event) {
        aliasok = false;
        if(event.target.value.trim() !== '') {
            genericAjax('ajax/comprobaralias', {'alias' : event.target.value.trim()}, 'get', function(json) {
                if(json.aliasdisponible) {
                    aliasok = true;
                }
            });
        } else {
            aliasok = true;
        }
    });

    $('#btLogin').on('click', function(event) {
        var parametros = {
            correo      : $('#correologin').val().trim(),
            clave       : $('#clavelogin').val().trim()
        };
        if(parametros.correo !== '' && parametros.clave !== '') {
            genericAjax('ajax/dologin', parametros, 'get', function(json) {
                if(json.login) {
                    usuario = json.usuario;
                    $('#modallogin').modal('hide');
                    $('#verBotonesLoginRegistro').hide();
                    $('#verListaDeValores').show();
                    mostrarLogin(json);
                } else {
                    alert('Login ha fallado.');
                }
            });
        }
    });

    $('#btLogout').on('click', function(event) {
        genericAjax('ajax/dologout', null, 'get', function(json) {
            usuario = null;
            $('#verBotonesLoginRegistro').show();
            $('#verListaDeValores').hide();
        });
    });

    $('#btRegister').on('click', function(event) {
        if(aliasok && emailok) {
            var parametros = {
                alias       : $('#alias').val().trim(),
                nombre      : $('#nombre').val().trim(),
                correo      : $('#correo').val().trim(),
                apellidos   : $('#apellidos').val().trim(),
                clave       : $('#clave').val().trim(),
                repiteclave : $('#repiteclave').val().trim()
            };
            if(parametros.clave === parametros.repiteclave
                    && parametros.nombre !== ''
                    && parametros.correo !== ''
                    && parametros.apellidos !== ''
                    && parametros.clave !== '' ) {
                genericAjax('ajax/register', parametros, 'get', function(json) {
                    if(json.alta > 0) {
                        $('#modalregister').modal('hide');
                    } else {
                        alert('Hay un error búscalo');
                    }
                });
            }
        } else {
            alert('no puedo procesarlo');
        }
    });

    $('#correo').on( 'blur', function(event) {
        emailok = false;
        if(event.target.value.trim() !== '') {
            genericAjax('ajax/comprobarcorreo', {'correo' : event.target.value.trim()}, 'get', function(json) {
                if(json.correodisponible) {
                    emailok = true;
                }
            });
        }
    });

    $('#modallogin').on('hidden.bs.modal', function () {
        $('#correologin').val('');
        $('#clavelogin').val('');
    });

    $('#modalregister').on('hidden.bs.modal', function () {
        $('#alias').val('');
        $('#nombre').val('');
        $('#correo').val('');
        $('#apellidos').val('');
        $('#clave').val('');
        $('#repiteclave').val('');
    });
    
    $('#verBotonesLoginRegistro').hide();
    $('#verListaDeValores').hide();
    initialAjax();
    //getCiudades(1);

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
    // $('#avatar').hide();
    $('#btAvatar').on('click', event => {
        $('#avatar').trigger('click');
    });
    
    $('#avatar').on('change', event => {
        preview($('#avatar')[0]);
        window.setTimeout(() => {
            genericUploadAjax('ajax/upload', 'avatar', json => {
                if (json.upload.result) {
                     $('#imagephp').attr('src', json.upload.route);
                }
            });    
        }, 5000);  
    })
    
    function preview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                $('#imagejs').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
})();