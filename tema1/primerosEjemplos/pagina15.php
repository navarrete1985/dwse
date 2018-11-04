<?php

//insert into fecha values (null, curdate(), now(), null);
//insert into fecha values (null, '2018-10-31', '2018-10-31 13:51:59', null);

?>
<form>
    <input type="text" name="fecha"/>
    <input type="text" name="fechahora"/>
    <input type="submit" value="Submit" name="f1"/>
</form>

<form>
    <input type="date" name="fecha"/>
    <input type="datetime-local" name="fechahora"/>
    <input type="submit" value="Submit" name="f2"/>
</form>

<form>
    <input type="submit" value="Submit" name="f3"/>
</form>

<?php

require 'classes/Autoload.php';

$fecha = Reader::read('fecha');
$fechahora = Reader::read('fechahora');

$f1 = Reader::read('f1');
$f2 = Reader::read('f2');
$f3 = Reader::read('f3');

if($f1 !== null) {
    date_default_timezone_set('Europe/Madrid');
    $fecha = str_replace('/', '-', $fecha);
    $fecha = date('Y-m-d', strtotime($fecha));
    $fechahora = str_replace('/', '-', $fechahora);
    $fechahora = date('Y-m-d H:i:s', strtotime($fechahora));
    $sql = 'insert into fecha values (null, :fecha, :fechahora, null)';
    $db = new Database();
    if($db->connect()) {
        $conexion = $db->getConnection();
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue('fecha', $fecha);
        $sentencia->bindValue('fechahora', $fechahora);
        if($sentencia->execute()) {
            $resultado = $conexion->lastInsertId();
        }
    }
    echo 'resultado: ' . $resultado;
} else if($f2 !== null) {
    $sql = 'insert into fecha values (null, :fecha, :fechahora, null)';
    $db = new Database();
    if($db->connect()) {
        $conexion = $db->getConnection();
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue('fecha', $fecha);
        $sentencia->bindValue('fechahora', $fechahora);
        if($sentencia->execute()) {
            $resultado = $conexion->lastInsertId();
        }
    }
    echo 'resultado: ' . $resultado;
} else if($f3 !== null){
    $sql = 'insert into fecha values (null, :fecha, :fechahora, null)';
    $db = new Database();
    if($db->connect()) {
        date_default_timezone_set('Europe/Madrid');
        $conexion = $db->getConnection();
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue('fecha', date('Y-m-d'));
        date_default_timezone_set('Europe/Madrid');
        $sentencia->bindValue('fechahora', date('Y-m-d H:i:s'));
        if($sentencia->execute()) {
            $resultado = $conexion->lastInsertId();
        }
    }
    echo 'resultado: ' . $resultado;
}

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
