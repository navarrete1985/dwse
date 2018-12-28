<?php

namespace izv\controller;

use izv\app\App;
use izv\model\Model;
use izv\tools\Session;
use izv\tools\Reader;
use izv\tools\Alert;

abstract class Controller {

    protected $model;
    protected $sesion;
    
    abstract function main();

    function __construct(Model $model) {
        $this->model = $model;
        $this->sesion = new Session(App::SESSION_NAME);
        $this->getModel()->set('urlbase', App::BASE);
    }
    
    function getModel() {
        return $this->model;
    }
    
    function getSesion() {
        return $this->sesion;
    }
    
    function checkIsLogged() {
        if (!$this->sesion->isLogged() || $this->sesion->getLogin()->getActivo() === 0) {
            $this->sesion->logout();
            header('Location:' . App::BASE . 'login');
            exit();
        }
    }
    
    function getAlerts($usuario = null) {
        $op = Reader::read('op');
        $resultado = Reader::read('resultado');
        $alert = Alert::getAlert($op, $resultado);
        if ($usuario !== null && $op === 'login') {
            $alert['text'] .= '<strong> ' . $usuario . '<strong>';
        }
        if ($op !== null && $resultado !== null) {
            $this->getModel()->set('alert', $alert);   
        }
    }
    
    protected function __isAdmin() {
        return $this->sesion->getLogin()->getAdministrador() == 1;
    }
}