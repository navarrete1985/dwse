<?php

namespace izv\model;

use Doctrine\ORM\Tools\Pagination\Paginator;

use izv\tools\Pagination;
use izv\data\Usuario;
use izv\data\Categoria;
use izv\data\Link;
use izv\tools\Util;
use izv\tools\Bootstrap;

class AjaxModel extends Model {
    
    use \izv\common\Crud;

    function getDoctrineUsuarios($pagina = 1, $orden = 'nombre', $limit = 3) {
        
        $dql = 'select c from tienda\data\Usuario c where c.nombre < :nombre 
        order by c.'. $orden .', c.nombre, c.correo, c.apellidos, c.alias,c.direccion,c.activo,c.rol';
        $query = $this->gestor->createQuery($dql)->setParameter('nombre', 'zz');
        $paginator = new Paginator($query);
        $paginator->getQuery()
            ->setFirstResult($limit * ($pagina - 1))
            ->setMaxResults($limit);
        $pagination = new Pagination($paginator->count(), $pagina, $limit);
        // return $paginator;
        $usuarios = array();
        foreach($paginator as $user) {
            $usuarios[] = $user->getUnset(array('clave','fechaalta','pedidos',));
        }
        return ['usuarios' => $usuarios, 'paginas' => $pagination->values()];
        
    }
    
    function createCategory($userId, $categoryName) {
        $usuario = $this->gestor->getReference('izv\data\Usuario', $userId);
        $category = new Categoria();
        $category->setUsuario($usuario);
        $category->setCategoria($categoryName);
        return $this->create($category);
    }
    
    function createLink($userId, $categoryId, $link) {
        $usuario = $this->gestor->getReference('izv\data\Usuario', $userId);
        $categoria = $this->gestor->getReference('izv\data\Categoria', $categoryId);
        $link->setUsuario($usuario);
        $link->setCategoria($categoria);
        return $this->create($link);
    }
    
}