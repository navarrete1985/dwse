<?php

namespace izv\controller;

use izv\model\Model;
use izv\tools\Session;
use izv\tools\Util;
use izv\tools\Reader;
use izv\app\App;
use izv\tools\Mail;

class EditController extends Controller {
    
    function main() {
        $this->checkIsLogged();
        $this->sendRedirect('index/main');
    }
    
    function createlink() {
        $this->checkIsLogged();
        $this->getModel()->set('twigFile', '_edit.twig');
        $this->getModel()->set('accion', 'Crear Link Nuevo');
        $this->getModel()->set('user', $this->sesion->getLogin()->get());
        $this->getModel()->set('new', true);
        $this->getModel()->set('categories', $this->getModel()->getCategories($this->getSesion()->getLogin()->getId()));
        $this->getAlerts();
    }
    
}
