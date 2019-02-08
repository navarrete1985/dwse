<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Slim\App;

require '../../classes/vendor/autoload.php';

//Configuración para que nos muestre los errores (Esto lo utilizaremos en desarrollo, no en producción)
$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$app = new App($configuration);

//Se pueden definir varios middleware...Y se ejecutarían los dos cuando hacemos la petición
$app->add(function (Request $request, Response $response, Callable $next) {
    //pre
	$response->getBody()->write('BEFORE');//Aquí hacemos lo que queremos que se haga antes de que se ejecute la llamada
	//pre
	
	$response = $next($request, $response);//Hacemos la llamada a la ruta que queremos que se ejecute..
	
	//post
	$response->getBody()->write('AFTER');//Aquí hacemos los que queremos que se haga después de hacer la llamada a la api
	//post

	return $response;
});

//LAs reglas se tienen que definir en caso de que sean iguales, las fijas en principio y las que se sustituyen los valores
//Después para que sean accesibles....si no además nos dará error al ejecutar
$app->get('/hello/todos', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("Hello, todos");

    return $response;
});

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
});

$app->get('/adios/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Que te fucken, $name");

    return $response;
});

$app->get('/zapato/{idcategoria}/destinatario/{iddestinatario}', function (Request $request, Response $response, array $args) {
    $categoria = $args['idcategoria'];
    $destinatario = $args['iddestinatario'];
    $response->getBody()->write("Lista de zapatos de la categoría $categoria y de destinatario $destinatario");

    return $response;
});

$app->post('/hola/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Post, $name");

    return $response;
});

$app->run();