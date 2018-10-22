<?php

require('./classes/MultiUploadC.php');
// echo '<pre>' . var_export($_FILES, true) . '</pre>';

/*
Realizar la clase upload múltiple
Entregar El jueves próximo
Que sea llamada sólamente con el nombre del campo de entrada input type"" name='esteNombre'
deberá tener al menos
1 - Cuantos archivos vienen
2 - Cuantos se ha podido subir
3 - Get name -> arra()nombres de los archivos
4 - Con 1 solo target
5 - Set name...se le llama al archivo lo mismo a todos
5 - En tamaño comparamos cada uno de los archivos con el maxSize
*/

$archivo = new MultiUploadC('archivos0');
// $archivo = new MultiUploadC('archivos1');
$archivo->setTarget('./upload/');
// $archivo->setPolicy(MultiUploadC::POLICITY_RENAME);
// $archivo->setSavedName('unNombre');
// $archivo->setMaxSize(10);
// $archivo->setType('png');
$r = $archivo->upload();

// echo '<pre>' . var_export($archivo->getError(), true) . '</pre>'; 
echo '<pre>' . var_export($r, true) . '</pre>';
echo '<pre>' . var_export($archivo->getNames(), true) . '</pre>';
echo '<pre>' . var_export($archivo->getError(), true) . '</pre>';