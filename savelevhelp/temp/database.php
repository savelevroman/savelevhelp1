<?php
//выполним соединение с БД
$mysqli = new mysqli("localhost", "root", "", "savelev_help");
//установим кодировку БД
$mysqli->set_charset("utf8");
?>