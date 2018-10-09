<?php

//array (forma de creación de array tradicional) --> Mejor esta por que siempre va a ser correcta, no dependemos de la versión de php
$array1 = array();

//Existe a partir de la versión 5.4 (Forma moderna de creación de array)
$array2 = [];
$array2[] = 1;
$array2[] = 2;

$array1[] = 'hola';
$array1[] = 1;
$array1[] = 1.2;
$array1[] = false;
$array1[6] = 'adios';
$array1[] = 2;
$array1[2] = 'otracosa';//Con esto sobreescribimos la posición 2 del array
$array1[] = $array2;
$array2[] = 3; //No añadimos al array2 que está en el array 1, puesto que lo que metemos en el array 1 es una copia de array2
//unset($array1[2]); //Borramos la posición 2 del array pero seguimos con la misma longitud
//unset($array1); //Borramos el array completo


echo '<pre>' . var_export($array1, true) . '</pre>';
echo '<pre>' . var_export($array2, true) . '</pre>';
$array1[8][] = 2; //Con esto ya si que añadimos un valor al array que está dentro de array1
echo '<pre>' . var_export($array1, true) . '</pre>';

$array1['hola'] = 1;//Cambiamos el valor de la posición hola del array y la convertimos a 1
echo '<pre>' . var_export($array1, true) . '</pre>';

$indices = array_keys($array1);//Nos devuelve un array con los índices de un array
echo '<pre>' . var_export($indices, true) . '</pre>';

$merge = array_merge($array1, $array2);
echo '<pre>' . var_export($merge, true) . '</pre>';

$arrayValues = array_values($array1);//Reordenamos el array a partir de la posición 0
echo '<pre>' . var_export($arrayValues, true) . '</pre>';

$cadena = 'Hola mundo! adlskja sakjdslk as';
$arrayCadena = explode(' ', $cadena);//Convertimos a partir del delimitador una cadena de caracteres en un array
echo '<pre>' . var_export($arrayCadena, true) . '</pre>';

$textoImplode = implode('#', $arrayCadena);
echo $textoImplode;

//Para ordenar un array hay muchas funciones, con sort() podemos ordenar 

//Declaración de un array literal
$arrayLiteral = array(
    'nombre' => 'Pepe López',
    'curso' => '2º DAW',
    'grupo' => 'A',
    'modulos' => array(
                    'dwes' => 'Desarrollo web entorno Servidor',
                    'dwec' => 'Desarrollo web enrtorno Cliente',
                    'etc' => 'Etcetera'
    ),
    'faltas' => array(
        '2018-02-02',
        '2019-21-12',
        '2019-41-12',
        '2019-41-12'
    )
);
//Sacamos el número de faltas que hay
echo 'El número de faltas es: ' . count($arrayLiteral['faltas']) . '<br>';
//Sacamos el día de la falta en la posición 1 del array
echo 'La fecha de la 2 falta es: ' . $arrayLiteral['faltas'][1] . '<br>';

//Sacamos el día de la falta en la posición 1 del array
echo 'La fecha de la última falta es: ' . $arrayLiteral['faltas'][count($arrayLiteral['faltas']) - 1] . '<br>';

//Obtenemos la información del servidor con $_SERVER (podemos obtener alguna información interesante)
echo '<pre>' . var_export($_SERVER, true) . '</pre>';

//La variable global $_REQUEST --> No se debe de utilizar, nos puede confundir a la hora de programar, no es recomendable su uso!!

//No se sabe para que se utiliza
echo '<pre>' . var_export($_ENV, true) . '</pre>';


//Las variables globales $_COOKIE, $_ENV, $_SESSION(Muy importante), S_FILES 
//Las Cookies no las solemos utulizar, en caso de usar google analytics es google quién nos mete las cookies
 