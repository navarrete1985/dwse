<?php

require '../classes/autoload.php';

use izv\data\Producto;
use izv\database\Database;
use izv\managedata\ManageProducto;
use izv\tools\Reader;
use izv\tools\Util;

$db = new Database();
$manager = new ManageProducto($db);

$producto = Reader::readObject('izv\data\Producto');
echo Util::varDump($producto);

$resultado = $manager->add($producto);
$db->close();

$url = 'index.php?op=insertproducto&resultado=' . $resultado;
header('Location: ' . $url);
exit();
/*En caso de que hagamos un header y tengamos más instrucciones después hace falta que
en caso de que redireccionemos con el header hacer un exit(), para que no se siga haciendo lo de después*/

/*
RFC-> request for comments -> Especificaciones para seguir linea de trabajo
RFC para header -> Tenemos que enviar la ruta absoluta hacia la url que nos queremos trasladar.
No lo hacemos pero es el convenio
*/
