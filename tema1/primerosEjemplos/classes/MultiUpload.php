<?php

class MultiUpload {
    
    const POLICITY_KEEP = 1,
          POLICITY_OVERWRITE = 2,
          POLICITY_RENAME = 3;
    
    const ERROR_EMPTY_FILES = 1,
          ERROR_EXCEED_MAX_SIZE = 2,
          ERROR_NOT_MULTI_FILE = 3,
          ERROR_NOT_SET_FIELD = 4;
          
    private $error = 0,
            $files,
            $input, 
            $items = 0, 
            $maxSize = 0, 
            $names,
            $policity = self::POLICITY_KEEP, 
            $saved = false,
            $savedName = '',
            $target = './';
    
    function __construct($input) {
        $this->input = $input;
        if (is_string($input) && isset($_FILES[$input])) {
            $this->files = $_FILES[$fieldName];
            $this->chekFiles();
        }else {
            $this->error = self::ERROR_NOT_SET_FIELD;
        }
    }
    
    private function chekFiles() {
        if (is_array($this->files['name'])) {
            if (count($this->files['name']) > 0) {
              $this->names = $this->files['name'];
              $this->items = count($this->names);
            }else {
              $this->error = self::ERROR_EMPTY_FILES;
            }
        }else {
            $this->error = self::ERROR_NOT_MULTI_FILE;
        }
    }
    
    function getMaxSize() {
        return $this->maxSize;
    }
    
    /**
     * Si no tenemos nombre de archivo a salvar, mandamos el array de nombres de archivo
     * En caso de que tengamos nombres de archivo a guardar, miramos la politica de guardado,
     * y en caso de que sea rename y no se hayan guardado los archivos aún...miramos que nombre le 
     * vamos a poner....y enviamos array con los nombres que van a tener cada uno de los archivos
     * Tenemos que tener en cuenta también...que si la politica es rename y no hemos guardado, tenemos que
     * ver que nombres va a tener cada uno de los archivos
     * */
    function getNames() {
      $nombres = array();
      if ($this->savedName !== '') {
        array_push($nombres, $this->savedName);
        $this->names = $nombres;
      }
      
      if ($this->policity === self::POLICITY_RENAME && !$this->saved) {
        $this->names = $this->getValidNames();
      }
      
      return $this->names;
    }
    
    function getNumberOfItems() {
        return $this->items;
    }
    
    function getPolicity() {
        return $self->policity;
    }
    
    function getSavedName() {
      return $this->savedName;
    }
    
    function getTarget() {
      return $this->target;
    }
    
    /**
     * Método que nos devolverá un array con los nombres válidos en caso de que tengamos
     * la política de guardado de rename, para asegurarnos de que devolvemos los nombres 
     * correctos en caso de que tengamos que renombrarlos
     */
    private function getValidNames() {
      
    }
    
    function setMaxSize($maxSize) {
        if (is_int($maxSize) && $maxSize > 0) {
            $this->maxSize = $maxSize;
        }
        return $this;
    }
    
    function setPolicy ($policity) {
        if (is_int($policity) && $policity > self::POLICITY_KEEP && $policity <= self::POLICITY_RENAME) {
            $this->policity = $policity;
        }
        return $this;
    }
    
    function setSavedName($savedName) {
      if (is_string($savedName) && strlen(trim($savedName)) > 0){
        $this->savedName = trim($savedName);
      }
      return $this;
    }
    
    function setTarget($target) {
      if (is_string($target) && strlen(trim($target)) > 0){
        $this->target = trim($target);
      }
      return $this;
    }
    
}

/*

type = 'pdf';

$pos = strpos(text/pdf, 'jpej')0/-1 -> false


consulta shelll -> text/pdf


array(
    'generales'  => 0,
    'php' => array(),
);

array (
  'generales' => 0,
  'nogenerales'=>
      array (
        0 => 'apuntesT1.md',
        1 => 'apuntesT1.pdf',
      ),
  )

Datos a devolver:
array (
  'archivos0' => 
  array (
    'name' => 
    array (
      0 => 'apuntesT1.md',
      1 => 'apuntesT1.pdf',
    ),
    'type' => 
    array (
      0 => 'application/octet-stream',
      1 => 'application/pdf',
    ),
    'tmp_name' => 
    array (
      0 => '/tmp/phpeqxbIk',
      1 => '/tmp/phpEO0F19',
    ),
    'error' => 
    array (
      0 => 0,
      1 => 0,
    ),
    'size' => 
    array (
      0 => 5104,
      1 => 101374,
    ),
  ),
  'archivos1' => 
  array (
    'name' => 
    array (
      0 => '',
    ),
    'type' => 
    array (
      0 => '',
    ),
    'tmp_name' => 
    array (
      0 => '',
    ),
    'error' => 
    array (
      0 => 4,
    ),
    'size' => 
    array (
      0 => 0,
    ),
  ),
  'archivos2' => 
  array (
    'name' => 
    array (
      0 => '',
    ),
    'type' => 
    array (
      0 => '',
    ),
    'tmp_name' => 
    array (
      0 => '',
    ),
    'error' => 
    array (
      0 => 4,
    ),
    'size' => 
    array (
      0 => 0,
    ),
  ),
)
*/

/*
Realizar la clase upload múltiple<br>
    Entregar El jueves próximo<br>
    Que sea llamada sólamente con el nombre del campo de entrada input type"" name='esteNombre'<br>
    deberá tener al menos:
        1. Cuantos archivos vienen
        2. Cuantos se ha podido subir
        3. Get name -> arra()nombres de los archivos
        4. Con 1 solo target
        5. Set name...se le llama al archivo lo mismo a todos
        5. En tamaño comparamos cada uno de los archivos con el maxSize

*/