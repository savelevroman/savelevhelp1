<?php
include 'temp/head.php';
include 'temp/database.php';
        $id_category = $_GET['id_category'];
        $sql = "DELETE FROM category WHERE id_category = '$id_category'";
        $result=$mysqli->query($sql);
        var_dump($sql);
        header("location: addcategory.php");
?>