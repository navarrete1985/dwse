<?php

namespace izv\controller;

use izv\model\Model;
use izv\tools\Session;
use izv\tools\Util;
use izv\tools\Reader;

class MainController extends Controller {
    
    function main() {
        $this->checkIsLogged();
        $user = $this->sesion->getLogin()->get();
        $this->getModel()->set('twigFile', '_index.twig');
        $this->getModel()->set('user', $user);
        $this->getModel()->set('users', $this->getModel()->getAllUsers());
        $this->getAlerts($user['nombre']);
    }
    
    function createuser() {
        $this->checkIsLogged();
        $this->getModel()->set('twigFile', '_edit.twig');
        $this->getModel()->set('accion', 'Usuario Nuevo');
    }
    
    function doedit() {
        $this->checkIsLogged();
    }
    
    function dodelete() {
        $this->checkIsLogged();
        if ($this->__isAdmin()) {
            $result = $this->getModel()->deleteUser(Reader::read('id'));
            header('Location: index/main?op=delete&resultado=' . $result);
        }else {
            header('Location: index/main');
        }
    }
    
    function edit() {
        $this->checkIsLogged();
        $this->getModel()->set('twigFile', '_edit.twig');
        $this->getModel()->set('accion', 'Edición de Usuario');
        if ($this->__isAdmin() && Reader::read('id') != null) {
            $user = $this->getModel()->getUser(Reader::read('id'));
            if ($user !== null) {
                $this->getModel()->set('user', $user->get());
            }else {
                header('Location: index/main?op=read&resultado=0');
            }
        } else if (!$this->__isAdmin() && Reader::read('id') != null) {
            header('Location: index/main');
        } else {
            $this->getModel()->set('user', $this->sesion->getLogin()->get());    
        }
    }
    
    private function __isAdmin() {
        return $this->sesion->getLogin()->get()['administrador'] == 1;
    }
    
}
