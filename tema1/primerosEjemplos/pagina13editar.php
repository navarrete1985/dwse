<?php
require 'classes/Autoload.php';
//1º: comprobar si puedo hacerlo
$id = Reader::read('id');
//2º: validar el id: que ha llegado (!null) y que es numérico entero positivo
$db = new Database();
if($db->connect()) {
    $conexion = $db->getConnection();
    $sql = 'select * from producto where id = :id';
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindValue('id', $id);
    $resultado = $sentencia->execute();
    if($fila = $sentencia->fetch()) {
        $producto = new Producto();
        $producto->set($fila);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        <form action="pagina13editarV2.php" method="post">
            <input type="hidden" name="id" value="<?= $producto->getId() ?>" />
            <input type="text" name="nombre" id="nombre" placeholder="nombre del producto" value="<?= $producto->getNombre() ?>" />
            <input type="number" step="0.001" name="precio" id="precio" placeholder="precio del producto" value= "<?= $producto->getPrecio() ?>"/>
            <textarea name="observaciones" id="observaciones" placeholder="observaciones sobre el producto"><?= $producto->getObservaciones() ?></textarea>
            <input type="submit" value="editar"/>
        </form>
    </body>
</html>