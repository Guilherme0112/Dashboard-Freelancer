<?php
    include "query-class.php";

    if(!isset($_GET['id']) || empty($_GET['id'])){
        header('location: ../index.php');
    } 
    $id = $_GET['id'];
    $del = new query();
    $del->delete($id);
?>  