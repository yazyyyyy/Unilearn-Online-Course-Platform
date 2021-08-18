<?php
if(!isset($_SESSION)){
    session_start();
}
include_once("../dbConnection.php");

//Admin Login Verification
if(!isset($_SESSION['is_admin_login'])){
    if(isset($_POST['adminlogincheck']) && isset($_POST['adminLoginEmail']) && isset($_POST['adminLoginPassword'])){
        $adminLoginEmail = $_POST['adminLoginEmail'];
        $adminLoginPassword = $_POST['adminLoginPassword'];
    
        $sql = "SELECT admin_email, admin_pass FROM admin WHERE admin_email = '".$adminLoginEmail."' AND admin_pass = '".$adminLoginPassword."'";
    
        $result = $conn->query($sql);
    
        $row = $result->num_rows;
        if($row === 1){
            echo json_encode($row);
            $_SESSION['is_admin_login'] = true;
            $_SESSION['adminLoginEmail'] = $adminLoginEmail;
        }else if($row === 0){
            echo json_encode($row);
        }
    }
}
?>