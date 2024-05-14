
<?php
/**
* Done
*
* @author Gioele Giunta
* @version 1.0
* @since 2023-05-14
* @info Me (Gioele) am going to use the SNAKE CASE for the php files
*/
    require_once __DIR__ . '/bootstrap.php';
    require_once __DIR__ . '/navbar.php';

    if(empty($_GET['fill'])){
        $fill = 'data';
    }else{
        $fill = $_GET['fill'];
    }

    if(empty($_GET['details'])){
        $details = '';
    }else{
        $details = $_GET['details'];
    }

    //Render view
    echo $twig->render('done.html', ['navbar_data' => $navbar_data, 'fill' => $fill, 'details' => $details]);

?>