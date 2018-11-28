(function() {
    let form = document.getElementById('fEdit');
    let desenmascarar = document.getElementById('desenmascarar');
    let claveNueva = document.getElementById('clavenueva');
    let clave = document.getElementById('clave');
    let error = document.getElementById('passwdHelp');
    
    if (desenmascarar !== null) {
        desenmascarar.addEventListener('change', () => {
            if (clave.type.toLowerCase() === 'text') {
                clave.type = 'password';
            }else {
                clave.type = 'text';
            }
        })
    }
    
    document.getElementById('btConfirmDelete').addEventListener('click', (event) => {
        $('#confirm').modal('hide');
        if (claveNueva !== null) {
            if (claveNueva.value !== clave.value) {
                error.classList.remove('d-none');
                return;
            }else {
                error.classList.add('d-none');
            }
        }
        form.submit();
    })
})();