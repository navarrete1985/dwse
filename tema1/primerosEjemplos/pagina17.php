<?php

session_name('mi sesion php');
session_start();

echo 'Hola';
/*
Cómo ver el tiempo de vida de la sesión -> php.ini -> gc_maxlifetime (parámetro);
*/