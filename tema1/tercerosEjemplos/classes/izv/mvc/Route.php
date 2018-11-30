<?php

namespace izv\mvc;

class Route {
    
    private $modelo, $vista, $controlador;
    
    function __construct($modelo, $vista, $controlador) {
        $this->modelo = $modelo;
        $this->vista = $vista;
        $this->controlador = $controlador;
    }
    
    function getModel() {
        return $this->modelo;
    }
    
    function getView() {
        return $this->vista;
    }
    
    function getController() {
        return $this->controlador;
    }
    
}