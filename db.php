<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "contact_form_cms";

$conn = new mysqli($servername,$username,$password,$db_name);
    if($conn){
        echo "";
    }
    else{
        die();
    }
?>