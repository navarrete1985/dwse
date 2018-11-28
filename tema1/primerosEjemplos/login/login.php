<?php

require('../classes/Autoload.php');
$sesion = new Session2('DWES_SESSION');

/*session_name('DWES_SESSION');
session_start();*/


$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

if($usuario === 'pepe' && $clave === 'perez') {
    $sesion->login($usuario);
    /*session_regenerate_id();
    $_SESSION['usuario'] = $usuario;*/
}
header('Location: index.php');