<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="get" enctype="application/x-www-form-urlencoded" action="pagina3.php">
        <input type="text" name="nombre" placeholder="Pon aquí tu nombre" required/>
        <input type="submit" value="Submit"/>
    </form>
    <br>
    <form method="post" enctype="application/x-www-form-urlencode" action="pagina3.php">
        <input type="text" name="nombre" placeholder="Pon aquí tu nombre" required/>
        <input type="submit" value="Submit"/>
    </form>
    <br>
    <form method="post" enctype="multipart/form-data" action="pagina3.php">
        <input type="text" name="nombre" placeholder="Pon aquí tu nombre" required/>
        <input type="file" name="archivo" /> <!--Con esto podemos ver en el inspector como se pasan los archivos adjuntos, no sólamente String-->
        <input type="submit" value="Submit"/>
    </form>
    <hr>
    <a href="pagina3.php">enlace 1</a>
    <a href="pagina3.php?nombre=pepe">enlace 2</a>
    <?php
    $valor = urlencode('pepe % & lopez');
    ?>
    <a href="pagina3.php?nombre=<?= $valor ?>">enlace 3</a>
    <br>
</body>
</html>