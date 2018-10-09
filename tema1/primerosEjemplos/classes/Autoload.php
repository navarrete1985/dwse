<?php

class Autoload {
    static function load($clase) {
        $ruta = dirname(__FILE__) . '/' . $clase . '.php';
        if ( file_exists($ruta)){
            require($ruta);
        }
    }
}

//Es una forma de evitar que hagamos required, cuando no encontremos una clase utiliza este método
//para encontrar la clase en caso de que la necesitemos.
spl_autoload_register('Autoload::load');