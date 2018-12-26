<?php

namespace izv\controller;

use izv\app\App;
use izv\model\Model;
use izv\tools\Session;

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
}