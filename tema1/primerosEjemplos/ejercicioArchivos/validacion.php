<?php

require '../classes/Autoload.php';

$responseUrl = './login.php?response=';
$privateDir = '/home/ubuntu/private/';

$name = Reader::post('name');
$file = new MultiUploadC('image');
$file->setType('jpeg');
$file->setTarget($privateDir . $name);

$responseValue = 'error';
if ($name !== null && createUserFile($name, $privateDir)) {
    if ($file->upload() === 1) {    
        $responseValue = 'success';
    }else {
        shell_exec('rm -r ' . $privateDir . $name);
    }
}

function createUserFile($name, $privateDir){
    $result = false;
    if (!file_exists($privateDir . $name)) {
        shell_exec('mkdir ' . $privateDir . $name);
        if (file_exists($privateDir . $name)) {
            $result = true;
        }
    }
    return $result;
}


header('Location: ' . $responseUrl . $responseValue);

