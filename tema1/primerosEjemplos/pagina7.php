<?php

//izdamdaw/curso1819
// require 'classes/Readable';
// require 'classes/AlumnoReadable';
// require 'classes/Comun.php';
// require 'classes/Alumno.php';
// require 'classes/Reader.php';
// require 'classes/Punto.php';

require 'classes/Autoload.php';

$alumno = Reader::readObject('Alumno');
$punto = Reader::readObject('Punto');

echo '<pre>' . var_export($alumno, true) . '</pre>';
echo '<pre>' . var_export($punto, true) . '</pre>';

$alumnoReadable = new AlumnoReadable();
$alumnoReadable = Reader::readReadableObject($alumnoReadable);

echo '<pre>' . var_export($alumnoReadable, true) . '</pre>';

echo $alumno;