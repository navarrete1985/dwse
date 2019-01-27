<?php

namespace izv\model;

use izv\database\Database;
use izv\data\Usuario;
use izv\tools\Util;
use izv\managedata\ManageUsuario;

class UserModel extends Model {
    
    private $manage;
    
    function __construct() {
        parent::__construct();
        $this->manage = new ManageUsuario($this->db);
    }
    
    function createUser(Usuario $usuario) {
        return $this->manage->add($usuario);
    }
    
    function updateUser(Usuario $usuario) {
        return $this->manage->editWithPassword($usuario);
    }
    
    function deleteUser($id) {
        return $this->manage->remove($id);
    }
    
    function getUser($id) {
        return $this->manage->get($id);
    }
    
    function getAllUsers() {
        return $this->manage->getAll();
    }
    
    function getUsers($page = 1, $order = 'nombre', $filtro = null) {
        return $this->manage->getUsers($page == '' ? 1 : $page, $order == '' ? 'nombre' : $order, $filtro == '' ? null : $filtro);
    }
    
    function login($correo = '', $clave = '') {
        return $this->manage->login($correo, $clave);
    }
    
    function isEmailChanged($usuario) {
        return $this->manage->isEmailChanged($usuario);
    }
    
}