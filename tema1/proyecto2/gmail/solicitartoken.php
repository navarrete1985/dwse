// <?php

// session_start();
// require_once '../classes/vendor/autoload.php';
// $cliente = new Google_Client();
// $cliente->setApplicationName('CorreoWeb');
// $cliente->setClientId('123796518941-ptgju1jq1a68ll00ek7harhmn8jps1ee.apps.googleusercontent.com');
// $cliente->setClientSecret('eACBhPjTM7Vvjg_m3eXodfJO');
// $cliente->setRedirectUri('https://dwes-navarrete.c9users.io/tema1/proyecto/gmail/obtenercredenciales.php');
// $cliente->setScopes('https://www.googleapis.com/auth/gmail.compose');
// $cliente->setAccessType('offline');
// if (!$cliente->getAccessToken()) {
//     $auth = $cliente->createAuthUrl();
//     header("Location: $auth");
// }