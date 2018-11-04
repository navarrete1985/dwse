<?php
require 'classes/Autoload.php';
require 'classes/vendor/autoload.php';

use \Firebase\JWT\JWT;

$login = Reader::read('login');
$clave = 'clave de encriptación';

if($login !== null) {
    $password = Reader::read('password');
    $remember = Reader::read('remember');
    if($remember !== null) {
        setcookie('login', $login, time() + 60 * 60 * 24 * 31);
        $jwt = JWT::encode($password, $clave);
        setcookie('password', $jwt, time() + 60 * 60 * 24 * 31);
    } else {
        setcookie('login', '', time() - 60 * 60 * 24 * 31);
        setcookie('password', '', time() - 60 * 60 * 24 * 31);
    }
    header('Location: pagina16.php');
    exit();
}
$loginCookie = '';
$passwordCookie = '';
if(isset($_COOKIE['login']) && isset($_COOKIE['password'])) {
    $loginCookie = $_COOKIE['login'];
    $passwordCookie = $_COOKIE['password'];
    $passwordCookie = JWT::decode($passwordCookie, $clave, array('HS256'));
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        <form method="post">
            <input type="text"     name="login"    required placeholder="username" value="<?= $loginCookie ?>" />
            <input type="password" name="password" required placeholder="password" value="<?= $passwordCookie ?>" />
            recordar <input type="checkbox" name="remember" />
            <input type="submit" value="Submit"/>
        </form>    
    </body>
</html>