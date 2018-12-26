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
        if (!$this->sesion->isLogged()) {
            header('Location:' . App::BASE . 'login');
            exit();
        }
    }
    
    function getAlerts() {
        $op = Reader::read('op');
        $resultado = Reader::read('resultado');
        if ($op !== null && $resultado !== null) {
            $this->getModel()->set('alert', Alert::getAlert($op, $resultado));   
        }
    }
}