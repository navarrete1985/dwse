<?php

namespace izv\tools;

class Alert {
    
    private $operacion, $resultado;
    
    static private $mensajes = array(
        'delete' => array(
            'No se ha podido borrar.',
            'Se ha borrado correctamente.'
        ),
        'deleteproducto' => array(
            'No se ha podido borrar el producto.',
            'El producto se ha borrado correctamente.'
        ),
        'edit'   => array(
            'No se ha podido modificar.',
            'Se ha modificado correctamente.'
        ),
        'editproducto'   => array(
            'No se ha podido modificar el producto.',
            'El producto se ha modificado correctamente.'
        ),
        'insert' => array(
            'No se ha podido crear el usuario.',
            'Usuario creado satisfactoriamente'
        ),
        'insertproducto' => array(
            'No se ha podido insertar el producto.',
            'El producto se ha insertado correctamente.'
        ),
        'login' => array(
            'No se ha autentificado correctamente.',
            'Logueado correctamente.'
        ),
        'logout' => array(
            '',
            'Sessión finalizada.'
        ),
        'activate' => array(
            'Su cuenta está ya activada o hemos encontrado un error en la activación. Por favor, intente hacer loguearse o en su defecto cree una nueva cuenta.',
            'Cuenta activada satisfactoriamente.'
        ),
        'baja' => array(
            'Ha habido un error al dar de baja al usuario, por favor, inténtelo más tarde.',
            'La cuenta de usuario se ha dado de baja satisfactoriamente'
        )
    );
    
    static private $clases = array('alert-danger', 'alert-success');
    
    function __construct($operacion, $resultado) {
        $this->operacion = $operacion;
        $this->resultado = $resultado;
    }
    
    function _getAlert() {
        $string = '';
        if(isset(self::$mensajes[$this->operacion])) {
            $pos = 1;
            if($this->resultado <= 0) {
                $pos = 0;
            }
            $clase = self::$clases[$pos];
            $mensaje = self::$mensajes[$this->operacion][$pos];
            $string = '<div class="alert ' . $clase . '" role="alert">' . $mensaje . '</div>';
        }
        return $string;
    }
    
    static function getMessage($operacion, $resultado) {
        $alert = new Alert($operacion, $resultado);
        return $alert->_getAlert();
    }
    
    static function getAlert($op, $result) {
        if (!isset($op) || !isset($result)) {
            return null;
        }
        $pos = ($result <= 0 ) ? 0 : 1;
        return ['type' => self::$clases[$pos],
                'text' => self::$mensajes[$op][$pos]];
    }
}