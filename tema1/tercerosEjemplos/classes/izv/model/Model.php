<?php

namespace izv\model;

use izv\database\Database;

class Model {

    private $db;
    private $datosVista = array();

    function __construct() {
        $this->db = new Database();
    }
    
    function __destruct() {
        $this->db->close();
    }
    
    function get($name) {
        if(isset($this->datosVista[$name])) {
            return $this->datosVista[$name];
        }
        return null;
    }

    function getDatabase() {
        return $this->db;
    }

    function getViewData() {
        return $this->datosVista;
    }

    function set($name, $value) {
        $this->datosVista[$name] = $value;
        return $this;
    }
}