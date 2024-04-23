
<?php
/**
* Sign Up
*
* @author Gioele Giunta
* @version 1.0
* @since 2023-04-23
* @info Me (Gioele) am going to use the SNAKE CASE for the php files
*/
    require_once __DIR__ . '/bootstrap.php';
    require_once __DIR__ . '/navbar.php';

    //Render view
    echo $twig->render('signup.html', ['navbar_data' => $navbar_data]);

?>