<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include('config.php');

$id = $_GET['id'];
$conn->query("DELETE FROM appointments WHERE id=$id");
header("Location: dashboard.php");
?>
