<?php

namespace izv\model;

use Doctrine\ORM\Tools\Pagination\Paginator;

use izv\data\City;
use izv\database\Database;
use izv\managedata\Bootstrap;
use izv\tools\Pagination;

class AppModel extends Model {

    function getCiudades($pagina = 1, $orden = 'name', $filtro = null) {
        $total = $this->getTotalCiudades();
        $paginacion = new Pagination($total, $pagina);
        $offset = $paginacion->offset();
        $rpp = $paginacion->rpp();
        $parametros = array(
            'offset' => array($offset, \PDO::PARAM_INT),
            'rpp' => array($rpp, \PDO::PARAM_INT)
        );
        if($filtro === null) {
            $sql = 'select * from city order by '. $orden .', name, countrycode, district, population, id limit :offset, :rpp';
        } else {
            $sql = 'select * from city
                    where id like :filtro or name like :filtro or countrycode like :filtro or district like :filtro or population like :filtro
                    order by '. $orden .', name, countrycode, district, population, id limit :offset, :rpp';
            $parametros['filtro'] = '%' . $filtro . '%';
        }
        $array = [];
        if($this->getDatabase()->connect()) {
            if($this->getDatabase()->execute($sql, $parametros)) {
                while($fila = $this->getDatabase()->getSentence()->fetch()) {
                    $objeto = new City();
                    $objeto->set($fila);
                    $array[] = $objeto;
                }
            }
        }
        
        $enlaces = $paginacion->values();
        return array(
            'paginas' => $enlaces,
            'ciudades' => $array,
            'rango' => $paginacion->range(5),
            'orden' => $orden,
            'filtro' => $filtro
        );
    }

    function getDoctrineCiudades($pagina = 1, $orden = 'name') {
        //$bs = new Bootstrap();
        //$gestor = $bs->getEntityManager();
        $gestor = $this->getDatabase();
        $dql = 'select c from izv\data\City c order by c.'. $orden .', c.name, c.countrycode, c.district, c.population, c.id';
        $query = $gestor->createQuery($dql);
        
        /*return $gestor->createQuery($dql)
        ->setMaxResults(5)
        ->setFirstResult(10)
        ->getResult();*/
        
        $paginator = new Paginator($query);
        $limit = 10;
        $paginator->getQuery()
            ->setFirstResult($limit * ($pagina - 1))
            ->setMaxResults($limit);
        /*foreach($paginator as $city) {
            echo 'modelo: ' . $city->getName() . '<br>';
        }*/
        //return $paginator->toJson();
        $r = array();
        foreach($paginator as $city) {
            $r[] = $city->get();
        }
        return $r;
    }

    function getTotalCiudades() {
        $ciudades = 0;
        if($this->getDatabase()->connect()) {
            $sql = 'select count(*) from city';
            if($this->getDatabase()->execute($sql)) {
                if($fila = $this->getDatabase()->getSentence()->fetch()) {
                    $ciudades = $fila[0];
                }
            }
        }
        return $ciudades;
    }
}