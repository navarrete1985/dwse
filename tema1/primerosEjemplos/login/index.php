<?php

require('../classes/Autoload.php');

/*session_name('DWES_SESSION');
session_start();
$mensaje = 'No estás logueado';
if(isset($_SESSION['usuario'])) {
    $mensaje = 'Estás logueado y eres: ' . $_SESSION['usuario'];
}
$peras = 0;
if(isset($_SESSION['peras'])) {
    $peras = $_SESSION['peras'];
}*/

$sesion = new Session2('DWES_SESSION');
$mensaje = 'No estás logueado';
if($sesion->isLogged()) {
    $mensaje = 'Estás logueado y eres: ' . $sesion->getLogin();
}

$peras = $sesion->get('peras');
if($peras === null) {
    $peras = 0;
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        <h1><?= $mensaje ?></h1>
        <form action="login.php" method="post">
            <input type="text"     name="usuario" placeholder="usuario" required/>
            <input type="password" name="clave"   placeholder="clave"   required/>
            <input type="submit" value="Submit"/>
        </form>
        <br>
        <a href="private.php">página privada</a>
        <a href="logout.php">cerrar sesión</a>
        <a href="peras.php">comprar peras</a>
        Llavas tantas peras: <?= $peras ?>
    </body>
</html>