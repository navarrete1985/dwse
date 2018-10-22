<?php

require '../classes/Autoload.php';

$user = Reader::get('user');
$imgName = Reader::get('img');
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <img src="read.php?archivo=<?= $imgName ?>&user=<?= trim($user) ?>"/>
</body>
</html>