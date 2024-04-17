<?php
/* require('kapcs.inc.php');
require('func.inc.php'); */

if (isset($_POST['login'])) {

    $email = $_POST["email"];
    $pass = $_POST["pass"];

/*     if (emptyInputLogin($email,$pass) !== false) {
        header("location: ../index.php?error=emptyinput");
        exit();
    }

    loginUser($kapcs, $email, $pass); */
}
else {
    header("location: ../index.php");
    exit();
}
