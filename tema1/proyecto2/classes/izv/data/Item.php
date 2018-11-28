<?php

namespace izv\data;

class Item {

    use \izv\common\Common;
    
    private $id, $nombre, $descripcion, $cantidad, $precio;
    
    function __construct($id, $nombre, $descripcion, $precio, $cantidad = 1) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
    }
    
    function getId() {
        return $this->id;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getPrecio() {
        return $this->precio;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
        return $this;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
        return $this;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
        return $this;
    }
}