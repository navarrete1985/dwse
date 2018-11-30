<?php

$param = '-';
if(isset($_GET['parametros'])) {
    $param = $_GET['parametros'];
}

echo '<h1>Valor que se ha obtenido:' . $param . '</h1>';