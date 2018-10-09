<?php

require('classes/Producto.php');

$p = new Producto();
echo Producto::getContador() . '<br>';
$p = null;
echo Producto::getContador() . '<br>';