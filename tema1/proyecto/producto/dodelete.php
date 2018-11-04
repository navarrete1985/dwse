<?php

require '../classes/autoload.php';

use izv\data\Producto;
use izv\database\Database;
use izv\managedata\ManageProducto;
use izv\tools\Reader;
use izv\tools\Util;

$db = new Database();
$manager = new ManageProducto($db);

$id = Reader::read('id');
$ids = Reader::readArray('ids');
if ($id !== null) {
    if (!is_numeric($id) || $id <= 0) {
        header('Location: index.php');
        exit();//Esto lo hacemos para que no se siga ejecutando el código
    }
    $resultado = $manager->remove($id);
}else {
    foreach($ids as $id) {
        $resultado += $manager->remove($id);
    }
}

$db->close();

$url = 'index.php?op=deleteproducto&resultado=' . $resultado;
echo $url;
header('Location: ' . $url);
// exit();
/*En caso de que hagamos un header y tengamos más instrucciones después hace falta que
en caso de que redireccionemos con el header hacer un exit(), para que no se siga haciendo lo de después*/

/*
RFC-> request for comments -> Especificaciones para seguir linea de trabajo
RFC para header -> Tenemos que enviar la ruta absoluta hacia la url que nos queremos trasladar.
No lo hacemos pero es el convenio
*/
