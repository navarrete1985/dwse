<?php

require 'classes/Comun.php'; //El trait tiene que ser el primer required...porque existen dependencias en Alumno y Punto de este trait
require 'classes/Alumno.php';
require 'classes/Punto.php';


$p = new Punto(1, 4);
$p->instrospeccion();
$a = new Alumno('1321354A', 'Luis Ignacio', 'Peña Navarrete', 754154153, '01-08-1985', 625668260, 'M');
$a->instrospeccion();

exit;//Para no seguir con lo de abajo

$alumno = new Alumno('12345678H', 'Juanito');
$alumno2 = new Alumno('11223344Z', 'María', 'López');
$alumno->setNombre('Pepe');

echo $alumno . '<br>';
echo $alumno . '<br>';
echo $alumno . '<br>';

$p = new Punto();
$p->setX(1);
$p->setX(2);
$p->setX(2)->setY(2); //Al devolver $this en el setter, podemos seguir trabajando con él en la misma linea de código.

$miclase = 'Punto';
$p = new $miclase();

$mimetodo = 'getX';
$p->$mimetodo();

if (class_exists($miclase)){
    $p = new $miclase();
}

//Si existe mimetodo en la clase p, lo ejecutamos
if (method_exists($p, $mimetodo)){
    echo $p->$mimetodo();
}

//Si existe mimetodo en la clase miclase, lo ejecutamos
if (method_exists($miclase, $mimetodo)){
    echo $p->$mimetodo();
}