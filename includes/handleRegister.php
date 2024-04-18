<?php
require('func.php');

if (isset($_POST["signup"])) {
    
    $username =  $_POST["name"];
    $email = $_POST["email"];
    $pass = $_POST["pwd1"];
    $pass2 = $_POST["pwd2"];

    if (emptyInputSignup($username,$email,$pass,$pass2)) {
        header("location: ../register.php?error=emptyinput");
        exit();
    }
    
    if (invalidEmail($email)) {
        header("location: ../register.php?error=invalidmail");
        exit();
    }

    if (passMatch($pass,$pass2)) {
        header("location: ../register.php?error=passmatch");
        exit();
    }

    // if (emailExists($kapcs,$email)) {
    //     header("location: ../register.php?error=emailtaken");
    //     exit();
    // }

    // createUser($kapcs, $email, $username, $pass);
}
else{
    header("location: ../login.php");
    exit();
}