(function(){
    
    document.getElementById('tablaProducto').addEventListener('click', clickTabla);
    
    function clickTabla (event){
        // return confirm("Estas seguro de que quieres eliminar el item.");
        let target = event.target;
        if (target.tagName === 'A' && target.getAttribute('class') === 'borrar'){
            if (!confirm('Realmente quiere borrar')){
                event.preventDefault();
            }
        }else if (target.tagName === 'A' && target.getAttribute('class') === 'editar'){
            // event.preventDefault();
            // let dataId = target.getAttribute("data-id");
            // let id = document.getElementById('id');
            // id.value = dataId;
            // let feditar = document.getElementById('fEditar');
            // feditar.submit;
        }else if (target.tagName === 'INPUT' && target.parentNode.parentNode.parentNode.tagName === 'THEAD'){
            let nodes = document.getElementsByClassName("cbDelete");
            let state = target.checked;
            for(let item of nodes){
                item.checked = state;
            }
        }
    }
})();