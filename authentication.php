<?php
session_start();
include('db.php');
$_SESSION['authenticationMessage']= "";
$_SESSION['authenticationMsgType'] = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Get Form Data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate if fields are empty
    if(empty($email) || empty($password)){
        $_SESSION['authenticationMessage'] = "Please fill in both fields";
        $_SESSION['authenticationMsgType'] = "danger";
        header("Location: index.php");
        exit;
    }

    // Sanitize the user input (to prevent SQL injection)
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // SQL query to select user by email
    $sql = "SELECT * FROM users WHERE email = '$email'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if user exists
    if($result && mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if(password_verify($password, $user['password'])){
            // Store user data in session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            // var_dump($_SESSION);
            // Redirect to the admin dashboard
            header("Location: admin-dashboard.php");
            exit;
        } else {
            $_SESSION['authenticationMessage'] = "Invalid Email or Password";
            $_SESSION['authenticationMsgType'] = "danger";
            header("Location: index.php");
            exit;
        }
    } else {
        $_SESSION['authenticationMessage'] = "No user found with that email";
        $_SESSION['authenticationMsgType'] = "danger";
        header("Location: index.php");
        exit;
    }
}
?>