<?php

class Database {
    
    private $connection = null,
            $host,
            $user,
            $password,
            $database;
    
    function __construct($user = null, $password = null, $database = null, $host = 'localhost') {
        $this->user = $user;
        $this->host = $host;
        $this->password = $password;
        $this->database = $database;
        
        if ($user === null){
            $this->user = App::USER;
            $this->host = App::LOCALHOST;
            $this->password = App::PASSWORD;
            $this->database = App::DATABASE;    
        }
    }

    function close() {
        $this->connection = null;
    }

    function connect() {
        $result = false;
        try{
            $this->connection = new PDO(
              'mysql:host=' . $this->host . ';dbname=' . $this->database,
              $this->user,
              $this->password,
              array(
                PDO::ATTR_PERSISTENT => true,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8')
            );
            $result = true;
        }catch(PDOException $e){
            // echo 'error en conexion';
            //No es bueno sacar log...en caso que en depuración lo necesitemos lo descomentamos
            // echo '<pre>' . var_export($e, true) . '</pre>';
        }
        return $result;
    }

    function getHost() {
        return $this->host;
    }

    function getConnection() {
        return $this->connection;
    }

    function getUser() {
        return $this->user;
    }

    function getPassword() {
        return $this->password;
    }

    function getDatabase() {
        return $this->database;
    }

    function setHost($host) {
        $this->host = $host;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setDatabase($database) {
        $this->database = $database;
    }
    
}