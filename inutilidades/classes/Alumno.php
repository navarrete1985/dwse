<?php

class Alumno {
    private $numeroMatricula, $nombre, $apellidos, 
            $fechaNacimiento, $telefono, $sexo, $dni;
    function getNumeroMatricula() {
        return $this->numeroMatricula;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getDni() {
        return $this->dni;
    }

    function setNumeroMatricula($numeroMatricula) {
        $this->numeroMatricula = $numeroMatricula;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setDni($dni) {
        $this->dni = $dni;
    }

}
