<?php

namespace izv\controller;

use izv\model\Model;
use izv\tools\Session;
use izv\tools\Util;

class MainController extends Controller {
    
    function main() {
        $this->checkIsLogged();
        $user = $this->sesion->getLogin()->get();
        $this->getModel()->set('twigFile', '_index.twig');
        $this->getModel()->set('user', $user);
        $this->getModel()->set('users', $this->getModel()->getAllUsers());
        $this->getAlerts($user['nombre']);
    }
    
    function createUser() {
        
    }
    
    function doedit() {
        
    }
    
    function dodelete() {
        
    }
    
    function edit() {
        
    }
    
}
