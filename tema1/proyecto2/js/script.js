/* global $ */
(function () {

    var btConfirmDelete = document.getElementById('btConfirmDelete');
    var checkAll = document.getElementById('checkAll');
    var checkDesenmascarar = document.getElementById('desenmascarar');
    var fBorrar = document.getElementById('fBorrar');
    var tabla = document.getElementById('tablaProducto');
    
    $('#modallogin').on('hidden.bs.modal', function (e) {
        correo.value = '';
        clave.value = '';
    });

    if(btConfirmDelete) {
        btConfirmDelete.addEventListener('click', function() {
            $('#confirm').modal('hide'); //jquery
            fBorrar.submit();
        });
    }

    if(fBorrar) {
        fBorrar.addEventListener('submit', confirmDelete);
    }
    
    if(checkAll) {
        checkAll.addEventListener('click', checkTable);
    }
    
    if(checkDesenmascarar) {
        checkDesenmascarar.addEventListener('click', desenmascarar);
    }

    if(tabla) {
        tabla.addEventListener('click', clickTable);
    }

    function checkTable() {
        var checkItems = document.getElementsByName('ids[]');
        for (var i = 0; i < checkItems.length; i++) {
            checkItems[i].checked = checkAll.checked;
        }
    }

    function clickTable(event) {
        var target = event.target;
        if(target.tagName === 'A' && target.getAttribute('class') === 'borrar') {
            confirmDelete(event);
        } else if(target.tagName === 'A' && target.getAttribute('class') === 'editar') {
            event.preventDefault();
            var dataId = target.getAttribute('data-id');
            var id = document.getElementById('id');
            id.value = dataId;
            var fEditar = document.getElementById('fEditar');
            fEditar.submit();
        }
    }

    function confirmDelete(event) {
        if(!confirm('¿De verdad?')) {
            event.preventDefault();
        }
    }
    
    function desenmascarar() {
        var clave = document.getElementById('clave');
        if(checkDesenmascarar.checked) {
            clave.setAttribute('type', 'text');
        } else {
            clave.setAttribute('type', 'password');
        }
    }

})();