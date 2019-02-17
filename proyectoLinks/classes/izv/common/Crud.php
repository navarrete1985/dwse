<?php 

namespace izv\common;

use izv\tools\Pagination;
use Doctrine\ORM\Tools\Pagination\Paginator;
use izv\tools\Util;
use izv\data\Usuario;
use izv\data\Categoria;
use izv\data\Link;
use izv\app\App;

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
    
    function getLinksPaginator($userId, $pagina = 1, $orden = 'c.categoria', $limit = 2) {
        if(!isset(APP::FILTER[$orden])) {
            $orden = 'c.categoria';
        }
        
        if($pagina === null || !is_numeric($pagina)) {
            $pagina = 1;
        }
        
        $dql = 'SELECT l, c FROM izv\data\Link l JOIN l.usuario u JOIN l.categoria c WHERE u.id = :id
                    ORDER BY ' . $orden . ', c.categoria, l.href, l.comentario, l.id';
        // $queryBuilder = $this->gestor->createQueryBuilder();
        // $query = $queryBuilder
        //     ->select('l, c')
        //     ->from('izv\data\Link', 'l')
        //     ->join('l.usuario', 'u')
        //     ->join('l.categoria', 'c')
        //     ->where($queryBuilder->expr()->eq('u.id', ':id'))
        //     ->setParameter('id', $userId)
        //     ->getQuery();
        $query = $this->gestor->createQuery($dql)->setParameter('id', $userId);
        $paginator = new Paginator($query);
        $paginator->getQuery()
            ->setFirstResult($limit * ($pagina - 1))
            ->setMaxResults($limit);
        $pagination = new Pagination($paginator->count(), $pagina, $limit);
        $links = [];
        foreach($paginator as $link) {
            $categoria = $link->getCategoria()->getCategoria();
            // $result= [
            //     'link'      => $link->getUnset(['categoria', 'usuario']),
            //     'categoria' => $categoria
            // ];
            $result= [
                'link'      => $link->getUnset(['categoria', 'usuario'])
            ];
            $result['link']['categoria'] = $categoria;
            $links[] = $result;
            
        }
        return ['links' => $links, 'paginas' => $pagination->values()];
    }
    
}