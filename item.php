<?php

    require_once __DIR__ .'database.php';
    require_once __DIR__ .'foodslider.php';
    
    $items = [
        [
            'id' => 1,
            'name' => 'Pizza Margharita',
            'image'=> 'pizza.jpg',
            'Category'=> 'Pizza',
            'price' => 10.99,
        ],
        [
            'id' => 2,
            'name' => 'Chicken Burger',
            'image'=> 'burger.jpg',
            'Category'=> 'Burgers',
            'price' => 13.99,
        ],
        [
            'id' => 3,
            'name' => 'Maki',
            'image'=> 'sushi.jpg',
            'Category'=> 'Sushi',
            'price' => 7.45,
        ],
        [
            'id' => 4,
            'name' => 'Paella Valenciana',
            'image'=> 'spanish.jpg',
            'Category'=> 'Spanish',
            'price' => 15.69,
        ]
    ]

    /*
    if(isset($_GET['id'])){
        $db = new Db();
        $categoryId = $db-> quote($_GET['id']);

        $result = $db-> select("SELECT i.*,c.name as type FROM item i inner join category c on i.type=c.id WHERE i.id=". $categoryId);

        if(count($result) > 0){
            $items = [
                'id'                => $result[0]['id'],
                'category'          => $result[0]['category'],
                'image'             => $result[0]['image'],
                'name'              => $result[0]['name'],
                'ingredientes'      => $result[0]['ingredients'],
                'price'             => $result[0]['price'],
            ];
            echo $twig->render('item.html', ['item' => $items, 'categories' => $categories]);
        }else{
            echo $twig->render('404.html');
        }
    }else{
        echo $twig->render('404.html');
    }
    */

?>