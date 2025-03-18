<?php
session_start();
include('db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <style>
          input, textarea, select, button {
            border: none !important; 
            outline: none !important;
        }

        /* Add a custom focus style if needed, for example, a subtle shadow or background color change */
        input:focus, 
        textarea:focus, 
        select:focus, 
        button:focus {
            box-shadow: none !important;
            border-bottom: 2px solid black !important;
            
        }
        .form-control {
            border-radius: 0 !important;
            background-color: #e1c9a642;
            border-bottom: 2px solid black !important;
        }

        .form-container {
            height: 95vh;
            display: flex;
            justify-content: center;
            align-items: center;
            

        }
    </style>
</head>
<body style="background-color: #E1CAA6;">
    <div class="container ">
    <?php
        if(isset($_SESSION['registerMessage'])){
            $registerMessage = $_SESSION['registerMessage'];
            $registerMessageType = $_SESSION['registerMessageType'];
            
            $alertClassRegister = ($registerMessageType == "success") ? "alert-success" : "alert-danger";

            // Echo the alert HTML for the session message
            echo "
                <div class='alert $alertClassRegister' id='registerMessage'>
                    $registerMessage
                </div>
            ";

            // Pass session variables to JavaScript for handling
            echo "<script>
                var registerMessage = '$registerMessage';
                var registerMessageType = '$registerMessageType';
            </script>";

            // Clear the session messages after displaying
            unset($_SESSION['registerMessage']);
            unset($_SESSION['registerMessageType']);
        }
    ?>


        <div class="form-container">
            <form class="border p-5" action="./insert-new-user.php" method="POST" style="background-color: #FFFFFF; box-shadow: 0 4px 10px #000000;">
                            <div class="text-center mb-4">
                                <img src="./logo2.png" alt="logo" class="img-fluid">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" required>
                            </div>

                            <div class="mb-3 text-center">
                                <button type="submit" name="register" class="btn btn-primary">Register</button>
                            </div>
            </form>
        </div>
    </div>

    
     <!-- Script file -->
     <script src="script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>