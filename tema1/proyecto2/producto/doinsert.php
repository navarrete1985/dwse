<?php

use izv\data\Producto;
use izv\database\Database;
use izv\managedata\ManageProducto;
use izv\tools\Reader;
use izv\tools\Util;
use izv\app\App;

require '../classes/autoload.php';

$db = new Database();
$manager = new ManageProducto($db);
$producto = Reader::readObject('izv\data\Producto');
$resultado = $manager->add($producto);
$db->close();
$url = Util::url() . 'index.php?op=insertproducto&resultado=' . $resultado;
header('Location: ' . $url);