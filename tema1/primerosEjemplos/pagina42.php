<?php
//todo viaja si lleva la etiqueta name
/*
if (isset($_GET['nombre'])){
    echo 'Parámetro por get: ' . $_GET['nombre'] . '<br>';
}

if (isset($_POST['nombre'])){
    echo 'Parámetro por post: ' . $_POST['nombre'];
}
*/

//Comprobación de nuestra clase Reader

/*
once --> Incluye la dependencia si no se ha incluido anteriormente (esto pasa por mala programación)
**intentar siempre sin once**
diferencia entre include y required
require si no tenemos esa dependencia el programa se para....mientras el include, en caso de que no
encontremos la dependencia, el programa segirá ejecutandose.
*/
require('classes/Reader.php');
//require'';
//require_once''; No
//require_once(''); No
//Mismas variantes que require
//include'';
//include_once''; No

echo Reader::read('nombre');