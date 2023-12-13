<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balon</title>
</head>

<?php
session_start();

$routes = array(
    'home' => 'home.php',
    'termins' => 'termini.php',
    'scheduling' => 'zakazivanje.php',
    'login' => 'login.php',
    'admin' => 'admin.php'
);

if (!isset($_SESSION['user_id'])) {
    $page = 'login';
} else {
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
}
   
if (array_key_exists($page, $routes)) {
    $content = $routes[$page];
} else {
    $content = 'error.php';
}

if ($content == 'login.php') {
    include '../view/login.php';
} else {
    include '../view/header.php';
    include "../view/$content";
}

?>


</html>