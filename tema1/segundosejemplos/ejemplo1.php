<?php

/*
Para poder usar los espacios de nombres, tenemos que usar el use para cargar las dependencias
*/

require ('classes/autoload.php');
//Necesitamos usar el espacio de nombres para poder crear una clase sin tener que definir el espacio de nombres al crear la instancia
use izvdwes\data\Producto; 
use izvdwes\data\Alumno;
use izvdwes\tools\Tools;

// $producto = new izvdwes\data\Producto();
$producto2 = new Producto();
// echo '<pre>' . var_export($producto, true) . '</pre>';
echo '<pre>' . var_export($producto2, true) . '</pre>';

$alumno = new Alumno();

// echo '<pre>' . var_export($alumno, true) . '</pre>';
Tools::print($alumno);


/*
Ejercicio:
array (
    'López Pérez', 
    '12345678H',
    '2001-12-22',
    'Maria',
    1,
    'f',
    '676112233'
)
*/

$array = array (
    '','',
    'López Pérez', 
    '12345678H',
    '2001-12-22',
    'Maria',
    1,
    'f',
    '676112233',
    '',''
);

Tools::print($array);

$alumno2 = new Alumno();
$alumno2->fetch($array, 2);
Tools::print($alumno2);
echo $alumno2->json();
