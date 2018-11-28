<?php

require('../classes/Autoload.php');

$sesion = new Session2('DWES_SESSION');
$sesion->logout();

/*session_name('DWES_SESSION');
session_start();
session_destroy();*/

header('Location: index.php');