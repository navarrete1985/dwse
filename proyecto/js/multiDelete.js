(function () {
    var tabla = document.getElementById("tablaUsuario");
    if (tabla !== null) {
        tabla.addEventListener('click', clickTabla);    
    }
    var primero = document.getElementById("checkAll");
    if (primero !== null){
        primero.addEventListener("click", cogerInput);    
    }
    
    document.getElementById('btConfirmDelete').addEventListener('click', function(){
        let form = document.getElementById('fBorrar');
        if (form === null) {
            form = document.getElementById('fEdit');
        }
        let modal = document.getElementById('confirm');
        modal.tabIndex = -1;
        form.submit();
    })
    
    function clickTabla(event) {
        var target = event.target;
        if(target.tagName === 'A' && target.getAttribute('class') === 'borrar') {
            if(!confirm("De verdad?")) {
                event.preventDefault();
            }
        } else if(target.tagName === 'A' && target.getAttribute('class') === 'editar') {
            event.preventDefault();
            var dataId = target.getAttribute('data-id');
            var id = document.getElementById('id');
            id.value = dataId;
            var fEditar = document.getElementById('fEditar');
            fEditar.submit();
        }
    }
    
    function cogerInput() {
        var segundo = document.getElementsByName("ids[]");
        for (var i = 0; i<segundo.length; i++){
            segundo[i].checked = primero.checked;
        }
    }
})();