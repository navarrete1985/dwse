(function () {
    var tabla = document.getElementById("tabla");
    tabla.addEventListener('click', clickTabla);
    var primero = document.getElementById("checkAll");
    primero.addEventListener("click", cogerInput);
    
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