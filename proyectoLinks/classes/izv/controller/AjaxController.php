<?php

namespace izv\controller;

use izv\model\Model;
use izv\tools\Session;
use izv\tools\Util;
use izv\tools\Reader;
use izv\data\Categoria;
use izv\data\Link;

class AjaxController extends Controller {
    
    function main() {
        
    }
    
    function addCategory() {
        $this->checkIsLogged();
        $userId = $this->getSesion()->getLogin()->getId();
        $categoryName = trim(Reader::read('category'));
        $result = $this->getModel()->createCategory($userId, $categoryName);
        $this->getModel()->set('result', ($result instanceof Categoria) ? $result->getId() : $result);
    }
    
    function addLink() {
        $this->checkIsLogged();
        $userId = $this->getSesion()->getLogin()->getId();
        $categoryId = Reader::read('categoryId');
        $link = Reader::readObject('izv\data\Link');
        $result = $this->getModel()->createLink($userId, $categoryId, $link);
        $this->getModel()->set('result', ($result instanceof Link) ? $result->getId() : $result);
    }
    
    function deleteLink() {
        $this->checkIsLogged();
        $linkId = Reader::read('link');
        $result = $this->getModel()->delete('Link', $linkId);
        $this->getModel()->set('result', ($result->getId() === null) ? 1 : 0);
    }
    
    function getLinks() {
        $this->checkIsLogged();
        $pagina = Reader::read('pagina');
        $orden = Reader::read('orden');
        $r = $this->getModel()->getLinksPaginator($this->getSesion()->getLogin()->getId(), $pagina, $orden);
        $this->getModel()->add($r);
    }
}
