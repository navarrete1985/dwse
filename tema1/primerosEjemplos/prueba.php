<?php 

require 'classes/Session.php';

$session = new Session('puto');

// $session->setLogin('Francisco Javier 22 22 222');
// $session->set('passwd', 'estoesotro 222');

echo $session->getLogin() . '<br>';
echo $session->get('passwd') . '<br>';

foreach( $_SESSION as $clave => $value) {
    echo $clave . ' -> ' . $value . '<br>';
}

echo '<pre>' . var_dump($_SESSION) . '</pre>';