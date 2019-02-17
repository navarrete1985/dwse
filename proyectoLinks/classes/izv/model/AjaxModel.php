<?php

namespace izv\model;

use izv\data\Categoria;

class AjaxModel extends Model {
    
    use \izv\common\Crud;

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