<?php
function dbConnect($usertype, $connectionType = 'mysqli') {
    $host = 'localhost';
    $db = 'kjorns';
    if ($usertype  == 'read') {
        $user = 'kjorns';
        $pwd = '3UcjRGfuE';
    } elseif ($usertype == 'write') {
        $user = 'kjorns';
        $pwd = '3UcjRGfuE';
    } else {
        exit('Unrecognized user');
    }
    if ($connectionType == 'mysqli') {
        $conn = @ new mysqli($host, $user, $pwd, $db);
        if ($conn->connect_error) {
            exit($conn->connect_error);
        }
        $conn->set_charset('utf8mb4');
        return $conn;
    } else {
        try {
            return new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}