<?php

class Session {
    //constructor
    //get
    //set
    //destroy
    //getLogin
    //setLogin
    //logout
    //https://ide.c9.io/izvdamdaw/curso1819
    
    const LOGIN_KEY = 'login';
    
    function __construct(string $name) {
        if (!$this->__isSessionStarted()) {
            session_name($name);
            session_start();    
        }
    }
    
    function destroy() {
        session_destroy();
    }
    
    function get($key) {
        $result = null;
        if (isset($_SESSION[$key])){
            $result = $_SESSION[$key];
        }
        return $result;
    }
    
    function getLogin() {
        return $this->get(self::LOGIN_KEY);
    }
    
    function logout() {
        unset($_SESSION[self::LOGIN_KEY]);
    }
    
    function set(string $key, string $value) {
        $_SESSION[$key] = $value;
    }
    
    function setLogin(string $name) {
        session_regenerate_id(true);
        $this->set(self::LOGIN_KEY, $name);
    }
    
    private function __isSessionStarted() {
        return !session_status() === PHP_SESSION_NONE;
    }
    
}
