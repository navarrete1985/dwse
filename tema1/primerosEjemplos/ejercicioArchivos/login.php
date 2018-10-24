<?php

require '../classes/Autoload.php';

$response = Reader::get('response');
if ($response != null) {
    if ($response === 'success' || $response === 'error') {
        $message = ($response === 'success') ? 'con éxito' : 'erróneamente';
        echo '<h1 class="' . $response . '">La operación de registro se ha realizado ' . $message . '</h1>';    
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="./styles.css" type="text/css" />
    </head>
    <body>
        <form enctype="multipart/form-data" method="post" action="validacion.php" class="<?= ($response === null || $response !== 'success') ? 'visible' : 'hidden' ?>">
            <input type = "text" name = "name" placeholder = "Introduzca nombre" required/>
            <input type="file" name="image" accept="image/png, image/jpeg" required/>
            <input type="submit" value="Submit"/>
        </form>
        <form method="post" action="index.html" class="<?= ($response !== null && $response === 'success') ? 'visible' : 'hidden' ?>">
            <input type="submit" value="Atrás"/>
        </form>
    </body>
</html>