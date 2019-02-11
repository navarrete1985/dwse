<?php

namespace izv\model;

use izv\tools\Bootstrap;

class Model {
    
    protected $datosVista = array(),
              $bootstrap,
              $gestor;
    
    function __construct() {
        $this->bootstrap = new Bootstrap();
        $this->gestor = $this->bootstrap->getEntityManager();
    }

    function get($name) {
        if(isset($this->datosVista[$name])) {
            return $this->datosVista[$name];
        }
        return null;
    }

    function getViewData() {
        return $this->datosVista;
    }

    function set($name, $value) {
        $this->datosVista[$name] = $value;
        return $this;
    }
}