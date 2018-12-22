<?php

namespace izv\view;

use izv\model\Model;
use izv\tools\Util;

class SecondView extends View {

    function render($accion) {
        $this->getModel()->set('twigFolder', 'twigtemplates/grayscale');
        $datos = $this->getModel()->getViewData();
        require_once("classes/vendor/autoload.php");
        $loader = new \Twig_Loader_Filesystem('twigtemplates/grayscale/');
        $twig = new \Twig_Environment($loader);
        return $twig->render($this->getModel()->get('twigFile'), $datos);
    }
}