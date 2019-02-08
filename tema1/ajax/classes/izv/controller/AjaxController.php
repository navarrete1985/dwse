<?php

namespace izv\controller;

use izv\app\App;
use izv\data\Usuario;
use izv\model\Model;
use izv\tools\Reader;
use izv\tools\Session;
use izv\tools\Util;
use izv\tools\Upload;

class AjaxController extends Controller {

    function __construct(Model $model) {
        parent::__construct($model);
        //...
    }
    
    function comprobaralias() {
        $alias = Reader::read('alias');
        $available = 0;
        if($alias !== null && $alias !== '') {
            $available = $this->getModel()->aliasAvailable($alias);
        }
        $this->getModel()->set('aliasdisponible', $available);
    }
    
    function comprobarcorreo() {
        $correo = Reader::read('correo');
        $available = 0;
        if(filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $available = $this->getModel()->correoAvailable($correo);
        }
        $this->getModel()->set('correodisponible', $available);
    }
    
    function dologin(){
        $correo = Reader::read('correo');
        $clave = Reader::read('clave');
        $resultado = $this->getModel()->login($correo, $clave);
        if($resultado !== false) {
            $this->getSession()->login($resultado);
            $this->listaciudades();
            $resultado=true;
        }
        $this->getModel()->set('login', $resultado);
    }

    function dologout(){
        $this->getSession()->logout();
        $this->getModel()->set('logout', true);
    }

    function listaciudades() {
        $ordenes = [
            'id' => '',
            'name' => '',
            'countrycode' => '',
            'district' => '',
            'population' => ''
        ];
        $pagina = Reader::read('pagina');
        if($pagina === null || !is_numeric($pagina)) {
            $pagina = 1;
        }
        $orden = Reader::read('orden');
        if(!isset($ordenes[$orden])) {
            $orden = 'name';
        }
        $r = $this->getModel()->getDoctrineCiudades($pagina, $orden);
        $this->getModel()->add($r);
    }

    function listavalores() {
        $array = [];
        $array[] = ['codigo' => 1, 'descripcion' => 'hola'];
        $array[] = ['codigo' => 2, 'descripcion' => 'adios'];
        $this->getModel()->set('resultado', $array);
    }
    
    function main() {
        if($this->getSession()->isLogged()) {
            $this->getModel()->set('login', true);
            $this->getModel()->set('usuario', $this->getSession()->getLogin()->get());
            $this->listaciudades();
        } else {
            $this->getModel()->set('login', false);
        }
    }

    function nada() {
        sleep(3);
    }
    
    function register(){
        $usuario = Reader::readObject("izv\data\Usuario");
        $repiteclave = Reader::read('repiteclave');
        if($usuario->getClave() !== $repiteclave ||
                mb_strlen($usuario->getClave()) < 4 ||
                !filter_var($usuario->getCorreo(), FILTER_VALIDATE_EMAIL)) {
            $resultado = 0;
        } else {
            $usuario->setClave(Util::encriptar($usuario->getClave()));
            $resultado = $this->getModel()->addUser($usuario);
        }
        $this->getModel()->set('alta', $resultado);
    }
    
    function upload() {
        $result = false;
        if($this->getSession()->isLogged()) {
            $upload = new Upload('image');
            $upload->setTarget('upload/');
            $upload->setPolicy(Upload::POLICY_KEEP);
            $upload->setName($this->getSession()->getLogin()->getId());
            
            //Funciona pero hay error en upload a la hora de nombrar le archivo, no funciona bien setName();
            // echo $this->getSession()->getLogin()->getId();
            // if(file_exists( $upload->getRoute())) {
            //     unlink($upload->getRoute());
            // }
            
            $result = [
                'result' => $upload->upload(),
                'route'  => App::BASE . $upload->getRoute()
            ];
        }
        $this->getModel()->set('upload', $result);
    }
}