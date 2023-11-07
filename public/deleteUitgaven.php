<?php

    if($_GET) {
        require_once "../managers/uitgavenManager.php";
        $id = $_GET['id'];
        var_dump($id);
        uitgavenManager::delUitgaven($id);
        header("location: uitgaven.php");
    } else {
        header("location: uitgaven.php");
    }


?>