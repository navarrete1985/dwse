<?php


$archivo = $_GET['archivo'];
header('Content-Type: image/jpeg');
readfile('../../../../privado/' . $archivo);

/*
Con este script lo que hacemos es leer un archivo de un directorio privado, necesitamos
el mimetype y ruta donde se ubica el archivo
*/