<?php

// include('./classes/Multiupload2');
echo '<pre>' . var_export($_FILES, true) . '</pre>';

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

/*$archivo = new Multiupload2('archivos0');
$r = $archivo->upload();
echo '<pre>' . var_export($r->getError(), true) . '</pre>'; 
echo '<pre>' . var_export($r, true) . '</pre>';*/