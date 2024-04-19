<?php
require("dbconnect.php");
session_start();

if (isset($_POST["newemail"])) {
    $query = "UPDATE users SET email = ? WHERE email = ?";
    $stmt = mysqli_stmt_init($kapcs);
    if (!mysqli_stmt_prepare($stmt,$query)) {
        header("location: ../index.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $_POST["email"] ,$_SESSION["email"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../profile.php?success=emailchange");
    exit();
}