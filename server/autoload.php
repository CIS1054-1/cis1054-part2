<?php
/**
* autoload
*
* @author Gioele Giunta
* @version 1.0
* @since 2023-04-29
* @info Me (Gioele) am going to use the SNAKE CASE for the php files
*/
require_once __DIR__.'/database.php';
require_once __DIR__.'/session.php';
require_once __DIR__.'/cookies.php';

$db = new dbData();
$initialise_connection = json_decode($db->connect(), true);

if (!$initialise_connection['status']) {   
    echo $twig->render('connerror.html');
    exit;
    //Error is in: $initialise_connection['message'];
}

$cookies = new Cookies();
$session = new Session();

?>