<?php

require 'classes/vendor/autoload.php';

require 'classes/Alumno.php';
require 'classes/Bootstrap.php';

$bootstrap = new Bootstrap();
$gestor = $bootstrap->getEntityManager(); //Objeto gestor de la base de datos

//Creamos un objeto de alumno 
// $alumno = new Alumno();
// $alumno->setNombre('Pepita');

// // Guardamos en nuestra base de datos Para evitar errores o por lo menos capturarlos utilizaríamos try/catch
// $gestor->persist($alumno);
// $gestor->flush();    

// echo 'El id del alumno insertado es --> ' . $alumno->getId();

// $alumno2 = new Alumno();
// $alumno2->setNombre('Pepita Flores');
// $gestor->persist($alumno2);

// $gestor->flush();

//Recogemos el alumno cuya clave principal es 1
// $alumno = $gestor->find('Alumno', 1);
// echo 'El id del alumno es --> ' . $alumno->getId() . '; el nombre es --> ' . $alumno->getNombre();

// //Recogemos el alumno por determinada condición
// $alumno = $gestor->getRepository('Alumno')->findOneBy(array('nombre' => 'pepita'));
// echo '<br>el id del alumno es: ' . $alumno->getId() . '; el nombre es: ' . $alumno->getNombre();

$alumno = $gestor->find('Alumno', 2);
$alumno->setAbservaciones('mu güeno');
$alumno = $gestor->find('Alumno', 3);
$alumno->setAbservaciones('mu güeno');
$gestor->flush();

$alumnos = $gestor->getRepository('Alumno')->findBy(array('abservaciones' => 'mu güeno'));
foreach($alumnos as $alumno) {
    echo '<br>el id del alumno es: ' . $alumno->getId() . '; el nombre es: ' . $alumno->getNombre();
}
