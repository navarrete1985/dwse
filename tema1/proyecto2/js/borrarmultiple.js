(function (){
    document.getElementById('btConfirmDelete').addEventListener('click', function(){
        let form = document.getElementById('fBorrar');
        let modal = document.getElementById('confirm');
        modal.tabIndex = -1;
        form.submit();
    })
})();