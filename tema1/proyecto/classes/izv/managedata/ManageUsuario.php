<?php

namespace izv\managedata;

use \izv\database\Database;
use \izv\data\Usuario;
use \izv\tools\Util;

class ManageUsuario {
    
    private $database;
    const ACTIVATE   = 1,
          DEACTIVATE = 0;
    
    function __construct(Database $database) {
        $this->database = $database;
    }
    
    function activateUser($id) {
        return $this->__setUserState($id, self::ACTIVATE);
    }
    
    function add(Usuario $usuario) {
        $resultado = 0;
        if($this->database->connect()) {
            $query = 'insert into usuario values (:id, :correo, :alias, :nombre, :clave, :activo, :fechaalta)';
            if($this->database->execute($query, $usuario->get())) {
                $resultado = $this->database->getSentence()->rowCount();
            }
        }
        return $resultado;
    }
    
    function deactivateUser($id) {
        return $this->__setUserState($id, self::DEACTIVATE);
    }
    
    function edit(Usuario $usuario) {
        $resultado = 0;
        if($this->database->connect()) {
            $query = 'update usuario set correo = :correo, alias = :alias, nombre = :nombre, clave = :clave, activo = :activo, fechaalta = :fechaalta where id = :id';
            if($this->database->execute($query, $usuario->get())) {
                $resultado = $this->database->getSentence()->rowCount();
            }
        }
        return $resultado;
    }
    
    function get($id) {
        $usuario = null;
        if($this->database->connect()) {
            $query = 'select * from usuario where id = :id';
            $data = array('id' => $id);
            if($this->database->execute($query, $data)) {
                if($fila = $this->database->getSentence()->fetch()) {
                    $usuario = new Usuario();
                    $usuario->set($fila);
                }
            }
        }
        return $usuario;
    }
    
    function getAll() {
        $users = array();
        if($this->database->connect()) {
            $query = 'select * from usuario order by id';
            if($this->database->execute($query)) {
                while($fila = $this->database->getSentence()->fetch()) {
                    $usuario = new Usuario();
                    $usuario->set($fila);
                    $users[] = $usuario;
                }
            }
        }
        return $users;
    }
    
    /**
     * Método con el que comprobamos el login
     * return Devolvemos false si no hemos logueado correctamente o el usuario en caso de que el loguin sea bueno
     */
    function login($correo, $clave) {
        if($this->db->connect()) {
            $sql = 'select * from usuario where correo = :correo and activo = 1';
            $array = array('correo' => $correo);
            if($this->db->execute($sql, $array)) {
                if($fila = $this->db->getSentence()->fetch()) {
                    $usuario = new Usuario();
                    $usuario->set($fila);
                    $result = Util::verificarClave($clave, $usuario->getClave());
                    if ($result) {
                        $usuario->setClave('');
                        return $usuario;
                    }
                }
            }
        }
        return false;
    }
    
    function remove($id) {
        $resultado = 0;
        if($this->database->connect()) {
            $query = 'delete from usuario where id = :id';
            $data = array('id' => $id);
            if($this->database->execute($query, $data)) {
                $resultado = $this->database->getSentence()->rowCount();
            }
        }
        return $resultado;
    }
    
    function __setUserState($id, $state) {
        $resultado = 0;
        if($this->database->connect()) {
            $query = 'update from usuario set activo = :activo where id = :id';
            $data = array(
                'estado' => $state,
                'id'     => $id
            );
            if($this->database->execute($query, $data)) {
                $resultado = $this->database->getSentence()->rowCount();
            }
        }
        return $resultado;
    }
}