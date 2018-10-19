<?php

require 'classes/Autoload.php';

//1º Comprobar si se puede hacer las insercciones o los cambios

$producto = Reader::readObject('Producto');

//2º Validar el producto (Ver si los datos que me han llegado de ese producto cumple todos las restricciones que nosotros ponemos)
//ej: precio que sea un número, positivo, .... etc

$sql = 'insert into producto values (null, :nombre, :precio, :observaciones)';

$db = new Database();
$resultado = 0;

if($db->connect()){
    $conexion = $db->getConnection();

    $sentencia = $conexion->prepare($sql);
    $sentencia->bindValue('nombre', $producto->getNombre());
    $sentencia->bindValue('precio', $producto->getPrecio());
    $sentencia->bindValue('observaciones', $producto->getObservaciones());
    if($sentencia->execute()) {
        $resultado = $conexion->lastInsertId();
    }else {
        echo Util::varDump($sentencia->errorInfo());
    }
}

$url = 'pagina13.php?op=insertproducto&resultado=' . $resultado;
//No debemos de quedarnos en la página para evitar que al refrescar insertemos más datos de la cuenta
//Al irnos a la página le mandamos el resultado por los parametros que le pasemos
header('Location: ' . $url);

//Para sacar cuando no estemos en producción los errores hacemos lo de abajo
?>

<!--<a href="<?= $url ?>">seguir</a>-->

