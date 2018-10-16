<?php

class Upload {
    
/*
Falta por hacer:
1. si un archivo no se sube por POLICY_KEEP se debe devolver un error para ello
   error = 3
2. el propio move_uploaded_file() puede fallar, por no tener permiso de escritura,
   porque no existe la ruta de destino, porque ya se ha movido, etc.
   error = 4
3. guardar el nombre con el que se ha guardado el archivo (POLICY_RENAME)

Resumen de errores:
1 - no existe el archivo que se va a subir
2 - el tamaño del archivo excede el máximo
3 - ya existe un archivo con ese nombre
4 - ha fallado move_uploaded_file()
5 - error en el mimetype
*/
    
    const POLICY_KEEP = 1,
          POLICY_OVERWRITE = 2,
          POLICY_RENAME = 3,
          MIN_OWN_ERROR = 1000;

    private $error=0,
            $file,
            $input,
            $maxSize = 0,
            $name,
            $policy= self::POLICY_OVERWRITE,
            $savedName = '',
            $target = './',
            $type;
    

    //$file se supone que es un String
    function __construct($input){
        $this->input = $input;
        if (isset($_FILES[$input]) && $_FILES[$input]['name'] != ''){
            $this->file =$_FILES[$input];
            $this->name = $this->file['name'];
        }else{
            $this->error = 8;   
        }
    }

    private function __doUpload(){
        $resul = false;
        switch($this->policy){
            case self::POLICY_KEEP:
                $result = $this->__doUploadKeep();
                break;
            case self::POLICY_OVERWRITE:
                $result = $this->__doUploadOverwrite();
                break;
            case self::POLICY_RENAME:
                $result = $this->__doUploadRename();
                break;
        }
        if (!$resul && $this->error === 0){
            $this->error = 4;
        }
        return $resul;
    }
    
    private function __doUploadKeep(){
        $resul = false;
        if (!file_exists($this->target . $this->name)){
            $result = move_uploaded_file($this->file['tmp_name'], $this->target . $this->name);
        }else{
            $this->error = 3;
        }
        return $resul;
    }
    
    private function __doUploadOverwrite(){
        return move_uploaded_file($this->file['tmp_name'], $this->target . $this->name);
    }
    
    private function __doUploadRename(){
        $newName = $this->target . $this->name;
        if (file_exists(newName)){
            $newName = self::__getValidName($newName);
        }
        $resul = move_uploaded_file($this->file['tmp_name'], $newName);
        if ($resul){
            $nombre = pathinfo($newName);
            $nombre = $newName['basename'];
            $this->savedName = $nombre;
        }
        return $result;
    }
    
    private static function __getValidName($file) {
        $parts = pathinfo($file);
        $extension = '';
        if(isset($parts['extension'])) {
            $extension = '.' . $parts['extension'];
        }
        $cont = 1;
        while(file_exists($parts['dirname'] . '/' . $parts['filename'] . $cont . '.' . $parts['extension'])) {
            $cont++;
        }
        return $parts['dirname'] . '/' . $parts['filename'] . $cont . '.' . $parts['extension'];
    }

    function getError() {
        $error = $this->error + self::MIN_OWN_ERROR;
        if ($error === self::MIN_OWN_ERROR){
            $error = $this->file['error'];
        }
    }

    /*
    Devuelve el nobre del archivo, el nombre con el que se va a guardar.
    $this->name
    Peor si tengo POLICY_NAME, es posible, que se haya guardado con un nombre diferente.
    */
    function getName(){
        $nombre = $this->savedName;
        if($nombre === ''){
            $nombre = $this->name;
        }
        return $nombre;
    }
    
    function getMaxSize(){
          return $this->maxSize;
    }

    function isValidSize(){
        return ($this->maxSize === 0 || $this->maxSize <= $this->file['size']);
    }

    function isValidType(){
        $valid = true;
        if($this->type !== ''){
            $tipo = shell_exec('file --mime' . $this->file['tmp_name']);
            $posicion = strpos($tipo, $this->type);
            if ($posicion === false){
                $valid = false;
                $this->error = 5;
            }
        }
        return $valid;
    }

    //$size se supone que es un Number
    function setMaxSize($size) {
        if (is_int($size) && $size > 0){
            $this->maxSize = $size;
        }
        return $this;
    }

    //$name se supone que es un String
    function setName($name) {
        if (is_string($name) && trim($name) !== ''){
            $this->name = $name;
        }
        return $this;
    }

    //$policy se supone que es un Number
    function setPolicy($policy) {
        if (is_int($policy) && $policy >= self::POLICY_KEEP && $policy <= self::POLICY_RENAME){
            $this->policy = $policy;
        }
        return $this;
    }

    //$target se supone que es un String
    function setTarget($target) {
        if (is_string($name) && trim($name) !== ''){
            $this->target = $target;
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
        if ($this->error !== 1 && $this['erro'] === 0){
            if ($this->isValidSize() && $this->isValidType()){
                $this->error = 0;
                $result = $this->__doUpload();
            }else if ($this->error !== 5){
                $this->error = 2;
            }
        }
        return $result;
    }
    
}
    
    

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