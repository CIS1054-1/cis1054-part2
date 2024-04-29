<?php
/**
* 404
*
* @author Gioele Giunta
* @version 1.0
* @since 2023-04-29
* @info Me (Gioele) am going to use the SNAKE CASE for the php files
*/
    require_once __DIR__ . '/bootstrap.php';

    //Render view
    echo $twig->render('404.html');

?>