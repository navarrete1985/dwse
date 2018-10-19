<?php

/*
Resumen de errores:
1 - no existe el archivo que se va a subir
2 - el tamaño del archivo excede el máximo, o el tipo no es válido
3 - ya existe un archivo con ese nombre
4 - ha fallado move_uploaded_file()
*/
//CUENTA LOS ARRAYS ASOCIATIVOS DE UN ARCHIVO COMO POR EJEMPLO ARCHIVO0
class MultiUpload {

    const POLICY_KEEP = 1,
          POLICY_OVERWRITE = 2,
          POLICY_RENAME = 3,
          MIN_OWN_ERROR = 1000;
            
    const ERROR_EMPTY_FILES = 1,
          ERROR_EXCEED_MAX_SIZE = 2,
          ERROR_NOT_MULTI_FILE = 3,
          ERROR_NOT_SET_FIELD = 4;

    private $error,
            $files,
            $input,
            $items,
            $maxSize = 0,
            $names,
            $policy = self::POLICY_OVERWRITE,
            $savedName = array(),
            $target = './',
            $type = '';

    function __construct($input) {
        $this->input = $input;
        $this->error = array(
                'genericos'=>0,
                'archivos'=>array(),
            );
            echo '<pre>' . var_export($this->error, true) . '</pre>'; 
        if(isset($_FILES[$input]) && $_FILES[$input]['name'] != '') {
            $this->files = $_FILES[$input];
            $this->name = $this->files['name'];
            $this->checkArray();
            $this->error['archivos'] = $this->files['error'];
        } else {
            $this->error['genericos'] = 1;
        }
    }
    
    function checkArray(){//compruebo que es array y una vez comprobado, compruebo que haya items en el array
        if(is_array($this->files['name']) && count($this->files['name'])>0){
            $this->names = $this->files['name'];//aqui consigo los nombres
           $this->items=count($this->names);//aqui paso los items
        }else{
            $this->error['genericos'] =2;
        }
    }
    
    private function __doUpload($indice) {
        $result = false;
        switch($this->policy) {
            case self::POLICY_KEEP:
                $result = $this->__doUploadKeep($indice);
                break;
            case self::POLICY_OVERWRITE:
                $result = $this->__doUploadOverwrite($indice);
                break;
            case self::POLICY_RENAME:
                $result = $this->__doUploadRename($indice);
                break;
        }
        if(!$result && $this->error === 0){
            $this->error['archivos'][$indice] = 4;
        }
        return $result;
    }
    
    private function getValidName($indice){
         $name='';
        if(is_array($this->names)){
            $name=$this->names[$indice];
        }else{
            $name=$this->names;
        }
        echo 'get valid name --> ' . $name . '<br>';
        return $name;
    }
    
    private function __doUploadKeep($indice) {
        $result = false;
        $name=$this->getValidName($indice);
        if(file_exists($this->target . $name) === false ) {
            $result = move_uploaded_file($this->files['tmp_name'][$indice], $this->target . $name);
        } else {
            $this->error = 3;
        }
        return $result;
    }
    
    private function __doUploadOverwrite($indice) {
        $name = $this->getValidName($indice);
        return move_uploaded_file($this->files['tmp_name'][$indice], $this->target . $name);
    }
    
    private function __doUploadRename($indice) {
        $name = $this-> getValidName($indice);
        echo 'name -> ' . $name . '<br>';
        $newName = $this->target . $name;
        if(file_exists($newName)) {
            $newName = self::__getValidName($newName);
        }
        $result = move_uploaded_file($this->files['tmp_name'][$indice], $newName);
        if($result) {
            $nombre = pathinfo($newName);
            $nombre = $nombre['basename'];
            $this->savedName[$indice] = $nombre;
        }
        return $result;
    }
    
    private static function __getValidName($file) {
        echo 'Ruta archivo --> ' . $file . '<br>';
        $parts = pathinfo($file);
        $extension = '';
        if(isset($parts['extension'])) {
            $extension = '.' . $parts['extension'];
        }
        $cont = 0;
        while(file_exists($parts['dirname'] . '/' . $parts['filename'] . $cont . $extension)) {
            $cont++;
        }
        return $parts['dirname'] . '/' . $parts['filename'] . $cont . $extension;
    }

    function getError() {
       /* $error = $this->error + self::MIN_OWN_ERROR;
        if($error === self::MIN_OWN_ERROR) {
            $error = $this->file['error'];
        }*/
        return $this->error;
    }

    function getMaxSize() {
        return $this->maxSize;
    }
    
    function getName() {
        $nombre = $this->savedName;
        if(count($nombre)===0) {
            $nombre = $this->name;
        }
        return $nombre;
    }

    function isValidSize($indice) {
        return ($this->maxSize === 0 || $this->maxSize >= $this->file['size'][$indice]);
    }

    function isValidType($indice) {
        $valid = true;
        if($this->type !== '') {
            $tipo = shell_exec('file --mime ' . $this->file['tmp_name'][$indice]);
            $posicion = strpos($tipo, $this->type);//devuelve dentro del string la primera coincidencia
            if($posicion === false) {
                $valid = false;
            }
        }
        return $valid;
    }

    function setMaxSize($size) {
        if(is_int($size) && $size > 0) {
            $this->maxSize = $size;
        }
        return $this;
    }

    function setName($name) {
        if(is_string($name) && trim($name) !== '') {
            $this->name = trim($name);
        }
        return $this;
    }

    function setPolicy($policy) {
        if(is_int($policy) && $policy >= self::POLICY_KEEP && $policy <= self::POLICY_RENAME) {
            $this->policy = $policy;
        }
        return $this;
    }

    function setTarget($target) {
        if(is_string($target) && trim($target) !== '') {
            $this->target = trim($target);
        }
        return $this;
    }

    function setType($type) {
        if(is_string($type) && trim($type) !== '') {
            $this->type = trim($type);
        }
        return $this;
    }

    function upload() {
        $result = false;
        if($this->error['genericos'] === 0) {
            echo 'entro en foreach' . '<br>';
            foreach ($this->files['name'] as $clave=>$valor ){
                echo 'iteracion ' . $clave . '<br>';
                if($this->error['archivos'][$clave] === 0 && $this->isValidSize($clave) && $this->isValidType($clave)) {
                    
                    $result = $this-> ($clave);
                } else {
                    $this->error['archivos'][$clave] = 2;
                }   
            }
           
        }
        return $result;
    }

}




/*
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