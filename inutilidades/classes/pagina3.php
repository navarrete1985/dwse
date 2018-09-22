<?php

echo 'Aquí has llegado';

//vamos a leer los parámetros

//problema: GET y POST se leen de forma diferente

//problema 2: no siempre llegan parámetros

$nombre = '';

//Si llega parámetro nombre del parámetro leelo
if (isset($_GET['nombre'])){
    $nombre = $_GET['nombre'];
}


//Si llega parámetro post nombre del parámetro leelo
if (isset($_POST['nombre'])){
    $nombre = $_POST['nombre'];
}

echo 'El nombre es: ' . $nombre;