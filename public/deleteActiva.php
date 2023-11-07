<?php

    if ($_GET) {
        $id = $_GET['id'];
        require_once "../managers/activaManager.php";
        activaManager::delActiva($id);
        header("location: activa.php");
    } else {
        header("location: activa.php");
    }

?>