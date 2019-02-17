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

/**
*   Método PUT
*/
// $app->put('/put/{nombre}', function (Request $request, Response $response, array $args) {
//     $name = $args['nombre'];
//     $response->getBody()->write("Put $name");
//     return $response;
// });

// /**
// *   Método DELETE
// */
// $app->delete('/delete/{nombre}', function (Request $request, Response $response, array $args) {
//     $name = $args['nombre'];
//     $response->getBody()->write("Post $name");
//     return $response;
// });

// $app->group('/zapato', function () use ($app) {
//     $app->get('/', function ($request, $response) {
//         return $response->getBody()->write(date('Y-m-d H:i:s'));
//     });
//     $app->get('/{id}', function ($request, $response) {
//         return $response->getBody()->write("grupo zapato id");
//     });
//     $app->get('/{idzapato}/categoria/{idcategoria}', function ($request, $response) {
//         return $response->getBody()->write("grupo zapato get id/cat/id");
//     });
//     $app->post('/', function ($request, $response) {
//         return $response->getBody()->write(time());
//     });
//     $app->put('/', function ($request, $response) {
//         return $response->getBody()->write(time());
//     });
//     $app->delete('/', function ($request, $response) {
//         return $response->getBody()->write(time());
//     });
// })->add(function (Request $request, Response $response, Callable $next) {
//     //pre
// 	$response->getBody()->write('BEFOREZAPATO');
// 	//pre
	
// 	$response = $next($request, $response);
	
// 	//post
// 	$response->getBody()->write('AFTERZAPATO');
// 	//post

// 	return $response;
// });



/*
multipart/form-data
*/
$app->post('/archivo', function (Request $request, Response $response, array $args) {
    $uploadedFiles = $request->getUploadedFiles();
    $uploadedFile = $uploadedFiles['file'];
    $data = [];
    if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
        $filename = moveUploadedFile('.', $uploadedFile);
        $data['filename'] = $filename;
        $data['file'] = base64_encode(file_get_contents($filename));
    }
    $newResponse = $response->withJson($data, 200);
    return $newResponse;
});

/*
post
https://curso1819-izvdamdaw.c9users.io/ejemplos/restslim/archivo2
{
  "valor": "112233",
  "archivo": "iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAHElEQVQI12P4//8/w38GIAXDIBKE0DHxgljNBAAO9TXL0Y4OHwAAAABJRU5ErkJggg=="
}
*/
$app->post('/archivo2', function (Request $request, Response $response, array $args) {
    $parsedBody = $request->getParsedBody();
    $valor = $parsedBody['valor'];
    $archivo = base64_decode($parsedBody['archivo']);
    file_put_contents('archivo', $archivo, LOCK_EX);
    $data = ['valor' => $valor];
    $newResponse = $response->withJson($data, 200);
    return $newResponse;
});

/*
3ª opción: Multipart/Related
https://stackoverflow.com/questions/4083702/posting-a-file-and-associated-data-to-a-restful-webservice-preferably-as-json
*/

$app->get('/cabeceras', function (Request $request, Response $response, array $args) {
    $headers = $request->getHeaders();
    $cabeceras = '';
    foreach ($headers as $name => $values) {
        $cabeceras .= $name . ": " . implode(", ", $values);
    }
    $cab = implode(', ', $request->getHeader('authorization'));
    $response->getBody()->write($cab);
    return $response;
});
$app->post('/cabeceras', function (Request $request, Response $response, array $args) {
    $headers = $request->getHeaders();
    $cabeceras = '';
    foreach ($headers as $name => $values) {
        $cabeceras .= $name . ": " . implode(", ", $values);
    }
    $cab = implode(', ', $request->getHeader('authorization'));
    $parsedBody = $request->getParsedBody();
    $calculado = $request->getAttribute('atributocalculado');
    $otro = $request->getAttribute('otro');
    $response->getBody()->write('hola: ' . $parsedBody['login'] . ' ' . $calculado . $otro);
    return $response;
});
$app->get('/hello/todos', function (Request $request, Response $response, array $args) {
    $gestor = $this->get('gestor');
    $usuario = $gestor->find('izv\data\Usuario', 1);
    $response->getBody()->write("Hello, a todos, de parte de " . $usuario->getNombre());
    return $response;
});
$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
});
$app->get('/hola/{nombre}', function (Request $request, Response $response, array $args) {
    $name = $args['nombre'];
    $response->getBody()->write("¿Qué tal, $name?");
    return $response;
});
$app->get('/zapato/categoria/{idcategoria}/destinatario/{iddestinatario}', function (Request $request, Response $response, array $args) {
    $idcategoria = $args['idcategoria'];
    $iddestinatario = $args['iddestinatario'];
    $response->getBody()->write("Lista de zapatos de la categoria $idcategoria y de destinatario $iddestinatario.");
    return $response;
});
$app->post('/hola/{nombre}', function (Request $request, Response $response, array $args) {
    $name = $args['nombre'];
    $response->getBody()->write("Post $name");
    return $response;
});
$app->put('/hola/{nombre}', function (Request $request, Response $response, array $args) {
    $name = $args['nombre'];
    $response->getBody()->write("Put $name");
    return $response;
});
$app->delete('/hola/{nombre}', function (Request $request, Response $response, array $args) {
    $name = $args['nombre'];
    $response->getBody()->write("Delete $name");
    return $response;
});


$app->group('/zapato', function () use ($app) {
    $app->get('/', function ($request, $response) {
        $response->getBody()->write("grupo zapato get");
    });
    $app->get('/{id}', function ($request, $response) {
        $response->getBody()->write("grupo zapato get id");
    });
    $app->get('/{idzapato}/categoria/{idcategoria}', function ($request, $response) {
        $response->getBody()->write("grupo zapato get id/cat/id");
    });
    $app->post('/', function ($request, $response) {
        $response->getBody()->write("grupo zapato post");
    });
    $app->put('/', function ($request, $response) {
        $response->getBody()->write("grupo zapato put");
    });
    $app->delete('/', function ($request, $response) {
        $response->getBody()->write("grupo zapato delete");
    });
})->add(function (Request $request, Response $response, Callable $next) {
    //pre
	//$response->getBody()->write('BEFOREZAPATO');
	//pre
	
	$response = $next($request, $response);
	
	//post
	//$response->getBody()->write('AFTERZAPATO');
	//post

	return $response;
});

function moveUploadedFile($directory, UploadedFile $uploadedFile) {
    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
    $filename = sprintf('%s.%0.8s', $basename, $extension);
    $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
    return $filename;
}



$app->run();