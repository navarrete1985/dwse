<?php

if (isset($_POST['nombre'], $_POST['usuario'], 
$_POST['ciudad'], $_POST['mail'], $_POST['repositorio'], 
$_POST['password'], $_POST['edad'], $_POST['observaciones'],
$_POST['genre'], $_FILES['imagen'], $_POST['color'])){

    $info = pathinfo($_FILES['imagen']['name']);
    //obtenemos la extensión de nuestra imagen
    $extension = $info['extension'];
    $nombreImagen = "imagen.".$extension; 
    $ruta = 'uploads/'.$nombreImagen;


    //Función encargada de guardar la imagen en nuestro directorio facilitado
    move_uploaded_file( $_FILES['imagen']['tmp_name'], $ruta);

    //Respuesta
    echo ('Datos obtenidos del formulario: <br>
        Nombre --> ' . $_POST['nombre'] . '<br>
        Usuario --> ' . $_POST['usuario'] . '<br>
        Email --> ' . $_POST['mail'] . '<br>
        Ciudad --> ' . $_POST['ciudad'] . '<br>
        Repositorio en github --> ' . $_POST['repositorio'] . '<br>
        Contraseña --> ' . $_POST['password'] . '<br>
        Edad --> ' . $_POST['edad'] . 'años<br>
        Observaciones --> ' . $_POST['observaciones'] . '<br>
        Género --> ' . $_POST['genre'] . "<br>
        Imagen --> <img src='$ruta' width='100'>" . '<br>
        Color --> ' . $_POST['color']);
        
} else {
    echo ('Los datos no se han validado de forma correcta!!!');
}
