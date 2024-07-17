<?php
    require "query-class.php";

    if(!isset($_GET['id']) || empty($_GET['id'])){
        header('location: ../index.php');
    } 
    $id = $_GET['id'];

    $com = new editDado();
    $com->completed($id);
?>