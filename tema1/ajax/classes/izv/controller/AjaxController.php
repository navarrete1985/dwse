<?php

namespace izv\controller;

use izv\app\App;
use izv\data\Usuario;
use izv\model\Model;
use izv\tools\Reader;
use izv\tools\Session;
use izv\tools\Util;

class AjaxController extends Controller {

    function __construct(Model $model) {
        parent::__construct($model);
        //...
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
        //var_dump($r);
        $this->getModel()->add($r);
    }

    function listavalores() {
        $array = [];
        $array[] = ['codigo' => 1, 'descripcion' => 'hola'];
        $array[] = ['codigo' => 2, 'descripcion' => 'adios'];
        $this->getModel()->set('resultado', $array);
    }
    
    function main() {
    }

}