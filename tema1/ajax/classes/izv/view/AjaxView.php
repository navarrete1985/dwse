<?php

namespace izv\view;

use izv\model\Model;
use izv\tools\Util;

class AjaxView extends View {

    function render($accion) {
        header('Content-type:application/json');

        $data = $this->getModel()->getViewData();
        return json_encode($data, true);
    }
}