<?php

session_name('DWES_SESSION');
session_start();

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

if($usuario === 'pepe' && $clave === 'perez') {
    session_regenerate_id(); //Regeneramos el token de sesión cada vez que iniciemos sesión
    $_SESSION['usuario'] = $usuario;
}
header('Location: index.php');
exit();
