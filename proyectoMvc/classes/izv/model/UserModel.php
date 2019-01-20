<?php

namespace izv\model;

use izv\database\Database;
use izv\data\Usuario;
use izv\tools\Util;
use izv\managedata\ManageUsuario;

class UserModel extends Model {
    
    function createUser(Usuario $usuario) {
        $manage = new ManageUsuario($this->db);
        return $manage->add($usuario);
    }
    
    function updateUser(Usuario $usuario) {
        $manage = new ManageUsuario($this->db);
        return $manage->editWithPassword($usuario);
    }
    
    function deleteUser($id) {
        $resultado = 0;
        if($this->db->connect()) {
            $sql = 'delete from usuario where id = :id';
            $array = array('id' => $id);
            if($this->db->execute($sql, $array)) {
                $resultado = $this->db->getSentence()->rowCount();
            }
        }
        return $resultado;
    }
    
    function getUser($id) {
        $manage = new ManageUsuario($this->db);
        return $manage->get($id);
    }
    
    function getAllUsers() {
        $array = array();
        if($this->db->connect()) {
            $sql = 'select * from usuario order by nombre';
            if($this->db->execute($sql)) {
                while($fila = $this->db->getSentence()->fetch()) {
                    $usuario = new Usuario();
                    $usuario->set($fila);
                    $array[] = $usuario;
                }
            }
        }
        return $array;
    }
    
    function login($correo = '', $clave = '') {
        if($this->db->connect()) {
            $sql = 'select * from usuario where correo = :correo or alias = :alias';
            $array = array(
                'correo' => $correo,
                'alias' => $correo
                );
            if($this->db->execute($sql, $array)) {
                if($fila = $this->db->getSentence()->fetch()) {
                    $usuario = new Usuario();
                    $usuario->set($fila);
                    $resultado = Util::verificarClave($clave, $usuario->getClave());
                    if($resultado) {
                        $usuario->setClave('');
                        return $usuario;
                    }
                }
            }
        }
        return false;
    }
    
    function isEmailChanged($usuario) {
        $result = true;
        if($this->db->connect()) {
            $sql = 'select * from usuario where correo = :correo and id = :id';
            $array = ['correo' => $usuario->getCorreo(),
                      'id'     => $usuario->getId()];
            
            if($this->db->execute($sql, $array)) {
                if($fila = $this->db->getSentence()->fetch()) {
                    $result = false;
                }
            }
        }
        return $result;
    }
    
    function editUser($id) {
        $manage = new ManageUsuario($this->db);
    }
    
}