<?php
require('func.php');

if (isset($_POST['login'])) {

    $email = $_POST["email"];
    $pass = $_POST["pwd"];

    if (emptyInputLogin($email,$pass) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    // loginUser($kapcs, $email, $pass);
}
else {
    header("location: ../index.php");
    exit();
}
