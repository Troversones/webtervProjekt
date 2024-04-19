<?php
require('func.php');
require('dbconnect.php');

if (isset($_POST['login'])) {

    $username = $_POST["name"];
    $pass = $_POST["pwd"];

    if (emptyInputLogin($username,$pass)) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginUser($kapcs, $username, $pass);
}
else {
    header("location: ../index.php");
    exit();
}
