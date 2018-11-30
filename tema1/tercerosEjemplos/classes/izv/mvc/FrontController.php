<?php

namespace izv\mvc;

class FrontController {
    
    private $model, $view, $controller;
    private $accion;
    
    function __construct($ruta, $accion) {
        $router = new Router($ruta);
        $this->route = $router->getRoute();
        $this->accion = $accion;
        
        $model = $route->getModel();
        $this->model = new $model();
        $controller = $route->getController();
        $this->controller = new $controller($this->model);
        $view = $route->getView();
        $this->view = new $view($this->model);
    }
    
    function doAction() {
        
    }
    
    function render() {
        
    }
    
}