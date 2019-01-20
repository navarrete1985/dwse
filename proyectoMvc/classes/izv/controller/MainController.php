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
        $this->getModel()->set('users', $this->getModel()->getAllUsers());
        $this->getAlerts($user['nombre']);
    }
    
    function dodelete() {
        $this->checkIsLogged();
        if ($this->__isAdmin()) {
            $result = $this->getModel()->deleteUser(Reader::read('id'));
            $this->sendRedirect('Location: index/main?op=delete&resultado=' . $result);
        }else {
            $this->sendRedirect();
        }
    }
}
