<?php
session_start();
// Include your database connection
include('db.php');
$_SESSION['registerMessage'] = "";
$_SESSION['registerMessageType'] = "";

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get the form data (email and password)
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate the input (basic validation)
    if (empty($email) || empty($password)) {
       
       $_SESSION['registerMessage'] = "Please fill in all fields.";
       $_SESSION['registerMessageType'] = "danger";
       header("Location: register.php");
        exit;
    }

    else {
            // Sanitize user input to prevent SQL injection (only basic sanitization)
            $email = mysqli_real_escape_string($conn, $email); // Escape special characters in email
            $password = mysqli_real_escape_string($conn, $password); // Escape special characters in password
        
            // Check if the email already exists in the database
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
        
            if (mysqli_num_rows($result) > 0) {
                $_SESSION['registerMessage'] = "Email is already registered." ;
                $_SESSION['registerMessageType'] = "danger";
                header("Location: register.php");
                exit;
            }

            else {
                // Hash the password before storing it
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Insert the new user into the database
                $sql = "INSERT INTO users (email, password) VALUES ('$email', '$hashed_password')";

                if (mysqli_query($conn, $sql)) {
                  
                    $_SESSION['registerMessage'] = "Registration successful! You can now log in.";
                    $_SESSION['registerMessageType'] = "success";
                    header("Location: index.php");
                    // Optionally, redirect to the login page
                   
                    exit;
                } else {
                   
                    $_SESSION['registerMessage'] = "There was an error during registration.";
                    $_SESSION['registerMessageType'] = "danger";
                    header("Location: register.php");
                    exit;
                }
            }



    }

    
}
?>
