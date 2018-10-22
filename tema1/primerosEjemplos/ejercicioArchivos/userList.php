<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="./styles.css" type="text/css" />
    </head>
    <body>
        <h1>Listado de Usuarios Registrados</h1>
        <hr>
        <ul>
            <?php
                require '../classes/Autoload.php';
                $basePath = '/home/ubuntu/private';
                $directories = glob($basePath . '/*' , GLOB_ONLYDIR);
                foreach ($directories as $fileInfo) {
                    $ficheros2 = scandir($fileInfo, 1);
                    $pathParts = explode('/', $fileInfo);
                    $userName = $pathParts[count($pathParts) - 1];
                    ?>
                        <li><a href="imagen.php?user= <?= $userName ?>&img=<?= $ficheros2[0] ?>"><?= $userName ?></a></li>
                    <?php
                }
            ?>
        </ul>
    </body>
</html>