<?php

namespace izvdwes\tools;

class Tools {
    
    static function print($any) {
        echo self::varDump($any);
    }
    
    static function varDump($any) {
        return '<pre>' . var_export($any, true) . '</pre>';
    }
    
}