<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form enctype="multipart/form-data" method="post" action="pagina1.php">
        <input type="text" name="nombre" placeholder="nombre" required/>
        <input type="file" name="archivo" required/>
        <input type="submit" value="Submit"/>
    </form>
    <img src="read.php?archivo=chefs.png"/>
    <img src="data:image/gif;base64,<?php echo base64_encode(file_get_contents('../../../../privado/chefs.png'));?>">
</body>
</html>
<!--Envio de archivos-->