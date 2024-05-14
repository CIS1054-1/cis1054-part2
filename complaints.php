<?php

    require_once __DIR__ ."/bootstrap.php";
    require_once __DIR__ ."/navbar.php";
    echo $twig->render('complaints.html' , ['navbar_data' => $navbar_data]);
?>
