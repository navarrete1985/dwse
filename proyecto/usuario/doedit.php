<?php

use izv\data\Usuario;
use izv\database\Database;
use izv\managedata\ManageUsuario;
use izv\tools\Reader;
use izv\tools\Util;
use izv\tools\Session;
use izv\tools\Mail;
use izv\app\App;

require '../classes/autoload.php';
$session = new Session(App::SESSION_NAME);
$user = $session->getLogin();
$result = '';

//Estas operaciones sólamente las pueden realizar usuarios activados
if (isset($user)) {
    $db = new Database();
    $manager = new ManageUsuario($db);
    $usuario = Reader::readObject('izv\data\Usuario');
    
    //En caso de que no seamos administrador, nos ponemos la id de usuario a modificar como 
    //la de la cuenta de la sesión, para evitar poder editar a otro usuario que no seamos nosotros
    if ($user->getAdministrador() == 0) {
        $usuario->setId($user->getId());
        $usuario->setActivo($user->getActivo());
        $usuario->setAdministrador($user->getAdministrador());
        //Si nos damos de baja permanente....borramos al usuario
        if (Reader::read('bajaPermanente') === '1') {
            header('Location: ../index.php?op=baja&resultado=' . $manager->remove($usuario->getId()));
            $session->logout();
            exit();
        }else if (Reader::read('bajaTemporal') === '1') {//Baja temporal...ponemos activo a 0
            $usuario->setActivo(0);
            $session->logout();
        }
    }
    
    //Si el email ha sido modificado....cambiamos el estado de usuario y mandamos mensaje de activación de cuenta
    $isEmailChanged = $manager->isEmailChanged($usuario);
    if ($manager->isEmailChanged($usuario)) {
        $usuario->setActivo(0);
        Mail::sendActivation($usuario);
    }
    
    if($usuario->getClave() === '') {
        $resultado = $manager->edit($usuario);
    } else {
        $usuario->setClave(Util::encriptar($usuario->getClave()));
        $resultado = $manager->editWithPassword($usuario);
    }
    $db->close();
    $result = '?op=edit&resultado=' . $resultado;
}

$url = Util::url() . '../index.php' . $result;
header('Location: ' . $url);