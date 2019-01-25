<?php

namespace izv\view;

use izv\model\Model;
use izv\tools\Util;

abstract class View {

    private $model;

    function __construct(Model $model) {
        $this->model = $model;
    }
    
    function getModel() {
        return $this->model;
    }

    abstract function render($accion);
}