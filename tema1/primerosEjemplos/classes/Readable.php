<?php
/*
interface:
    contrato --> Todas las clases que implementen una interfaz tienen que definir los métodos de la interfaz
    
*/

/**
 * Interfaz Readable
 * 
 * @version 1.01
 * @author nacho
 * @license enlace a la licencia
 * @copyright 
 * Interfaz para la transformación de objetos en arrays y viceversa
*/
interface Readable {
    /**
     * Obtiene el array asociativo que es 'copia de un objeto'
     * @access public 
     * @return Devuelve un array asociativo cuyos índices soon los atributos y los valores son los valores de los atributos
     */ 
    function readableGet();
    
    /**
     * Reconstruye un objeto a partir de un array asociativo
     * @access public 
     * @param array $array Array asociativo que contiene la 'estructura' del objeto
     * @return Devuelve la instancia del objeto reconstruido.
     */ 
    function readableSet(array $array);
    
}