<?php

use izv\data\Usuario;
use izv\database\Database;
use izv\managedata\ManageUsuario;
use izv\tools\Reader;
use izv\tools\Util;

require '../classes/autoload.php';

$id = Reader::read('id');

if ($id === null || !is_numeric($id) || $id <= 0) {
    header('Location: index.php');
    exit();
}

$database = new Database();
$manager = new ManageUsuario($database);
$usuario = $manager->get($id);
$database->close();

if ($usuario === null) {
    header('Location: index.php');
    exit();
}


?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>dwes</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/style.css" >
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="..">dwes</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="..">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../producto">Producto</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="./">Usuarios</a>
                    </li>
                </ul>
            </div>
        </nav>
        <main role="main">
            <div class="jumbotron">
                <div class="container">
                    <h4 class="display-4">Usuarios</h4>
                </div>
            </div>
            <div class="container">
                <div>
                    <form action="doedit.php" method="post">
                        <div class="form-group">
                            <label for="correo">Correo Electrónico</label>
                            <input value="<?= $usuario->getCorreo() ?>" required type="email" class="form-control" id="correo" name="correo" placeholder="Introduce correo electrónico del usuario">
                        </div>
                        <div class="form-group">
                            <label for="alias">Alias</label>
                            <input value="<?= $usuario->getAlias() ?>" required type="text" class="form-control" id="alias" name="alias" placeholder="Introduce alias del usuario" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre de usuario</label>
                            <input value="<?= $usuario->getNombre() ?>" required type="text" class="form-control" id="nombre" name="nombre" placeholder="Introduce nombre de usuario" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Clave de usuario</label>
                            <input value="<?= $usuario->getClave() ?>" required type="text" class="form-control" id="clave" name="clave" placeholder="Introduce clave de usuario" required>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="activo" name="activo" <?= ($usuario->getActivo() == 0) ? '' : 'checked' ?>>
                            <label class="form-check-label" for="activo">Usuario activo</label>
                        </div><br>
                        <input type="hidden" name="id" value="<?= $usuario->getId() ?>" />
                        <input type="hidden" name="fechaalta" value="<?= $usuario->getFechaalta() ?>" />
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </form>
                </div>
                <hr>
            </div>
        </main>
        <footer class="container">
            <p>&copy; IZV 2018</p>
        </footer>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="../js/script.js"></script>
    </body>
</html>