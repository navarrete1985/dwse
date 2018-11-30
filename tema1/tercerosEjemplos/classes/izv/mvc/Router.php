<?php

namespace izv\mvc;

class Router {
    
    private $rutas = array(
            'index' => new Route('', '', ''),
            'ruta' => new Route('', '', ''),
            'otra' => new Route('', '', '')
    ),
    $ruta;
    
    function __contruct($ruta) {
        $this->ruta = $ruta;
    }
        
    function getRoute() {
        $ruta = $this->rutas['index'];
        if (isset($this->rutas[$this->ruta])) {
            $ruta = $this->rutas[$this->ruta];
        }
        return $ruta;
    }
    
}