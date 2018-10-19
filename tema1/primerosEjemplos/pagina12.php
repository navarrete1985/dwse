<?php

require 'classes/Autoload.php';

/*PDO permite crear sentencias preparadas con argumentos numerados*/

$servidor = 'localhost';
$baseDatos = 'nombrebd';
$usuario = 'usuariobd';
$clave = 'clavebd';

/*Conexión con la base de datos*/
try{
    $conexion = new PDO(
      'mysql:host=' . $servidor . ';dbname=' . $baseDatos,
      $usuario,
      $clave,
      array(
        PDO::ATTR_PERSISTENT => true,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8')
    );
    echo 'conectado<br>';
    
    // $sql = 'select * from producto';
    $sql = 'select "abc", id, nombre, precio, observaciones from producto';
    $sentencia = $conexion->prepare($sql);
    $resultado = $sentencia->execute(); //Nos devuelve un boolean para saber si se ha realizado bien la consulta
    
    while( $fila = $sentencia->fetch() ) {
        $producto1 = new Producto();
        $producto2 = new Producto();
        $producto1->set($fila);
        echo '<pre>' . var_export($producto1, true) . '</pre>';
        $producto2->fetch($fila, 1);
        echo '<pre>' . var_export($producto2, true) . '</pre>';
    }
    $sentencia->closeCursor(); 
    
    $conexion = null;
}catch(PDOException $e){
    echo $e->getmMessage();
}



/*Para cerrar la conexión $conexion = null*/
/*Las sentencias tienen que ser siempre sentencias preparadas, para evitar la inyección de código
Las sentencias que no estén preparadas están prohibidas
Las sentencias preparadas son:
    $sql = 'select * from tabla where id = :id';
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindValue('id', $valor);
    $sentencia->execute();

*/


//Listar productos select * from producto


