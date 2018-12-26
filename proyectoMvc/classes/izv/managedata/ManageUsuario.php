<?php

namespace izv\managedata;

use \izv\data\Usuario;
use \izv\database\Database;
use \izv\tools\Util;

class ManageUsuario {

    private $db;

    function __construct(Database $db) {
        $this->db = $db;
    }

    function add(Usuario $usuario) {
        $resultado = 0;
        if($this->db->connect()) {
            $sql = 'insert into usuario values(:id, :correo, :alias, :nombre , :clave, :activo, :fechaalta, :administrador)';
            if($this->db->execute($sql, $usuario->get())) {
                $resultado = $this->db->getConnection()->lastInsertId();
            }
        }
        return $resultado;
    }

    function edit(Usuario $usuario) {
        $resultado = 0;
        if($this->db->connect()) {
            $sql = 'update usuario set correo = :correo, alias = :alias, nombre = :nombre, activo = :activo, administrador = :administrador where id = :id';
            $array = $usuario->get();
            unset($array['clave']);
            unset($array['fechaalta']);
            echo Util::varDump($array);
            if($this->db->execute($sql, $array)) {
                $resultado = $this->db->getSentence()->rowCount();
            }
        }
        return $resultado;
    }

    function editWithPassword(Usuario $usuario) {
        $resultado = 0;
        if($this->db->connect()) {
            $sql = 'update usuario set correo = :correo, alias = :alias, nombre = :nombre , clave = :clave, activo = :activo, administrador = :administrador where id = :id';
            $array = $usuario->get();
            unset($array['fechaalta']);
            if($this->db->execute($sql, $array)) {
                $resultado = $this->db->getSentence()->rowCount();
            }
        }
        return $resultado;
    }
    
    function get($id) {
        $usuario = null;
        if($this->db->connect()) {
            $sql = 'select * from usuario where id = :id';
            $array = array('id' => $id);
            if($this->db->execute($sql, $array)) {
                if($fila = $this->db->getSentence()->fetch()) {
                    $usuario = new Usuario();
                    $usuario->set($fila);
                }
            }
        }
        return $usuario;
    }

    function getAll() {
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
        echo 'Entro en el método remove';
        if($this->db->connect()) {
            echo 'Entro en conectar con la base de datos';
            $sql = 'delete from usuario where id = :id';
            $array = array('id' => $id);
            if($this->db->execute($sql, $array)) {
                $resultado = $this->db->getSentence()->rowCount();
            }
        }
        return $resultado;
    }
    
}