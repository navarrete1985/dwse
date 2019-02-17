<?php

namespace izv\model;

use izv\database\Database;
use izv\data\Usuario;
use izv\tools\Util;
use izv\tools\Bootstrap;

class LinkModel extends Model {
    
    use \izv\common\Crud;
    
    function getUsers($page = 1, $order = 'nombre', $filtro = null) {
        // return $this->manage->getUsers($page == '' ? 1 : $page, $order == '' ? 'nombre' : $order, $filtro == '' ? null : $filtro);
    }
    
    function login($correo = '', $clave = '') {
        $usuario = new Usuario();
        $usuario->setCorreo($correo);
        $usuario = $this->gestor->createQuery('select u from izv\data\Usuario u where u.correo = :correo or u.alias = :correo')
                                ->setParameter('correo', $correo)
                                ->getOneOrNullResult();
        return $usuario;
    }
    
    function isEmailChanged($usuario) {
        // return $this->manage->isEmailChanged($usuario);
    }
    
    function activateUser($id, $correo) {
        $result = 0;
        $usuario = $this->gestor->get(['correo' => $correo, 'id' => $id]);
        if ($usuario !== null) {
            $usuario->setActivo(1);
            $this->gestor->persist($usuario);
            $this->gestor->flush();
            return 1;
        }
        return 0;
    }
    
    function getCategories($userId) {
        $result = $this->gestor->createQuery('SELECT c FROM izv\data\Categoria c JOIN c.usuario u WHERE u.id = :id')
                ->setParameter('id', $userId)
                ->getResult();
        return $result;
    }
    
}