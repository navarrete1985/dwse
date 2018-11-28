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

$carrito = $sesion->get('carrito');
if($carrito === null) {
    echo 'carrito está vacío';
} else {
    echo '<table border="1">';
    foreach($carrito as $item) {
        ?>
        <tr>
            <td>
                <?= $item->getId() ?>
            </td>
            <td>
                <?= $item->getNombre() ?>
            </td>
            <td>
                <?= $item->getPrecio() ?>
            </td>
            <td>
                <?= $item->getCantidad() ?>
            </td>
            <td>
                <?= $item->getCantidad() * $item->getPrecio() ?>
            </td>
            <td>
                <a href="">borrar</a>
                <a href="">-</a>
                <a href="">+</a>
            </td>
        </tr>
        <?php
    }
    echo '</table>';
}