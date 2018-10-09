<?php

require('classes/Reader.php');

$params = Reader::read('extra');
if($params !== null && is_array($params)){
    echo var_export($params, true);
}