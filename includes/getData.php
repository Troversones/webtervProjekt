<?php
function getEmail($kapcs, $username){
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_stmt_init($kapcs);
    if (!mysqli_stmt_prepare($stmt,$query)) {
        header("location: ../index.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($sor = mysqli_fetch_assoc($resultData)) {
        return $sor["email"];   
    } else{
        return false;
    }

    mysqli_stmt_close($stmt);
}

function getAddress($kapcs, $username){
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_stmt_init($kapcs);
    if (!mysqli_stmt_prepare($stmt,$query)) {
        header("location: ../index.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($sor = mysqli_fetch_assoc($resultData)) {
        return $sor["address"];   
    } else{
        return false;
    }

    mysqli_stmt_close($stmt);
}

function getNumber($kapcs, $username){
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_stmt_init($kapcs);
    if (!mysqli_stmt_prepare($stmt,$query)) {
        header("location: ../index.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($sor = mysqli_fetch_assoc($resultData)) {
        return $sor["phone_number"];   
    } else{
        return false;
    }

    mysqli_stmt_close($stmt);
}