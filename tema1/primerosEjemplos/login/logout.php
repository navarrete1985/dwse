<?php

session_name('DWES_SESSION');
session_start();
session_destroy();
header('Location: index.php');
exit();