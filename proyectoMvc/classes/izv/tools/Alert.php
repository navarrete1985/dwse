<?php

namespace izv\tools;

class Alert {
    
    private $operacion, $resultado;
    
    static private $mensajes = array(
        'signup' => array(
            'No hemos podido crear su cuenta, verifique si el email introducido no está ya registrado, o pruebe a cambiar de alias',
            'El registro se ha realizado con éxito, le hemos enviado un email a su correo para que active su cuenta.'
        ),
        'activate' => array(
            'Su cuenta está ya activada o hemos encontrado un error en la activación. Por favor, intente hacer loguearse o en su defecto cree una nueva cuenta.',
            'La cuenta ha sido activada satisfactoriamente.'
        ),
        'edit'   => array(
            'No se ha podido modificar al usuario',
            'Los datos se han modificado satisfactoriamente.'
        ),
        'read'   => array(
            'No se ha encontrado el usuario para modificar.',
            ''
        ),
        'insert' => array(
            'No se ha podido crear el usuario.',
            'Usuario creado satisfactoriamente'
        ),
        'delete' => array(
            'No se ha podido eliminar al usuario.',
            'El usuario se ha eliminado satisfactoriamente.'
        ),
        'login' => array(
            'No se ha autentificado correctamente.',
            'Bienvenido de nuevo '
        ),
        'logout' => array(
            '',
            'Sessión finalizada.'
        ),
        'baja' => array(
            'Ha habido un error al dar de baja al usuario, por favor, inténtelo más tarde.',
            'La cuenta de usuario se ha dado de baja satisfactoriamente.'
        ),
        'createuser' => array(
            'No hemos podido crear al usuario, pruebe con un email no usado o un alias disponible.',
            'El usuario se ha creado satisfactoriamente.'
        )
    );
    
    static private $clases = array('danger', 'success');
    
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