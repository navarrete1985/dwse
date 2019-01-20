<?php

namespace izv\controller;

use izv\app\App;
use izv\data\Usuario;
use izv\model\Model;
use izv\tools\Reader;
use izv\tools\Session;
use izv\tools\Util;

class AdminController extends Controller {

    function __construct(Model $model) {
        parent::__construct($model);
        //...
    }

    function main() {
        if($this->getSesion()->isLogged() && $this->getSesion()->getLogin()->getCorreo() == 'admin@admin.es') {
            //5º producir resultado
            $users = $this->getModel()->getAllOrOne();
            $this->getModel()->set('user', $this->getSesion()->getLogin()->getCorreo());
            $this->getModel()->set('users', $users);
        } else {
            //te redirijo
            header('Location: index/main');
            exit();
        }
    }
}