<?php
//Traits/rasgos
//Para compartir rasgos de una clase en otras, en este caso la vamos a 
//implementar en la clase alumno y punto
trait Comun {
    
    function fetch(array $array, $initial = 0){
        $count = $initial;
        foreach($this as $atributo => $valor){
            //Con isset vemos si la posición correspondiente existe en el array
            if (isset($array[$count])){
                $this->$atributo = $array[$count];
            }
            $count++;
        }
        return $this;
    }
    
    //metodo get -> array asociativo cuyos indices son los atributos del objeto -> get
    function get(){
        $array = array();
        foreach($this as $atributo => $valor){
            $array[$atributo] = $valor;
        }
        return $array;
    }
    
    function instrospeccion(){
        //Con esto recogemos los nombres de los atributos de la instancia
        foreach($this as $atributo => $valor){
            echo $atributo . ': ' . $valor . '<br>';
        }
    }
    
    //metodo post -> asignar los valores del array asociativo al objeto -> set 
    function set(array $array){
        foreach($this as $atributo => $valor){
            if(isset($array[$atributo])){
                $this->$atributo = $array[$atributo];
            }
        }
    }
    
    
    //metodo post -> asignar los valores del array asociativo al objeto -> merge 
    //A partir de php7 puedo obligar a insertar un string como parámetro.
    function merge(array $array){
        $array = array();
        foreach($this as $atributo => $valor){
            if(property_exists($this, $atributo)){
                $this->$atributo = $valor;
            }
        }
    }
    
    function __toString(){
        $string = get_class() . ':<br>';
        foreach($this as $atributo => $valor){
            $string .= $atributo . ' = ' . $valor . '<br>';
        }
        return $string;
    }
    
}
/*
Pojos características:
1. Simple
2. No heredan
3. Contructor vacío
4. Tiene los métodos getter/setter
*/