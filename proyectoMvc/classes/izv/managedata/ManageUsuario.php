<?php

namespace izv\managedata;

use \izv\data\Usuario;
use \izv\database\Database;
use \izv\tools\Util;
use \izv\tools\Pagination;

class ManageUsuario {

    private $db;
    private $pagination;

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
    
    function getUsers($page, $orden, $filtro) {
        $pagination = new Pagination($this->getTotal(), $page, 3);
        $offset = $pagination->offset();
        $rpp = $pagination->rpp();
        $params = [
            "offset"    => [$offset, \PDO::PARAM_INT],
            "rpp"    => [$rpp, \PDO::PARAM_INT]
        ];
        
        if ($filtro !== null) {
            $sql = 'select * from usuario
                    where id like :filtro or nombre like :filtro or alias like :filtro or correo like :filtro
                    order by '. $orden .', nombre, alias, correo, id limit :offset, :rpp';
            $params['filtro'] = '%' . $filtro . '%';
        }else {
            $sql = 'select * from usuario order by ' . $orden . ', nombre, alias, correo, activo, administrador limit :offset, :rpp';
        }
        $datos = [];
        if ($this->db->execute($sql, $params)) {
            while($fila = $this->db->getSentence()->fetch()) {
                $usuario = new Usuario();
                $usuario->set($fila);
                $datos[] = $usuario;
            }
        }
        // return $datos;
        
        // echo Util::varDump( [
        //     'pages'     => $pagination->values(),
        //     'users'     => $datos,
        //     'range'     => $pagination->range(2),
        //     'filter'    => $filtro,
        //     'order'     => $orden
        // ]);
        // exit();
        
        return [
            'pages'     => $pagination->values(),
            'users'     => $datos,
            'range'     => $pagination->range(2),
            'filter'    => $filtro,
            'order'     => $orden,
            'actual'    => $page
        ];
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
            $sql = 'select * from usuario where correo = :correo or alias = :alias';
            $array = array(
                'correo' => $correo,
                'alias'  => $correo
            );
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
        if($this->db->connect()) {
            $sql = 'delete from usuario where id = :id';
            $array = array('id' => $id);
            if($this->db->execute($sql, $array)) {
                $resultado = $this->db->getSentence()->rowCount();
            }
        }
        return $resultado;
    }
    
    function getTotal() {
        $total = 0;
        if($this->db->connect()) {
            $sql = 'select count(*) from usuario';
            if($this->db->execute($sql)) {
                if($fila = $this->db->getSentence()->fetch()) {
                    $total = $fila[0];
                }
            }
        }
        return $total;
    }
    
}