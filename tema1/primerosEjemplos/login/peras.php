<?php

require('../classes/Autoload.php');
$sesion = new Session2('DWES_SESSION');

/*session_name('DWES_SESSION');
session_start();
if(isset($_SESSION['peras'])) {
    $peras = $_SESSION['peras'] + 1;
    $_SESSION['peras'] = $peras;
} else {
    $_SESSION['peras'] = 1;
}*/

$peras = $sesion->get('peras');
if($peras === null) {
    $peras = 0;
}
$peras++;
$sesion->set('peras', $peras);

header('Location: index.php');