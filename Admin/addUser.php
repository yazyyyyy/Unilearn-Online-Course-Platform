<?php 
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['is_admin_login'])){
    echo '<script> location.href="../index.php" </script>';
}


include('headerAdmin.php');
include('../dbConnection.php');


if(isset($_REQUEST['userSubmitBtn'])){
    //Checking for empty fields
    if(($_REQUEST['user_name'])=="" || ($_REQUEST['user_email'])=="" || ($_REQUEST['user_pass'])=="" 
    || ($_REQUEST['phone_no'])=="" || ($_REQUEST['address'])=="" || ($_REQUEST['college'])==""  
    || ($_REQUEST['degree'])==""  || ($_REQUEST['sem'])=="" ){
        $msg = '<div class="alert alert-warning mt-2 col-sm-6">Fill All Fields!!</div>';
    }else{

        $user_name = $_REQUEST['user_name'];
        $user_email = $_REQUEST['user_email'];
        $user_pass = $_REQUEST['user_pass'];
        $phone_no = $_REQUEST['phone_no'];
        $address = $_REQUEST['address'];
        $college = $_REQUEST['college'];
        $degree = $_REQUEST['degree'];
        $sem = $_REQUEST['sem'];
        $user_img = $_FILES['user_img']['name'];
        $user_img_temp = $_FILES['user_img']['tmp_name'];
        $img_folder = '../image/userimg/'.$user_img;
        move_uploaded_file($user_img_temp, $img_folder);

        $sql = "INSERT INTO user(user_name, user_email, user_pass, phone_no, address, college, degree, sem, user_img) 
        VALUES('$user_name', '$user_email', '$user_pass', '$phone_no', '$address', '$college', '$degree', '$sem', '$img_folder')";

        if($conn->query($sql) == TRUE){
            $msg = '<div class="alert alert-success mt-2 col-sm-6">user Added Succesfully!!</div>';
        }else{
            $msg = '<div class="alert alert-danger mt-2 col-sm-6">Unable to add user</div>';
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }
}

?>

<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Add new user</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="user_name">User Name</label>
            <input type="text" class="form-control" id="user_name" name="user_name">
        </div>
        <div class="form-group">
            <label for="user_email">User Email</label>
            <input type="text" class="form-control" id="user_email" name="user_email">
        </div>
        <div class="form-group">
            <label for="user_pass">User Password</label>
            <input type="text" class="form-control" id="user_pass" name="user_pass">
        </div>
        <div class="form-group">
            <label for="phone_no">Phone No</label>
            <input type="text" class="form-control" id="phone_no" name="phone_no">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea class="form-control" id="address" name="address" rows="2"></textarea>
        </div>
        <div class="form-group">
            <label for="college">College</label>
            <input type="text" class="form-control" id="college" name="college">
        </div>
        <div class="form-group">
            <label for="degree">Degree</label>
            <input type="text" class="form-control" id="degree" name="degree">
        </div>
        <div class="form-group">
            <label for="sem">Semester</label>
            <input type="text" class="form-control" id="sem" name="sem">
        </div>
        <div class="form-group">
            <label for="user_img">User Image</label>
            <input type="file" class="form-control-file" id="user_img" name="user_img">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="userSubmitBtn" name="userSubmitBtn">Submit</button>
            <a href="users.php" class="btn btn-secondary">Close</a>
        </div>
        <?php if(isset($msg)){echo $msg;} ?>
    </form>
</div>

<?php 
include('footerAdmin.php');
?>