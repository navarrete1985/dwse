<?php

require 'classes/vendor/autoload.php';

require 'classes/Alumno.php';
require 'classes/Bootstrap.php';

$bootstrap = new Bootstrap();
$gestor = $bootstrap->getEntityManager();

/*$alumno = new Alumno();
$alumno->setNombre('Pepita');
$gestor->persist($alumno);

$alumno2 = new Alumno();
$alumno2->setNombre('Jaimite');
$gestor->persist($alumno2);

$gestor->flush();

echo '<br>el id del alumno insertado es: ' . $alumno->getId();
echo '<br>el id del alumno insertado es: ' . $alumno2->getId();

$alumno->setNombre('Pepita Flores');
$gestor->flush();*/

$alumno = $gestor->find('Alumno', 1);
$alumno->setObservaciones('mu güeno');
$alumno = $gestor->find('Alumno', 2);
$alumno->setObservaciones('mu güeno');
$gestor->flush();

$alumnos = $gestor->getRepository('Alumno')->findBy(array('observaciones' => 'mu güeno'));
foreach($alumnos as $alumno) {
    echo '<br>el id del alumno es: ' . $alumno->getId() . '; el nombre es: ' . $alumno->getNombre();
}

/*
echo 'el id del alumno es: ' . $alumno->getId() . '; el nombre es: ' . $alumno->getNombre();


echo '<br>el id del alumno es: ' . $alumno->getId() . '; el nombre es: ' . $alumno->getNombre();

*/