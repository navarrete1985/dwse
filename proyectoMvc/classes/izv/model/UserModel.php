<?php

namespace izv\model;

use izv\database\Database;
use izv\data\Usuario;
use izv\tools\Util;

class UserModel extends Model {
    
    function createUser(Usuario $usuario) {
        $resultado = 0;
        if($this->db->connect()) {
            $sql = 'insert into usuario values(:id, :correo, :alias, :nombre , :clave, :activo, :fechaalta, :administrador)';
            if($this->db->execute($sql, $usuario->get())) {
                $resultado = $this->db->getConnection()->lastInsertId();
            }
        }
        return $resultado;
    }
    
    function updateUser(Usuario $usuario) {
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
    
    function deleteUser($id) {
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
    
    function getUser($id) {
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
                        echo('La verificación de la clave se ha realizado con éxito!');
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
    
}