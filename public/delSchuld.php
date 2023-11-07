<?php

    if($_GET) {
        require_once "../managers/schuldManager.php";
        $id = $_GET['id'];
        schuldManager::delSchuld($id);
        header("location: schuld.php");
    } else {
        header("location: schuld.php");
    }


?>