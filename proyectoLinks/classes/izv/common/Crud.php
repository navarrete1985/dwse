<?php 

namespace izv\common;

trait Crud {
    
    private $prefix = '\izv\data\\';
    
    function get($clase, array $data = ['id' => '']) {
        return $this->gestor->getRepository($this->prefix . $clase)->findOneBy($data);
    }
    
    function getAll ($clase) {
        return $this->gestor->getRepository($this->prefix . $clase)->findAll();
    }
    
    function create($item) {
        $result = 1;
        try {
            $r = $this->gestor->persist($item);
            $this->gestor->flush();
            return $item;    
        }catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException $e){
            $result = -1;
        }    
        catch(\Exception $e){
            $result = 0;
        }
        return $result;
    }
    
    function update ($item) {
        $this->gestor->persist($item);
        $this->gestor->flush();
        return $item;
    }
    
    function delete($clase, $id) {
        $item = $this->get($clase, ['id' => $id]);
        $this->gestor->remove($item);
        $this->gestor->flush();
        return $item;
    }
    
}