<?php

namespace izv\mvc;

class Router {

    private $rutas, $ruta;
    
    function __construct($ruta) {
        $this->rutas = array(
            'admin' => new Route('AdminModel', 'AdminView' , 'AdminController'),
            'index' => new Route('UserModel', 'MaundyView', 'UserController'),
            'ajax'  => new Route('UserModel', 'AjaxView', 'AjaxController')
            // 'index2' => new Route('FirstModel', 'SecondView', 'FirstController'),
            // 'index3' => new Route('FirstModel', 'ThirdView', 'FirstController')
        );
        $this->ruta = $ruta;
    }

    function getRoute() {
        $ruta = $this->rutas['index'];
        if(isset($this->rutas[$this->ruta])) {
            $ruta = $this->rutas[$this->ruta];
        }
        return $ruta;
    }
}