<?php

require 'classes/Autoload.php';


$db = new Database();

if ($db->connect()) {
    echo 'Conectado';
    
    $conexion = $db->getConnection();
    
    $sql = 'select * from producto';
    $sentencia = $conexion->prepare($sql);
    $resultado = $sentencia->execute();
} else {
    echo 'NO Conectado';
    exit();
}

$op = Reader::get('op');
if ($op !== null){
    $mensaje = '<h1>El resultado de la ' . $op . ' es ' . Reader::get('resultado') . '</h1>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=2.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript" src="./js/borrar.js" defer></script>
    <title>Tabla Producto</title>

    <style type="text/css">
        table, thead, tr, th, td { border: 2px solid gray; padding: 5px;}
    </style>
</head>
<body>
    <?= $mensaje ?>
    <table border="1" id="tablaProducto">
        <thead>
            <tr>
                <th><input type="checkbox"/></th>
                <th>Id</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Observaciones</th>
                <th>Borrar</th>
                <th>Editar</th>
                <th>Borrar2 Ficticio</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($fila = $sentencia->fetch() ) {
                    $producto = new Producto();
                    $producto->set($fila);
                    $nombre = urlencode($producto->getNombre()); //Hay que codificar las cadenas de texto para pasarlas como argumento Los números no hacen falta
                    ?>
                    <tr>
                        <td><input class="cbDelete" type="checkbox" name="ids[]" value="<?= $producto->getId() ?>" form="fBorrar"/></td>
                        <td><?php echo $producto->getId(); ?></td>
                        <td><?= $producto->getNombre() ?></td>
                        <td><?= $producto->getPrecio() ?></td>
                        <td><?= $producto->getObservaciones() ?></td>
                        <td ><a href="pagina13borrar.php?id=<?= $producto->getId() ?>" class='borrar'>Borrar</a></td>
                        <td ><a href="pagina13borrar.php" class='editar'>Editar</a></td>
                        <td ><a href="pagina13borrar.php?id=<?= $producto->getId() ?> &nombre=<?= $nombre ?>" class='borrar'>Borrar</a></td>
                    </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
    <form action="pagina13alta.php" method="POST">
        <input type="text" name="nombre" placeholder="nombre del producto"/>
        <input type="number" name="precio" placeholder="precio del producto"/>
        <textarea  name="observaciones" placeholder="observaciones sobre el producto"></textarea>
        <input type="submit" value="alta"/>
    </form>
    <form action="pagina13borrarV2.php" method="POST" name="fBorrar" id="fBorrar">
        <input type="submit" value="Borrar"/>
    </form>
</body>
</html>
<?php
$sentencia->closeCursor();