
<?php
/**
* Index
*
* @author Gioele Giunta
* @version 1.0
* @since 2023-04-12
* @info Me (Gioele) am going to use the SNAKE CASE for the php files
*/
    require_once __DIR__ . '/bootstrap.php';
    require_once __DIR__ . '/navbar.php';
    require_once __DIR__ . '/foodslider.php';

    //Render view
    echo $twig->render('index.html', ['navbar_data' => $navbar_data, 'categories' => $categories, 'selectedCategories' => [], 'db' => $db]);

?>