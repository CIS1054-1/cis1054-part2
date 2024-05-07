<?php

    require_once __DIR__ . '/bootstrap.php';
    require_once __DIR__ . '/navbar.php';
    require_once __DIR__ . '/foodslider.php';
    
    
    if(isset($_GET['id'])){
        $categoryId = $db-> quote($_GET['id']);

        $result = $db-> query("SELECT * FROM foods WHERE $categoryId=categories_ID");

        if($result &&  $result->num_rows > 0){
            $categoryId = trim($categoryId,"'");
            echo $twig->render('item.html', ['navbar_data' => $navbar_data, 'categories' => $categories, 'selectedCategories' => [$categoryId], 'menuItems' => $result]);
        }else{
            echo $twig->render('404.html');
        }
    }else{
        echo $twig->render('404.html');
    }