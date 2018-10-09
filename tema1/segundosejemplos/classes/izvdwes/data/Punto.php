<?php

namespace izvdwes\data;

class Punto{
    
    //Usamos los métodos que tiene el trait común
    use Comun;
    private $x, $y;
    
    function __construct($x = 0, $y = 0) {
        $this->x = $x;
        $this->y = $y;
    }
    function __toString() {
        return 'El punto está en la posición (' . $this->x . ', ' . $this->y . ')';
    }
    public function getX() {
        return $this->x;
    }
    
    // function instrospeccion(){
    //     //Con esto recogemos los nombres de los atributos de la instancia
    //     foreach($this as $atributo => $valor){
    //         echo $atributo . ': ' . $valor . '<br>';
    //     }
    // }
    
    public function setX($x) {
        $this->x = $x;
        return $this;
    }
    public function getY() {
        return $this->y;
    }
    public function setY($y) {
        $this->y = $y;
        return $this;
    }
    
}