<?php

namespace izv\tools;

class Reader{
    
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
    
    static function get($name){
        return self::_read($name, $_GET);
    }
    
    static function post($name){
        return self::_read($name, $_POST);
    }
    
    static function readObject($class, $methodGet = 'get', $methodSet = 'set'){
        $object = null;
        if (class_exists($class)){
            $object = new $class();
            if (method_exists($object, $methodGet)){
                $array = $object->$methodGet();
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