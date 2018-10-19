<?php

class Producto {
    
    use Comun; /*Con esto tenemos implementados los métodos del trait común*/
    
    private $id, 
            $nombre, 
            $precio, 
            $observaciones;
    
    
    function __construct($id = null, $nombre = null, $precio = null, $observaciones = null ){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->observaciones = $observaciones;
    }
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }
    
    
}