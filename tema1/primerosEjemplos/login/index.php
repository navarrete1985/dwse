<?php
session_name('DWES_SESSION');
session_start();
$mensaje = 'No estás logueado';

if (isset($_SESSION['usuario'])) {
    $mensaje = 'Estás logueado y eres: ' . $_SESSION['usuario'];
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
            <input type="text" name="usuario" placeholder="Usuario" required/>
            <input type="text" name="clave" placeholder="Usuario" required/>
            <input type="submit" value="Submit"/>
        </form>
        <br>
        <a href="private.php">Página Privada</a>
        <a href="logout.php">Cerrar Sesión</a>
    </body>
</html>