<?php

class Upload {
    
    const KEEP = 1,
          OVERWRITE = 2,
          RENAME = 3;

    public  $name="", 
            $policy=2, 
            $maxSize=-1, 
            $target="", 
            $nameField,
            $error=0;
    

    //$file se supone que es un String
    function __construct($fieldName) {
        $this->nameField = $fieldName;
        if (!is_string($fieldName) || !isset($_FILES[$fieldName])){
            $this->error = 8;
        }
    }

    function getError() {
        return $this->error;
    }

    //$name se supone que es un String
    function setName($name) {
        if (is_string($name)){
            $this->name = $name;
        }
        return $this;
    }

    //$policy se supone que es un Number
    function setPolicy($policy) {
        if (is_int($policy) && $policy >= 0 && $policy <=3){
            $this->policy = $policy;
        }
        return $this;
    }

    //$size se supone que es un Number
    function setSize($size) {
        if (is_numeric($size)){
            echo '<br> Es número <br>';
            $this->maxSize = $size;
        }
        return $this;
    }

    //$target se supone que es un String
    function setTarget($target) {
        if (is_string($target)){
            $this->target = (substr($target, -1) === '/') ? $target : $target . '/';
        }
        return $this;
    }

    function upload() {
        if($this->error === 0){
            if ($_FILES[$this->nameField]['name'] === ''){
                $this->error = 4;
            }else{
                $size = $_FILES[$this->nameField]['size'];
                echo '<br>Tamaño del archivo --> ' . $size . ' // Tamaño máximo --> ' . $this->maxSize . '<br>';
                if ($this->maxSize === -1 || $size <= $this->maxSize){
                    $this->checkPolicy();
                }else{
                    $this->error = 2;
                }
            }
        }
        return $this->error;
    }
    
    private function checkPolicy(){
        $file = ($this->name !== '') ? $this->name : $_FILES[$this->nameField]['name'];
        switch($this->policy){
            case $this::KEEP:
                if(file_exists($this->target . $file)){
                    return;
                }
            case $this::OVERWRITE:
                $this->saveFile($file);
                break;
            case $this::RENAME:
                if(file_exists($this->target . $file)){
                    $count = 1;
                    $saved = false;
                    while(!$saved){
                        $newName = $this->newName($file, $count);
                        if(!file_exists($this->target . $newName)){
                            $this->saveFile($newName);
                            $saved = true;
                        }
                        $count++;
                    }
                }else{
                    $this->saveFile($file);
                }
                break;
        }
    }
    
    private function saveFile($file){
        $response = move_uploaded_file($_FILES[$this->nameField]['tmp_name'], $this->target . $file);
        if ($response !== true){
            $this->error = 9;
        }
    }
    
    private function newName($name, $subname){
        $array = explode('.', $name);
        echo '<br>Nombre del archivo --> ' . $array[0] . '<br>';
        $array[0] = $array[0] . $subname;
        echo '<br>Nuevo nombre del archivo --> ' . $array[0] . '<br>';
        $cadena = implode('.', $array);
        echo $cadena;
        return $cadena;
    }
    
}

/*
$r = false;
if(isset($_FILES['archivo']) && $_FILES['archivo']['name'] !== '' && $_FILES['archivo']['error'] === 0) {
    $tipo = shell_exec('file --mime ' . $_FILES['archivo']['tmp_name']);
    $size = $_FILES['archivo']['size'];
    $destino = 'upload/' . $_POST['nombre'];
    if (strpos($tipo, 'image/') !== false && $size < 1024 * 1024 && file_exists($destino) === false) {
        $r = move_uploaded_file($_FILES['archivo']['tmp_name'], $destino);
    }
}
*/

/*
ERRORES FILE


    UPLOAD_ERR_OK, 0, no hay error
    UPLOAD_ERR_INI_SIZE, 1, tamaño del archivo excede upload_max_filesize
    UPLOAD_ERR_FORM_SIZE, 2, tamaño del archivo excede MAX_FILE_SIZE
    UPLOAD_ERR_PARTIAL, 3, archivo subido sólo parcialmente
    UPLOAD_ERR_NO_FILE, 4, no se ha subido archivo
    UPLOAD_ERR_NO_TMP_DIR, 5, no existe carpeta temporal
    UPLOAD_ERR_CANT_WRITE, 6, no se puede escribir en disco
    UPLOAD_ERR_EXTENSION, 7, alguna extensión de php ha impedido subir el archivo
    ERROR 8 --> NOMBRE DE ARCHIVO ERRONEO
    ERROR 9 --> ERROR AL GUARDAR EL ARCHIVO


*/