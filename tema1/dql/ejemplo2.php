<?php

require 'classes/vendor/autoload.php';
require 'classes/Bootstrap2.php';
require 'classes/izv/data/Categoria.php';
require 'classes/izv/data/Destinatario.php';
require 'classes/izv/data/Detalle.php';
require 'classes/izv/data/Pedido.php';
require 'classes/izv/data/Usuario.php';
require 'classes/izv/data/Zapato.php';

$bs = new Bootstrap2();
$gestor = $bs->getEntityManager();

$destinatario = new \izv\data\Destinatario();
$destinatario->setNombre('niño');
$gestor->persist($destinatario);

$categoria = new \izv\data\Categoria();
$categoria->setNombre('deportivas');
$gestor->persist($categoria);

$usuario = new \izv\data\Usuario();
$usuario->setAlias('login');
$usuario->setApellidos('lópez');
$usuario->setClave(password_hash('undostres', PASSWORD_DEFAULT));
$usuario->setCorreo('login@gmail.com');
$usuario->setDireccion('granada');
$usuario->setNombre('pepe');
$gestor->persist($usuario);

$zapato = new \izv\data\Zapato();
$zapato->setCategoria($categoria);
$zapato->setDestinatario($destinatario);
$zapato->setMarca('adidas');
$zapato->setModelo('kids');
$zapato->setPrecio(38.87);
$zapato->setColor('blanco');
$zapato->setNumeroDesde(32);
$zapato->setNumeroHasta(39);
$zapato->setDisponible(1);
$zapato->setCubierta('sintético');
$zapato->setForro('lana');
$zapato->setSuela('cuero');
$gestor->persist($zapato);

$pedido = new \izv\data\Pedido();
$pedido->setUsuario($usuario);
$pedido->setTarjeta('1234432112344321');
$pedido->setFechavalidez('20/06');
$pedido->setCvv('919');
$gestor->persist($pedido);

$detalle = new \izv\data\Detalle();
$detalle->setPedido($pedido);
$detalle->setZapato($zapato);
$detalle->setNumero(36);
$detalle->setCantidad(1);
$detalle->setPrecio($zapato->getPrecio());
$gestor->persist($detalle);

$gestor->flush();

echo $destinatario->getId() . '<br>';
echo $categoria->getId() . '<br>';
echo $usuario->getId() . '<br>';
echo $zapato->getId() . '<br>';
echo $pedido->getId() . '<br>';
echo $detalle->getId() . '<br>';