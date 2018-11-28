<?php

require '../classes/autoload.php';

use izv\data\Usuario;
use izv\database\Database;
use izv\managedata\ManageUsuario;
use izv\tools\Reader;
use izv\tools\Alert;
use izv\tools\Util;

$db = new Database();
$manager = new ManageUsuario($db);
$usuarios = $manager->getAll();
$db->close();

$alert = Alert::getMessage(Reader::get('op'), Reader::get('resultado'));

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
        <!-- modal -->
        <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmación de borrado de usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Seguro que quiere borrar el usuario?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btConfirmDelete">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- fin modal -->
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
                    <li class="nav-item active">
                        <a class="nav-link" href="./">Usuario</a>
                    </li>
                </ul>
            </div>
        </nav>
        <main role="main">
            <div class="jumbotron">
                <div class="container">
                    <h4 class="display-4">Usuarios</h4>
                    <?= $alert ?>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <h3>Listado de usuarios</h3>
                </div>
                <table class="table table-striped table-hover" id="tablaUsuario">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll" /></th>
                            <th>Correo</th>
                            <th>Alias</th>
                            <th>Nombre</th>
                            <th>Activo</th>
                            <th>Fecha alta</th>
                            <th>Borrar</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($usuarios as $usuario) {
                                $nombre = urlencode($usuario->getNombre());
                                ?>
                                <tr >
                                    <td><input type="checkbox" name="ids[]"  value="<?= $usuario->getId() ?>" form="fBorrar" /></td>
                                    <td><?php echo $usuario->getCorreo(); ?></td>
                                    <td><?= $usuario->getAlias() ?></td>
                                    <td><?= $usuario->getNombre() ?></td>
                                    <td><?= $usuario->getActivo() ?></td>
                                    <td><?= Util::getDateFromMySqlToEs($usuario->getFechaalta()) ?></td>
                                    <td><a href="dodelete.php?id=<?= $usuario->getId() ?>" class = "borrar">Borrar</a></td>
                                    <td><a href="edit.php?id=<?= $usuario->getId() ?>">Editar</a></td>
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
                <div class="row">
                    <input class="btn btn-danger" type="button" value="borrar" data-toggle="modal" data-target="#confirm" />
                    &nbsp;
                    <a href="insert.php" class="btn btn-success">agregar usuario</a>
                </div>
                <form action="dodelete.php" method="post" name="fBorrar" id="fBorrar"></form>
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