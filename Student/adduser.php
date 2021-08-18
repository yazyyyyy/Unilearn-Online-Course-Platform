<?php
if(!isset($_SESSION)){
    session_start();
}
include_once("../dbConnection.php");

//Check if email already registered
if(isset($_POST['checkemail']) && isset($_POST['inputEmail'])){
    $inputEmail = $_POST['inputEmail'];
    $sql = "SELECT user_email FROM user WHERE user_email = '".$inputEmail."'";
    $result = $conn->query($sql);
    $row = $result->num_rows;
    echo json_encode($row);
}



//User Registration Verification
if(isset($_POST['userRegister']) && isset($_POST['inputName']) && isset($_POST['inputEmail']) && isset($_POST['inputPassword'])
 && isset($_POST['inputPhone']) && isset($_POST['inputAddress']) && isset($_POST['inputCollege']) && isset($_POST['inputDegree'])
 && isset($_POST['inputSem'])){

    $inputName = $_POST['inputName'];
    $inputEmail = $_POST['inputEmail'];
    $inputPassword = $_POST['inputPassword'];
    $inputPhone = $_POST['inputPhone'];
    $inputAddress = $_POST['inputAddress'];
    $inputCollege = $_POST['inputCollege'];
    $inputDegree = $_POST['inputDegree'];
    $inputSem = $_POST['inputSem'];

    $sql = "INSERT INTO user (user_name, user_email, user_pass, phone_no, address, college, degree, sem) VALUES ('$inputName', '$inputEmail', '$inputPassword', $inputPhone, '$inputAddress', '$inputCollege', '$inputDegree', '$inputSem')";

    if($conn->query($sql) == TRUE){
        // echo "New record created successfully";
        echo json_encode("OK");
    } else{
        // echo "Error: " . $sql . "<br>" . $conn->error;
        echo json_encode("Failed");
    }

 }

//User Login Verification
if(!isset($_SESSION['is_login'])){
    if(isset($_POST['stulogincheck']) && isset($_POST['stuLoginEmail']) && isset($_POST['stuLoginPassword'])){
        $stuLoginEmail = $_POST['stuLoginEmail'];
        $stuLoginPassword = $_POST['stuLoginPassword'];
    
        $sql = "SELECT user_email, user_pass FROM user WHERE user_email = '".$stuLoginEmail."' AND user_pass = '".$stuLoginPassword."'";
    
        $result = $conn->query($sql);
    
        $row = $result->num_rows;
        if($row === 1){
            echo json_encode($row);
            $_SESSION['is_login'] = true;
            $_SESSION['stuLoginEmail'] = $stuLoginEmail;
        }else if($row === 0){
            echo json_encode($row);
        }
    }
}


?>