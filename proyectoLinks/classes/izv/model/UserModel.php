<?php

namespace izv\model;

use izv\database\Database;
use izv\data\Usuario;
use izv\tools\Util;
use izv\tools\Bootstrap;

class UserModel extends Model {
    
    function createUser(Usuario $usuario) {
        $result = 1;
        try {
            $this->gestor->persist($usuario);
            $this->gestor->flush();
            return $usuario->getId();    
        }catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException $e){
            $result = -1;
            echo 'Constraint violation <br>';
            echo $e;
        }    
        catch(\Exception $e){
            $result = 0;
            echo $e;
        }
        exit();
        return $result;
    }
    
    function updateUser(Usuario $usuario) {
        
    }
    
    function deleteUser($id) {
        
    }
    
    function getUser($id) {
        
    }
    
    function getAllUsers() {
        $usuario = new Usuario();
        $usuario = $this->gestor->getRepository('\tienda\data\Usuario')->findAll();
        return $usuario;   
    }
    
    function getUsers($page = 1, $order = 'nombre', $filtro = null) {
        // return $this->manage->getUsers($page == '' ? 1 : $page, $order == '' ? 'nombre' : $order, $filtro == '' ? null : $filtro);
    }
    
    function login($correo = '', $clave = '') {
        $usuario = new Usuario();
        $usuario->setCorreo($correo);
        $usuario = $this->gestor->getRepository('\tienda\data\Usuario')->findOneBy(array('correo' => $correo));
        return $usuario;
        // return $this->manage->login($correo, $clave);
    }
    
    function isEmailChanged($usuario) {
        // return $this->manage->isEmailChanged($usuario);
    }
    
    function activateUser($id, $correo) {
        $result = 0;
        $usuario = $this->gestor->getRepository('tienda\data\Usuario')->findOneBy(array('correo' => $correo, 'id' => $id));
        if ($usuario !== null) {
            $usuario->setActivo(1);
            $this->gestor->persist($usuario);
            $this->gestor->flush();
            return 1;
        }
        return 0;
    }
    
}