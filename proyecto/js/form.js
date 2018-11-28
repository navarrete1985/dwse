(function(){
    let inputPass = document.getElementById('inputPasswd');
    let repeatPass = document.getElementById('inputRepeatPasswd');
    let fieldError = document.getElementById('passwdHelp').parentNode;
    
    document.getElementById('fSignUp').addEventListener('submit', (event) => {
        if (inputPass.value !== repeatPass.value) {
            fieldError.classList.remove('d-none');
            event.preventDefault();
        }else {
            fieldError.classList.add('d-none');
        }
    });
})();

(function() {
    $('.borrar').on('click', function(e){
        e.preventDefault();
        var target = e.target;
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