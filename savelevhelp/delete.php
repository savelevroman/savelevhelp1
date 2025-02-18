<?php
include 'temp/head.php';
include 'temp/database.php';
        $id_zayavki = $_GET['id_zayavki'];
        $sql = "DELETE FROM zayavki WHERE id_zayavki = '$id_zayavki'";
        $result=$mysqli->query($sql);
        var_dump($sql);
        header("location: lk.php");
?>