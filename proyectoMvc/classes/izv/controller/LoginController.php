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
        header('Location: ' . App::BASE);
    }
    
    function dologin() {
        $this->checkIsLogued();
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
            header('Location: ' . App::BASE . 'login/main?op=signup&resultado=1&r2=' . $r2);
            exit();
        }else {
            header('Location: ' . App::BASE . 'login/register?op=signup&resultado=0');
        }
    }
    
    function checkIsLogued() {
        if ($this->sesion->isLogged()) {
            header('Location: ' . App::BASE . 'index/main');
            exit();
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
        header('Location: ' . App::BASE . 'login/main?op=activate&resultado=' . $result);
    }
}