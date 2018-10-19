<?php

require 'classes/Autoload.php';

//1º Comprobar si puedo hacerlo

$id = Reader::read('id');

//2º Validar el id: que ha llegado (!null) y que es numérico

$sql = 'delete from producto where id = :id';

$db = new Database();
$resultado = 0;

if($db->connect()){
    $conexion = $db->getConnection();

    $sentencia = $conexion->prepare($sql);
    $sentencia->bindValue('id', $id);
   
    if($sentencia->execute()) {
        $resultado = $sentencia->rowCount(); //Nos dice cuantas filas han sido borradas
    }else {
        echo Util::varDump($sentencia->errorInfo());
    }
}

$url = 'pagina13.php?op=deleteproducto&resultado=' . $resultado;
//No debemos de quedarnos en la página para evitar que al refrescar insertemos más datos de la cuenta
//Al irnos a la página le mandamos el resultado por los parametros que le pasemos
//header('Location: ' . $url);

//Para sacar cuando no estemos en producción los errores hacemos lo de abajo
?>

<a href="<?= $url ?>">seguir</a>

