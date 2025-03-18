<?php
session_start();

    include('db.php');
    if(isset($_POST['delete'])){
        $check_sql = "SELECT COUNT(*) as count FROM contact_form WHERE created_at < NOW() - INTERVAL 3 MONTH";
        $result = mysqli_query($conn, $check_sql);
        $row = mysqli_fetch_assoc($result);

        if($row['count'] == 0){
            $_SESSION['deleteMessage'] = "No records older than 3 months to delete.";
            $_SESSION['msgType'] = "warning";
        }
        else{
        $sql =    "DELETE FROM contact_form WHERE created_at < NOW() - INTERVAL 3 MONTH";
       

        if(mysqli_query($conn,$sql)){
          $_SESSION['deleteMessage'] = "Old Applications Deleted Successfully";
          $_SESSION['msgType'] = "success";
        } else {
            $_SESSION['deleteMessage'] = "Error Deleteing Applications:" .mysqli_error($conn);
            $_SESSION['msgType'] = "danger";
        }
    }
}
    header('Location: admin-dashboard.php');
    exit;

?>