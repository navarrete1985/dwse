<?php

class Reader{
    
    //Constructor privado para evitar las  instancias de esta clase
    private function __construct(){
        
    }
    
    static function count($method = null){
        if (strtolower($method) === null){
            $count = count($_GET) + count($_POST);
        }elseif (strtolower($method) === 'get'){
            $count = count($_GET);
        }else{
            $count = count($_POST);
        }
        return $count;
    }
    
    static function read($name){
        return (self::get($name) !== null) ? self::get($name) : self::post($name);
    }
    
    /*
    Si no me llega el parámetro con el nombre $name devuelve: null
    Si si me llega: el valor
    con self hacemos referencia a la clase, si utilizamos this hacemos referencia a la instancia
    */
    static function get($name){
        return self::_read($name, $_GET);
    }
    
    static function post($name){
        return self::_read($name, $_POST);
    }
    
    private static function _read($name, array $array){
        return (isset($array[$name])) ? $array[$name] : null;
    }
    
    /*
    Clase que demostramos los comparadores de igualdad
    */
    function a(){
        $a = 1;
        $b = '1';
        
        //Con esto comparamos en contenido sin ver el tipo de dato
        if ($a == $b){
            echo 'iguales';
        }
        
        //Con esto nos aseguramos de que la comparación tiene que ser del mismo tipo de dato.
        if ($a === $b){
            echo 'no iguales';
        }
    }
    
}