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

function createUser($kapcs, $username, $mail, $pass){
    $query = "INSERT INTO users (username,email,password) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($kapcs);
    if (!mysqli_stmt_prepare($stmt,$query)) {
        header("location: ../index.php?error=stmtFailed");
        exit();
    }

    $hashpass = password_hash($pass, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $username, $mail, $hashpass);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../login.php?success=signup");
    exit();
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

function nameExists($kapcs, $username){
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
        return $sor;   
    } else{
        return false;
    }

    mysqli_stmt_close($stmt);
}

function loginUser($kapcs, $username, $pass){
    $usernameExists = nameExists($kapcs, $username);

    if ($usernameExists === false) {
        header("location: ../login.php?error=wrongname");
        exit();
    }

    $checkPass = password_verify($pass, $usernameExists["password"]);

    if ($checkPass === false) {
        header("location: ../login.php?error=wrongpass");
        exit();
    }
    else {
        session_start();
        $_SESSION["username"] = $usernameExists["username"];
        $_SESSION["email"] = $usernameExists["email"];
        $_SESSION["address"] = $usernameExists["address"];
        $_SESSION["number"] = $usernameExists["phone_number"];
        header("location: ../index.php");
        exit();
    } 

}

function comparePass($kapcs, $username, $pass){
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_stmt_init($kapcs);
    if (!mysqli_stmt_prepare($stmt,$query)) {
        header("location: ../profile.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $sor = mysqli_fetch_assoc($result);
        $checkPass = password_verify($pass, $sor["password"]);
        
        if ($checkPass) {
            return $sor; 
        } else {
            return false;
        }
    } else {
        return false; 
    }

    mysqli_stmt_close($stmt);
}

function changePass($kapcs, $pass, $username) {
    $query = "UPDATE users SET password = ? WHERE username = ?";
    $stmt = mysqli_stmt_init($kapcs);
    if (!mysqli_stmt_prepare($stmt,$query)) {
        header("location: ../index.php?error=stmtFailed");
        exit();
    }

    $hashpass = password_hash($pass, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ss", $hashpass , $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../profile.php?success=passchange");
    exit();
}