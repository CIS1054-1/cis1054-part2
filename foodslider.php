<?php

    require_once __DIR__ .'/bootstrap.php';

    $result = $db->query("SELECT * from categories");

    if($result &&  $result->num_rows > 0){
        $categories = $result;
    }else{
        echo $twig->render('404.html');
    } 
?>
