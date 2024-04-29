<?php

// Load our autoloader
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/server/autoload.php';

// Specify our Twig templates location
$loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/templates');

// Instantiate our Twig. 
$twig = new \Twig\Environment($loader);

$connection = json_decode($db->connect(), true);

if (!$connection['status']) {    
    echo $twig->render('connerror.html');
    exit;
    //Error is in: $connection['message'];
}



?>