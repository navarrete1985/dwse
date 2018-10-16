<?php
/*
echo '<pre>' . var_export($_FILES, true) . '</pre>';
echo '<pre>' . var_export($_POST, true) . '</pre>';

//Si no hay ningún error a la hora de cargar el archivo...continuamos
$nombreArchivo = $_FILES['archivo']['tmp_name'];
$salida = shell_exec('file --mime ' . $nombreArchivo);
echo $nombreArchivo;
echo "<pre>$salida</pre>";
if ($_FILES['archivo']['error'] === 0){
    //Movemos el archivo que tenemos en temporal a donde estamos con el nombre del fichero que le pasamos
    move_uploaded_file($_FILES['archivo']['tmp_name'], 'upload/aqui');
}

//sacar el mimetype del archivo de verdad file --mime nombre_archivo

$salida = shell_exec('file --mime upload/aqui');
echo "<pre>$salida</pre>";
*/

//Realizado por el profesor (Tenemos en cuenta más errores)
// echo '<pre>' . var_export($_FILES, true) . '</pre>';

// echo '<pre>' . var_export($_POST, true) . '</pre>';

// $r = false;
// if(isset($_FILES['archivo']) && $_FILES['archivo']['name'] !== '' && $_FILES['archivo']['error'] === 0) {
//     $tipo = shell_exec('file --mime ' . $_FILES['archivo']['tmp_name']);
//     $size = $_FILES['archivo']['size'];
//     $destino = 'upload/' . $_POST['nombre'];
//     if (strpos($tipo, 'image/') !== false && $size < 1024 * 1024 && file_exists($destino) === false) {
//         $r = move_uploaded_file($_FILES['archivo']['tmp_name'], $destino);
//     }
// }
// echo '<pre>' . var_export($r, true) . '</pre>';

// require('../classes/Upload.php');

// $upload = new Upload('archivo');

// echo $upload->upload();

// $upload->setTarget('upload/')->setPolicy(Upload::RENAME);
// echo $upload->upload();

// echo $upload->setPolicy(Upload::KEEP)->upload();

// echo $upload->setName('miarchivonuevo')->upload();

// echo $upload->setTarget('upload')->setSize(5803)->upload();


require('../classes/Upload.php');
$archivo = new Upload('archivo');
$archivo->setPolicy(Upload::POLICY_KEEP);
$archivo->setTarget('./privado/');
$archivo->setTarget('../../../../privado/');
$r = $archivo->upload();

/*
.htaccess --> Para poner la politica de privacidad y no se tenga acceso a los archivos...directamente
desde na ruta a la carpeta.
Peor tenemos que tener en cuenta de que si que podemos acceder al archivo si sabemos la ruta al archivo en sí
En caso de que accedamos a la carpeta y tengamos un index.html....esto si que lo mostramos

Para realmente tener privacidad con nuestros datos, tenemos 2 opciones.
    - Guardar los archivos en nuestra base de datos
    . Guardar los archivos en directorios privado por debajo de workspace...para que así no se tenga acceso
*/


$tipo = shell_exec('whoamy');
echo $tipo;
