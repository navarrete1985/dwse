<?php

class Session2 {

    const USER = '__user';

    //constructor
    function __construct($name = null) {
        if (session_status() === PHP_SESSION_NONE) {
            if ($name !== null) {
                session_name($name);
            }
            session_start();
        }
    }
    
    //get
    function get($name) {
        $v = null;
        if(isset($_SESSION[$name])) {
            $v = $_SESSION[$name];
        }
        return $v;
    }
    
    //set
    function set($name, $value) {
        $_SESSION[$name] = $value;
        return $this;
    }
    
    //destroy
    function destroy() {
        session_destroy();
    }
    
    //isLogged
    function isLogged() {
        return $this->getLogin() !== null;
    }
    
    function getLogin() {
        return $this->get(self::USER);
    }
    
    //login
    function login($user) {
        session_regenerate_id();
        return $this->set(self::USER, $user);
    }
    
    //logout
    function logout() {
        unset($_SESSION[self::USER]);
        return $this;
    }
    
}