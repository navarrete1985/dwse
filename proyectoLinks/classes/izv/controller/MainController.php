<?php

namespace izv\controller;

use izv\model\Model;
use izv\tools\Session;
use izv\tools\Util;
use izv\tools\Reader;
use izv\app\App;
use izv\tools\Mail;

class MainController extends Controller {
    
    function main() {
        $this->checkIsLogged();
        $user = $this->sesion->getLogin()->get();
        $this->getModel()->set('twigFile', '_index.twig');
        $this->getModel()->set('user', $user);
        $pagina = Reader::read('page');
        $orden = Reader::read('order');
        $filtro = Reader::read('search');
        $this->getModel()->set('data', $this->getModel()->getAll('Link'));
        $this->getAlerts($user['nombre']);
    }
    
    
}
