<?php

// session_name('DWES_SESSION');
// session_start();
// if (isset($_SESSION['usuario'])) {
//     $texto = 'Información privada para: ' . $_SESSION['usuario'];
// }else {
//     header('Location: index.php');
//     exit();
// }

require('../classes/Autoload.php');
$sesion = new Session2('DWES_SESSION');

if($sesion->isLogged()) {
    $texto = 'información privada para: ' . $sesion->getLogin();
} else {
    header('Location: index.php');
    exit();
}

if ($ses)
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
    <h3><?= $texto ?></h3>
</body>
</html>