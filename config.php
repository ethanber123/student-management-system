<?php
session_start();

$conn = new mysqli("localhost", "root", "", "sms_ultimate");

if ($conn->connect_error) {
    die("Database Error: " . $conn->connect_error);
}

function checkLogin(){
    if(!isset($_SESSION['admin'])){
        header("Location: login.php");
        exit();
    }
}
?>
