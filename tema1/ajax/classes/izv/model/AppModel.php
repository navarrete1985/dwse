<?php

namespace izv\model;

use Doctrine\ORM\Tools\Pagination\Paginator;

use izv\data\City;
use izv\database\Database;
use izv\managedata\Bootstrap;
use izv\tools\Pagination;
use izv\tools\Util;
use izv\data\Usuario;

class AppModel extends Model {

    /*function getCiudades($pagina = 1, $orden = 'name', $filtro = null) {
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
    }*/
    
    function addUser(Usuario $usuario) {
        try {
            $gestor = $this->getDatabase();
            $gestor->persist($usuario);
            $gestor->flush();
            return $usuario->getId();
        } catch(\Exception $e) {
            return 0;
        }
    }

    function aliasAvailable($alias) {
        $gestor = $this->getDatabase();
        $dql = 'select count(u) from izv\data\Usuario u where u.alias = :alias';
        $query = $gestor->createQuery($dql)->setParameter('alias', $alias);
        $resultado = $query->getResult();
        $cuenta = $resultado[0][1];
        $resultado = 0;
        if($cuenta === '0'){
            $resultado = 1;
        }
        return $resultado;
    }
    
    function correoAvailable($correo) {
        $gestor = $this->getDatabase();
        $dql = 'select count(u) from izv\data\Usuario u where u.correo = :correo';
        $query = $gestor->createQuery($dql)->setParameter('correo', $correo);
        $resultado = $query->getResult();
        $cuenta = $resultado[0][1];
        $resultado = 0;
        if($cuenta === '0'){
            $resultado = 1;
        }
        return $resultado;
    }

    function getDoctrineCiudades($pagina = 1, $orden = 'name', $limit = 10) {
        $gestor = $this->getDatabase();
        $dql = 'select c from izv\data\City c where c.name < :name order by c.'. $orden .', c.name, c.countrycode, c.district, c.population, c.id';
        $query = $gestor->createQuery($dql)->setParameter('name', 'zz');
        $paginator = new Paginator($query);
        $paginator->getQuery()
            ->setFirstResult($limit * ($pagina - 1))
            ->setMaxResults($limit);
        $pagination = new Pagination($paginator->count(), $pagina, $limit);
        //return $paginator;
        $ciudades = array();
        foreach($paginator as $city) {
            $ciudades[] = $city->get();
        }
        return ['ciudades' => $ciudades, 'paginas' => $pagination->values()];
    }

    /*function getTotalCiudades() {
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
    }*/
    
    function login($correo, $clave){
        $gestor = $this->getDatabase();
        $usuario = $gestor->getRepository('izv\data\Usuario')->findOneBy(['correo' => $correo]);
        if ($usuario !== null) {
            $resultado = Util::verificarClave($clave, $usuario->getClave());
            if ($resultado) {
                $usuario->setClave('');
                $this->set('usuario', $usuario->get());
                return $usuario;
            }
        }
        return false;
    }
}