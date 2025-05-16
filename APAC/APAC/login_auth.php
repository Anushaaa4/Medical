<?php
session_start();
include('config.php');

$username = $_POST['username'];
$password = md5($_POST['password']); // simple MD5 hash for demo

$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION['user'] = $username;
    header("Location: dashboard.php");
} else {
    echo "Invalid login.";
}
?>
