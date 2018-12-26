<?php

namespace izv\controller;

use izv\model\Model;
use izv\tools\Session;

class MainController extends Controller {
    
    function main() {
        $this->checkIsLogged();
        $this->getModel()->set('twigFile', '_index.twig');
        $this->getModel()->set('user', $this->sesion->getLogin()->get());
    }
    
}
