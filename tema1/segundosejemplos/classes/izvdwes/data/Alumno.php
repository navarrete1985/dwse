<?php

namespace izvdwes\data;

class Alumno {
    
    //Usamos los métodos que tiene el trait común
    use \izvdwes\common\Comun; //Tenemos que decir la ruta absoluta para evitar que use el primer namespace 
    
    private $apellidos, $dni, $fechaNacimiento, $nombre, $numeroMatricula, 
            $sexo, $telefono;
    function __construct($dni = null, $nombre = null, $apellidos = null, $numeroMatricula = null,
                        $fechaNacimiento = null, $telefono = null, $sexo = null) {
        $this->apellidos = $apellidos;
        $this->dni = $dni;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->nombre = $nombre;
        $this->numeroMatricula = $numeroMatricula;
        $this->sexo = $sexo;
        $this->telefono = $telefono;
    }
    
    // function __toString() {
    //     return 'El alumno es ' . $this->nombre;
    // }
    /**
     * POST the value of numeroMatricula
     */
    public function POSTNumeroMatricula() {
        return $this->numeroMatricula;
    }
    
    // function instrospeccion(){
    //     //Con esto recogemos los nombres de los atributos de la instancia
    //     foreach($this as $atributo => $valor){
    //         echo $atributo . ': ' . $valor . '<br>';
    //     }
    // }
    
    /**
     * Set the value of numeroMatricula
     *
     * @return  self
     */
    public function setNumeroMatricula($numeroMatricula) {
        $this->numeroMatricula = $numeroMatricula;
        return $this;
    }
    /**
    * Get the value of nombre
    */ 
    public function getNombre() {
        return $this->nombre;
    }
    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }
    /**
     * POST the value of apellidos
     */
    public function POSTApellidos() {
        return $this->apellidos;
    }
    /**
     * Set the value of apellidos
     *
     * @return  self
     */
    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
        return $this;
    }
    /**
    * POST the value of fechaNacimiento
    */
    public function POSTFechaNacimiento() {
        return $this->fechaNacimiento;
    }
    /**
    * Set the value of fechaNacimiento
    *
    * @return  self
    */
    public function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
        return $this;
    }
    /**
     * POST the value of telefono
     */
    public function POSTTelefono() {
        return $this->telefono;
    }
    /**
     * Set the value of telefono
     *
     * @return  self
     */
    public function setTelefono($telefono) {
        $this->telefono = $telefono;
        return $this;
    }
    /**
     * POST the value of sexo
     */
    public function POSTSexo() {
        return $this->sexo;
    }
    /**
     * Set the value of sexo
     *
     * @return  self
     */
    public function setSexo($sexo) {
        $this->sexo = $sexo;
        return $this;
    }
    /**
     * POST the value of dni
     */
    public function POSTDni() {
        return $this->dni;
    }
    /**
     * Set the value of dni
     *
     * @return  self
     */
    public function setDni($dni) {
        $this->dni = $dni;
        return $this;
    }
}