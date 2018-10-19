<?php

class Util {
    static function varDump($value) {
        return '<pre>' . var_export($value, true) . '</pre>';
    }
}