<?php

require 'classes/Autoload.php';

$fecha = Reader::read('fecha');
$fechahora = Reader::read('fechahora');
$marcatiempo = Reader::read('marcatiempo');

/*

//fechas y horas en MySql
//ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
//select curdate(), curtime(), current_timestamp(), now()
//insert into fecha values (null, curdate(), now(), null);

$fecha = '2018-10-31';
$fechahora = '2018-10-31 13:31:51';
$marcatiempo = '2018-10-31 13:13:13';

$fecha = '2018-10-31';
$fechahora = '2018-10-31';
$marcatiempo = null;
*/

if($fecha !== null) {
    $resultado = 0;
    $sql = 'insert into fecha values(null, :fecha, :fechahora, :marcatiempo)';
    $db = new Database();
    if($db->connect()) {
        $conexion = $db->getConnection();
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue('fecha', $fecha);
        $sentencia->bindValue('fechahora', $fechahora);
        $sentencia->bindValue('marcatiempo', $marcatiempo);
        if($sentencia->execute()) {
            $resultado = $conexion->lastInsertId();
        }
    }
    echo 'resultado: ' . $resultado;
} else {
    date_default_timezone_set('Europe/Madrid');
    $date = date('Y-m-d H:i:s');
    echo $date . '<br>';
    $date = date('Y/m/d H:i:s');
    echo $date . '<br>';
    $date = date('d/m/Y H:i:s');
    echo $date . '<br>';
    $date = new DateTime();
    echo $date->format('Y-m-d H:i:s') . '<br>';
    echo $date->format('d-m-Y H:i:s') . '<br>';
    ?>
    <form>
        <input type="text" name="fecha"/>
        <input type="text" name="fechahora"/>
        <input type="submit" value="send"/>
    </form>
    <form>
        <input type="date" name="fecha"/>
        <input type="datetime-local" name="fechahora"/>
        <input type="submit" value="send"/>
    </form>
    <?php
}