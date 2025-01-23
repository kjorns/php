<?php
use php\PhpSolutions\Authenticate\CheckPassword;

require_once __DIR__ . '/../../PhpSolutions/Authenticate/CheckPassword.php';
$usernameMinChars = 6;
$errors = [];
if (strlen($username) < $usernameMinChars) {
    $errors[] = "Username Must Be At Least $usernameMinChars Characters.";
}
if (preg_match('/\s/', $username)) {
    $errors[] = 'Username Should Not Contain Spaces.';
}
$checkPwd = new CheckPassword($password, 10);
$checkPwd->requireMixedCase();
$checkPwd->requireNumbers(2);
$checkPwd->requireSymbols();
$passwordOK = $checkPwd->check();
if (!$passwordOK) {
    $errors = array_merge($errors, $checkPwd->getErrors());
}
if ($password != $retyped) {
    $errors[] = "Your Passwords Don't Match.";
}
if (!$errors) {
    // encrypt password using default encryption
    $password = password_hash($password, PASSWORD_DEFAULT);
    // include the connection file
    require_once 'connection.php';
    $conn = dbConnect('write');
    // prepare SQL statement
    $sql = 'INSERT INTO php_fp_users (username, pwd) VALUES (?, ?)';
    $stmt = $conn->stmt_init();
    if ($stmt = $conn->prepare($sql)) {
        // bind parameters and insert the details into the database
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
    }
    if ($stmt->affected_rows == 1) {
        $success = "$username Has Been Registered. You May Now Log In.";
    } elseif ($stmt->errno == 1062) {
        $errors[] = "$username Is Already In Use. Please Choose Another Username.";
    } else {
        $errors[] = $stmt->error;
    }
}