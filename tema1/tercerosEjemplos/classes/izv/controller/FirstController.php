<?php

namespace izv\controller;

use izv\app\App;
use izv\model\Model;
use izv\tools\Session;

class FirstController extends Controller {

    function __construct(Model $model) {
        parent::__construct($model);
        $this->getModel()->set('titulo', 'First Controller');
        $this->getModel()->set('twigFile', '_base.html');
    }
    
    function main() {
        $this->getModel()->set('titulo', 'MAIN First Controller');
    }
    
    function segundaaccion() {
        $this->getModel()->set('titulo', 'Segunda Acción');
        $this->getModel()->set('twigFile', '_second.html');
    }
}