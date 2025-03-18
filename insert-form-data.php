<?php
session_start();
include('db.php');
$fileMessage = '';
$formMessage = '';
$emailErrorMessage = '';
$errorMessage = '';

if (isset($_POST['submit'])) {
    // Check if the file was uploaded without errors
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] == 0) {
        // Get file information
        $fileTempPath = $_FILES['cv']['tmp_name'];
        $fileName = $_FILES['cv']['name'];
        $fileSize = $_FILES['cv']['size'];
        $fileType = $_FILES['cv']['type'];

        // Allowed file types
        $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        
        // Check if the file type is allowed
        if (in_array($fileType, $allowedTypes)) {
            // Generate a unique file name to avoid overwriting existing files
            $newFileName = uniqid() . '-' . $fileName;

            // Define the upload directory
            $uploadDir = 'uploads/';

            // Check if upload directory exists, if not create it
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Move the uploaded file to the desired directory
            if (move_uploaded_file($fileTempPath, $uploadDir . $newFileName)) {
                $fileMessage = "File uploaded successfully!";
            } else {
                $fileMessage = "Error in uploading the file!";
            }
        } else {
            $fileMessage = "Invalid file type. Only PDF, DOCX, and DOC files are allowed.";
            exit;
        }
    } 
    else {
        $fileMessage = "No file uploaded or there was an error during the upload.";
        exit;
    }

    // $_SESSION['fileMessage'] = $fileMessage;


    // Now handle form data
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $mobile_no = mysqli_real_escape_string($conn, $_POST['mobile_no']);
    $experience = mysqli_real_escape_string($conn, $_POST['experience']);
    $current_company_name = mysqli_real_escape_string($conn, $_POST['current_company_name']);
    $current_salary = mysqli_real_escape_string($conn, $_POST['current_salary']);
    $expected_salary = mysqli_real_escape_string($conn, $_POST['expected_salary']);
    $notice_period = mysqli_real_escape_string($conn, $_POST['notice_period']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $other_position = mysqli_real_escape_string($conn, $_POST['other_position']);
    $work_before = mysqli_real_escape_string($conn, $_POST['work_before']);
    $about_opportunity = mysqli_real_escape_string($conn, $_POST['about_opportunity']);
    $other_opportunity = mysqli_real_escape_string($conn, $_POST['other_opportunity']);
    $referral = mysqli_real_escape_string($conn, $_POST['referral']);
    $cv = $newFileName; // Use the uploaded file name

    // Check if email already exists

    $checkEmailQuery = "SELECT * FROM contact_form WHERE email = ?";
    $stmt = mysqli_prepare($conn, $checkEmailQuery);
    mysqli_stmt_bind_param($stmt,'s',$email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0){
        $emailErrorMessage = "This email is already registered you can not apply again... Try after 3 months";
        $_SESSION['emailErrorMessage'] = $emailErrorMessage;
        header("Location: application-form.php");
        exit;
    }
    // if (mysqli_num_rows($result) > 0) {
    //     // Email is already registered
    //     $emailErrorMessage = "This email is already registered, you cannot apply again.";
    //     $_SESSION['emailErrorMessage'] = $emailErrorMessage;
        
    //     // Redirect back to the form with the error message
    //     header("Location: application-form.php");
    //     exit;
    // }
 



    // Insert data into the database
    $sql = "INSERT INTO contact_form (email, date, fname, mobile_no, experience, current_company_name, current_salary, expected_salary, notice_period, position, other_position, work_before, about_opportunity, other_opportunity, referral, cv)
            VALUES ('$email', '$date', '$fname', '$mobile_no', '$experience', '$current_company_name', '$current_salary', '$expected_salary', '$notice_period', '$position', '$other_position', '$work_before', '$about_opportunity', '$other_opportunity', '$referral', '$cv')";

    if (mysqli_query($conn, $sql)) {
        // If the insert is successful
        // echo "Form Submitted Successfully";
        // Optionally redirect after success
        // header("Location: ./application-form.html");
        $formMessage = 'Form Submitted Successfully!! We Will Contact You';
    } else {
        $formMessage = 'Something went wrong. Please try again later.';
        
    }
    $_SESSION['formMessage'] = $formMessage;
    $_SESSION['errorMessage'] = $errorMessage;
    $_SESSION['emailErrorMessage'] = $emailErrorMessage;
    header("Location: application-form.php");
    exit;
}
?>
