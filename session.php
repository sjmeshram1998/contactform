<?php
session_start();
// var_dump($_SESSION);
// Prevent page from being cached
// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


// Redirect to login if session is not set
if (!isset($_SESSION['user_id']) || !isset($_SESSION['email'])) {
    header("Location: index.php"); // Redirect to login page
    exit();
}
include('db.php');
?>
