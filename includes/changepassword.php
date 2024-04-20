<?php
session_start();
require("dbconnect.php");
require("func.php");

if (isset($_POST["newpwd"])) {
    $pass = $_POST["oldpwd"];
    $newpass = $_POST["pwd"];
    if (!comparePass($kapcs, $_SESSION["username"], $pass, $newpass)) {
        header("location: ../profile.php?error=oldpassnotmatches");
        exit();
    }

    changePass($kapcs, $newpass, $_SESSION["username"]);
}