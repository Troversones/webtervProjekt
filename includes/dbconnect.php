<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "dnd";
global $kapcs;

$kapcs = mysqli_connect($host, $user, $pass, $db) or die("Hiba: " . mysqli_connect_error());
$kapcs->set_charset("utf8");
return $kapcs;
?>