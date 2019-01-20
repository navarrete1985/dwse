<?php

namespace izv\controller;

use izv\model\Model;
use izv\tools\Session;
use izv\tools\Reader;
use izv\app\App;
use izv\tools\Mail;
use izv\tools\Util;

class LoginController extends Controller {
    
    function main() {
        $this->checkIsLogued();
        $model = $this->getModel();
        $model->set('twigFile', '_login.twig');
        $this->getAlerts();
    }
    
    function register() {
        $this->checkIsLogued();
        $this->getModel()->set('twigFile', '_register.twig');
    }
    
    function logout() {
        $this->sesion->logout();
        $this->sendRedirect('login/main?op=logout&resultado=1');
    }
    
    function dologin() {
        $this->checkIsLogued();
        $correo = Reader::read('correo');
        $clave = Reader::read('clave');
        $user = $this->getModel()->login($correo, $clave);
        if ($user && $user->getActivo() == 1) {
            $this->sesion->login($user);
            $this->sendRedirect('index/main?op=login&resultado=1');
        }
        $this->sesion->logout();
        $this->sendRedirect('login/main?op=login&resultado=0');
    }
    
    function doregister() {
        $this->checkIsLogued();
        $usuario = Reader::readObject('izv\data\Usuario');
        $usuario->setActivo(0);
        $usuario->setAdministrador(0);
        $usuario->setClave(Util::encriptar($usuario->getClave()));
        $id = $this->getModel()->createUser($usuario);
        if ($id > 0) {
            $usuario->setId($id);
            $r2 = Mail::sendActivation($usuario);
            $this->sendRedirect('login/main?op=signup&resultado=1&r2=' . $r2);
        }else {
            $this->sendRedirect('login/register?op=signup&resultado=0');
        }
    }
    
    function checkIsLogued() {
        if ($this->sesion->isLogged()) {
            $this->sendRedirect();
        }
    }
    
    function activate() {
        $id = Reader::read('id');
        $mailEncode = Reader::read('code');
        
        $mailDecode = \Firebase\JWT\JWT::decode($mailEncode, App::JWT_KEY, array('HS256'));
        $user = $this->getModel()->getUser($id);
        if ($user !== null && $user->getCorreo() === $mailDecode) {
            $user->setActivo(1);
            $result = $this->getModel()->updateUser($user);
        }
        $this->sendRedirect('login/main?op=activate&resultado=' . $result);
    }
}