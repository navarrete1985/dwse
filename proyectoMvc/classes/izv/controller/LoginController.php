<?php

namespace izv\controller;

use izv\model\Model;
use izv\tools\Session;
use izv\tools\Reader;
use izv\app\App;

class LoginController extends Controller {
    
    function main() {
        $this->getModel()->set('twigFile', '_login.twig');
    }
    
    function register() {
        $this->getModel()->set('twigFile', '_register.twig');
    }
    
    function dologin() {
        $correo = Reader::read('correo');
        $clave = Reader::read('clave');
        $user = $this->getModel()->login($correo, $clave);
        if (!isset($correo) || !isset($clave)) {
            header('Location: ' . App::BASE . 'login/main?op=logout&result=1');
        }else if ($user) {
            $this->sesion->login($user);
            header('Location: ' . App::BASE . 'index/main?op=login&result=1');
            exit();
        }else {
            header('Location: ' . App::BASE . 'login/main?op=login&result=0');
        }
        $this->sesion->logout();
    }
    
}