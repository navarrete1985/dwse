<?php

var_dump($_GET);//Forma de sacar por pantalla los valores que tiene un array
echo '<hr>';//Etiqueta para cambio de temática
//Función que saca por pantalla el contenido de un array de forma bonita (como si fuera un JSON)
echo '<pre>' . var_export($_GET, true) . '</pre>'; 
echo '<hr>';
// echo '<pre>' . var_export($_SERVER, true) . '</pre>';
echo '<pre>' . var_export($_SERVER['QUERY_STRING'], true) . '</pre>';

obtenerParametros();

echo '<hr>';

if (isset($_GET['fumador'])){
    echo 'Es fumador';
}else{
    echo 'No es fumador';
}

//En caso de que nuestro extra, en nuestro código html le declaremos el name como si fuese un array
//name="extra[]", podemos recorrer los campos marcados, esta es la forma de poder pasar en un formulario
//un conjunto de datos bajo el mismo name
if (isset($_GET['extra'])){
    $extra = $_GET['extra'];
    if (is_array('extra')){
        foreach($extra as $indice => $valor){
            echo 'El valor de extra en la posición ' . $indice . ' es de: ' . $valor;
            echo $valor;
        }
    }
}

// Función con la que obtenemos los diferentes checkbox marcados por el usuario sin que el input checkbox
//tenga name declarada como un array, por lo que para poder recoger los campos marcados tenemos que
//coger la query que se nos pasa, y una vez con ella, ver los valores con name extra que están seleccionados.
function obtenerParametros(){
    $url = $_SERVER['QUERY_STRING'];
    $partes = explode('&', $url);
    echo '---Obtención de parámetros sin tratar---<pre>' . var_export($partes, true) . '</pre>';
    $extras = array();
    foreach($partes as $value){
        if(strpos($value, 'extra') !== false){
            array_push($extras, explode('=', $value)[1]);
        }
    }
    echo '<hr>---Resultado de parámetros extra tratados---<pre>' . var_export($extras, true) . '</pre>';
}