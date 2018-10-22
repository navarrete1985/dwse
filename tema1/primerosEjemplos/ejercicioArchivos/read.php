<?php

require '../classes/Autoload.php';

$archivo = $_GET['archivo'];
$folder = $_GET['user'];
header('Content-Type: image/jpeg');
readfile('/home/ubuntu/private/' . $folder . '/' . $archivo);
    
?>