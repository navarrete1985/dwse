<?php

namespace izv\data;

/**
 * @Entity @Table(name="city")
 */
class City {

    use \izv\common\Common;

    /**
     * @Id
     * @Column(type="integer") @GeneratedValue
     */
    private $id;
    
    /**
     * @Column(type="string", length=35, nullable=false)
     */
    private $name;
    
    /**
     * @Column(type="string", length=3, nullable=false)
     */
    private $countrycode;
    
    /**
     * @Column(type="string", length=20, nullable=false)
     */
    private $district;
    
    /**
     * @Column(type="integer")
     */
    private $population;
    
    function __construct($id = null, $name = null, $countrycode = null, $district = null, $population = null) {
        $this->id = $id;
        $this->name = $name;
        $this->countrycode = $countrycode;
        $this->district = $district;
        $this->population = $population;
    }
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getCountrycode() {
        return $this->countrycode;
    }

    function getDistrict() {
        return $this->district;
    }

    function getPopulation() {
        return $this->population;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setCountrycode($countrycode) {
        $this->countrycode = $countrycode;
    }

    function setDistrict($district) {
        $this->district = $district;
    }

    function setPopulation($population) {
        $this->population = $population;
    }

}