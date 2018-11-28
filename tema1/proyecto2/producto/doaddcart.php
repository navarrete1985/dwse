<?php

use izv\app\App;
use izv\data\Item;
use izv\data\Producto;
use izv\database\Database;
use izv\managedata\ManageProducto;
use izv\tools\Carrito;
use izv\tools\Reader;
use izv\tools\Session;
use izv\tools\Util;

require '../classes/autoload.php';

$sesion = new Session(App::SESSION_NAME);
if(!$sesion->isLogged()) {
    header('Location: .');
    exit();
}

$id = Reader::read('id');

if($id === null || !is_numeric($id) ||  $id <= 0) {
    header('Location: .');
    exit();
}

$db = new Database();
$manager = new ManageProducto($db);
$producto = $manager->get($id);

echo Util::varDump($producto);

$item = new Item($producto->getId(), $producto->getNombre(), $producto->getObservaciones(), $producto->getPrecio(), 1);

echo Util::varDump($item);

$carrito = $sesion->get('carrito');
if($carrito === null) {
    $carrito = new Carrito();
}
$carrito->addItem($item);
$sesion->set('carrito', $carrito);
header('Location: index.php');