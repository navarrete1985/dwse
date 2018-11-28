<?php

namespace izv\tools;

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
    
    static function readObject($class, $methodGet = 'get', $methodSet = 'set'){
        $object = null;
        //Si la clase existe
        if (class_exists($class)){
            //Creamos una instancia de la clase que se nos pasa
            $object = new $class();
            //Comprobamos que la clase del objeto tiene un método para darnos los valores de los atributos
            if (method_exists($object, $methodGet)){
                //Creamos un array con los nombres de los atributos, que lo tendrá la clase
                $array = $object->$methodGet();
                //Recorremos el array con los atributos para darle valor
                if (is_array($array)){
                    foreach($array as $atributo => $valor){
                        $array[$atributo] = self::read($atributo);
                    }
                    if(method_exists($object, $methodSet)){
                        $object->$methodSet($array);
                    }
                }
            }
        }
        return $object;
    }
    
    static function readReadableObject(Readable $object){
        $array = $object->readableGet();
        if (is_array($array)){
            foreach($array as $atributo => $valor) {
                $array[$atributo] = self::read($atributo);
            }
            $object->readableSet($array);
        }
        return $object;
    }
    
    private static function _read($name, array $array){
        return (isset($array[$name])) ? $array[$name] : null;
    }
    
    static function readArray($nombre) {
        $result = array();
        if (isset($_GET[$nombre]) && is_array($_GET[$nombre])){
            $result = $_GET[$nombre];
        }else if (isset($_POST[$nombre]) && is_array($_POST[$nombre])){
            $result = $_POST[$nombre];
        }
        return $result;
    }
    
}