<?php
session_start();
require("dbconnect.php");

if (isset($_POST["data"])) {
    $address = $_POST["address"];
    $number = $_POST["number"];

    $query = "UPDATE users SET address = ?, phone_number = ? WHERE username = '".$_SESSION["username"]."'";
    $stmt = mysqli_stmt_init($kapcs);
    if (!mysqli_stmt_prepare($stmt,$query)) {
        header("location: ../index.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $address , $number);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../profile.php?success=datachange");
    exit();
}