<?php

namespace izv\controller;

use izv\app\App;
use izv\model\Model;
use izv\tools\Session;

class UserController extends Controller {

    /*function __construct(Model $model) {
        parent::__construct($model);
        $this->getModel()->set('title', 'New App');
    }*/

    function login() {
        $this->getModel()->set('twigFile', '_login.html');
    }

    /*function main() {
        //$this->getModel()->set('twigFile', '_main.html');
    }*/

    function register() {
        $this->getModel()->set('twigFile', '_register.html');
    }
}