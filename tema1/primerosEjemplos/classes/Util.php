<?php

class Util {
    static function varDump($value) {
        return '<pre>' . var_export($value, true) . '</pre>';
    }
    
    static function getDateFromMySqlToEs($mySqlDate) {
        date_default_timezone_set('Europe/Madrid');
        if ($mySqlDate === null) {
            return null;
        }
        return date("d/m/Y", strtotime($mySqlDate));
    }
    
    static function getDateHourFromMySqlToEs($mySqlDate) {
        date_default_timezone_set('Europe/Madrid');
        if ($mySqlDate === null) {
            return null;
        }
        return date("d/m/Y H:i:s", strtotime($mySqlDate));
    }
    
    static function setDateHourToMySql($date) {
        date_default_timezone_set('Europe/Madrid');
        $date = str_replace('/', '-', $date);
        return date('Y-m-d H:i:s', strtotime($date));
    }
    
    static function setDateToMySql($date) {
        date_default_timezone_set('Europe/Madrid');
        $date = str_replace('/', '-', $date);
        return date('Y-m-d', strtotime($date));
    }
}