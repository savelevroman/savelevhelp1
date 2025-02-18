<?php 
session_start();
$_SESSION['id_user'] = $userdata['id_user'];
$_SESSION['login'] = $userdata['login'];
$_SESSION['fio'] = $userdata['fio'];
$_SESSION['role'] = $userdata['role'];
unset($_SESSION['id_user']);
unset($_SESSION['login']);
unset($_SESSION['fio']);
unset($_SESSION['role']);
header("Location: index.php");
?>