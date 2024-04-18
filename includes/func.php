<?php
function emptyInputSignup($username,$mail,$pass,$pass2){
    $result = false;
    if (empty($username) || empty($mail) || empty($pass) || empty($pass2)) {
        $result = true;
    } else{
        $result = false;
    }
    return $result;
}

function emptyInputLogin($username,$pass){
    $result = false;
    if (empty($username) || empty($pass)) {
        $result = true;
    } else{
        $result = false;
    }
    return $result;
}

function invalidEmail($mail){
    $result = false;
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else{
        $result = false;
    }
    return $result;
}

function passMatch($pass, $pass2){
    $result = false;
    if ($pass !== $pass2) {
        $result = true;
    } else{
        $result = false;
    }
    return $result;
}

/* function nameExists($kapcs, $username, $mail){
    $query = "SELECT * FROM felhasznalo WHERE username = ? OR email = ?;";
    $stmt = mysqli_stmt_init($kapcs);
    if (!mysqli_stmt_prepare($stmt,$query)) {
        header("location: ../index.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $mail);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($sor = mysqli_fetch_assoc($resultData)) {
        return $sor;   
    } else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
} */

/* function createUser($kapcs, $username, $mail, $pass){
    $query = "INSERT INTO felhasznalo (username,jelszo,email) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($kapcs);
    if (!mysqli_stmt_prepare($stmt,$query)) {
        header("location: ../index.php?error=stmtFailed");
        exit();
    }

    $hashpass = password_hash($pass, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $username, $hashpass, $mail);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../index.php?error=none");
    exit();
} */

/* function loginUser($kapcs, $username, $pass){
    $usernameExists = nameExists($kapcs, $username, $username);

    if ($usernameExists === false) {
        header("location: ../index.php?error=wrongname");
        exit();
    }

    $checkPass = password_verify($pass, $usernameExists["jelszo"]);

    if ($checkPass === false) {
        header("location: ../index.php?error=wrongpass");
        exit();
    }
    else if($checkPass === true){
        session_start();
        $_SESSION["username"] = $usernameExists["username"];
        header("location: ../main.php");
        exit();
    } 

} */