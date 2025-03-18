
<?php
session_start();
include('db.php');

if(isset($_POST['delete_all'])){
    // var_dump($_POST); // This will print the POST data to confirm the form submission

    $sql = "DELETE FROM contact_form";

    if($conn->query($sql)==TRUE){
        
      echo "All applicants have been delete successfully.";
        echo  "success";
        // var_dump($_SESSION); 
    } else{

      echo "Error deleting applications:" .$conn->error;
        echo  "danger";
        // var_dump($_SESSION); 
    }

    header("Location: admin-dashboard.php");
    exit;
}

$conn->close();
?>