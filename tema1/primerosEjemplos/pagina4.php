<?php

//PAra que se nos muestren los errores
error_reporting(E_ALL);
ini_set('display_error', 1);

if(!empty($_GET['esteesta'])){
    echo('este está');
}else{
    echo('este no está');
}

echo('<br>');

if(!empty($_GET['estenoesta'])){
    echo('estenoesta está');
}else{
    echo('estenoesta no está');
}