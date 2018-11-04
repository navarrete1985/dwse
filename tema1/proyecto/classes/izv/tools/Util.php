<?php

namespace izv\tools;

class Util {
    
    static function url() {
        $url = "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $parts = pathinfo($url);
        return $parts['dirname'] . '/';
    }
    
    static function varDump($value) {
        return '<pre>' . var_export($value, true) . '</pre>';
    }
}