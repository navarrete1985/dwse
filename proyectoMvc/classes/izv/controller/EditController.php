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
        $this->getModel()->set('twigFile', '_edit.twig');
        $this->getModel()->set('accion', 'Edición de Usuario');
        $this->getModel()->set('user', $this->sesion->getLogin()->get());    
        $this->__isAdmin() ? $this->getModel()->set('admin', true) : null;
        if ($this->__isAdmin() && Reader::read('id') != null) {
            $user = $this->getModel()->getUser(Reader::read('id'));
            $user === null ? sendRedirect('edit/main') : $this->getModel()->set('edituser', $user->get());
        } else if (!$this->__isAdmin() && Reader::read('id') != null) {
            $this->sendRedirect('index/main');
        } else {
            $this->getModel()->set('edituser', $this->sesion->getLogin()->get());    
        }
    }
    
    function createuser() {
        $this->__hasPermission();
        $this->getModel()->set('twigFile', '_edit.twig');
        $this->getModel()->set('accion', 'Usuario Nuevo');
        $this->getModel()->set('route', 'edit/doinsert');
        $this->getModel()->set('user', $this->sesion->getLogin()->get());
        $this->getModel()->set('new', true);
        $this->getAlerts();
    }
    
    function doinsert() {
        $this->__hasPermission();
        $user = Reader::readObject('izv\data\Usuario');
        if (strlen(trim($user->getNombre())) === 0 || strlen(trim($user->getAlias())) === 0) {
            $this->sendRedirect('edit/createuser?op=createuser&resultado=0');
        }
        $user->setClave(Util::encriptar($user->getClave()));
        $user->setActivo($user->getActivo() === 'on' ? 1 : 0);
        $user->setAdministrador($user->getAdministrador() === 'on' ? 1 : 0);
        $result = $this->getModel()->createuser($user);
        if ($result > 0) {
            $user->setId($result);
            Mail::sendActivation($user);
        }
        
        $this->sendRedirect('index/main?op=createuser&resultado=' . ($result > 0 ? '1' : '0'));
    }
    
    function doedit() {
        $this->checkIsLogged();
        $user = Reader::readObject('izv\data\Usuario');
        if ($user !== null) {
            if (!$this->__isAdmin() && $user->getId() != $this->sesion->getLogin()->getId()) {
                $this->sendRedirect('index/main');
            }
            $oldState = $this->getModel()->getUser($user->getId());
            if ($this->__isAdmin()) {
                $user->setActivo($user->getActivo() === 'on' ? 1 : 0);
                $user->setAdministrador($user->getAdministrador() === 'on' ? 1 : 0);
            } else {
                $this->__checkLeave($oldState);
                $user->setActivo($oldState->getActivo());
                $user->setAdministrador($oldState->getAdministrador());
            }
            if ($oldState->getCorreo() !== $user->getCorreo()) {
                Mail::sendActivation($user);
                $user->setActivo(0);
            }
            $user->setClave($user->getClave() == null || $user->getClave() == '' ? $oldState->getClave() : Util::encriptar($user->getClave()));
            $result = $this->getModel()->updateUser($user);
            $this->sesion->getLogin()->getId() === $user->getId() ? $this->sesion->login($user) : null;
            $this->sendRedirect('index/main?op=edit&resultado=' . $result);
        }else {
            $this->sendRedirect();
        }
    }
    
    private function __hasPermission() {
        $this->checkIsLogged();
        if (!$this->__isAdmin()) {
            $this->sendRedirect();
        }
        $this->getModel()->set('admin', true);
    }
    
    private function __checkLeave($user) {
        if (Reader::read('baja') === 'on' || Reader::read('bajatmp') === 'on') {
            if (Reader::read('baja') === 'on') {
                $this->getModel()->deleteUser($user->getId());
            } else if (Reader::read('bajatmp') === 'on') {
                $user->setActivo(0);
                $this->getModel()->updateUser($user);
            }
            $this->sesion->logout();
            $this->sendRedirect('login/main?op=baja&resultado=1');
        }
    }   
}
