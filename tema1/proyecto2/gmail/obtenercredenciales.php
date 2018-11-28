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
// if (isset($_GET['code'])) {
//     $cliente->authenticate($_GET['code']);
//     $_SESSION['token'] = $cliente->getAccessToken();
//     $archivo = "token.conf";
//     $fh = fopen($archivo, 'w') or die("error");
//     fwrite($fh, json_encode($cliente->getAccessToken()));
//     fclose($fh);
//     header("Location: finalizartoken.php?code=" . $_GET['code']);
// }