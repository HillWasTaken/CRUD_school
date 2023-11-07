<?php
    if($_GET) {
        require_once "../managers/inkomstenManager.php";
        $id = $_GET['id'];
        inkomstenManager::delInkomsten($id);
        header("location: inkomsten.php");
    }else {
        header("location: inkomsten.php");
    }
?>