<?php

namespace izv\controller;

use izv\app\App;
use izv\data\Usuario;
use izv\model\Model;
use izv\tools\Reader;
use izv\tools\Session;
use izv\tools\Util;

class UserController extends Controller {

    function __construct(Model $model) {
        parent::__construct($model);
        //...
    }
    
    function dologin() {
       $r = $this->getModel()->login($usuario);
        if($r !== false) {
            $this->getModel()->set('user', $r->get());
            $this->getSession()->login($r);
            $r = 1;
        } else {
            $r = 0;
        }
        $this->getModel()->set('login', $r);
    }

    function doregister() {
        //1º control de sesión
        if($this->getSesion()->isLogged()) {
            //5º producir resultado -> redirección
            header('Location: ' . App::BASE . 'index?op=register&r=session');
            exit();
        }

        //2º lectura de datos
        $usuario = Reader::readObject('izv\data\Usuario');
        $clave2 = Reader::read('clave2');
        
        //3º validación de datos
        if($usuario->getClave() !== $clave2 ||
            mb_strlen($usuario->getClave()) < 4) {
            //5º producir resultado -> redirección
            header('Location: ' . App::BASE . 'index?op=register&r=password');
            exit();
        }
        if (!filter_var($usuario->getCorreo(), FILTER_VALIDATE_EMAIL)) {
            //5º producir resultado -> redirección
            header('Location: ' . App::BASE . 'index?op=register&r=email');
            exit();
        }

        //4º usar el modelo
        $usuario->setClave(Util::encriptar($usuario->getClave()));
        $r = $this->getModel()->register($usuario);

        //5º producir resultado -> redirección
        header('Location: ' . App::BASE . 'index?op=register&r=' . $r);
        exit();
    }

    function login() {
        //1º control de sesión, si está logueado no se muestra el login
        //if(!$this->getSession()->isLogged()) {
            //2º lectura de datos    -> no hay
            //3º validación de datos -> no hay
            //4º usar el modelo    -> no hace falta
            //5º producir resultado
            $this->getModel()->set('twigFile', '_login.html');
        //}
    }

    function main() {
        //1º control de sesión
        if($this->getSesion()->isLogged()) {
            //5º producir resultado
            $this->getModel()->set('twigFile', '_mainlogged.html');
            $this->getModel()->set('user', $this->getSesion()->getLogin()->getCorreo());
        } else {
            //5º producir resultado
            $this->getModel()->set('twigFile', '_main.html');
        }
        //}
    }

    function otra() {
        $this->getModel()->set('twigFile', '_otra.html');
    }

    function register() {
        //1º control de sesión, si está logueado no se muestra el registro
        //if(!$this->getSession()->isLogged()) {
            //5º producir resultado
            $this->getModel()->set('twigFile', '_register.html');
        //}
    }
    
    function dologout() {
        $this->getSesion()->logout();
        header('Location: ' . App::BASE . 'index' );
        exit();
    }
}