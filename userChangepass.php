<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['is_login'])){
    echo '<script> location.href="index.php" </script>';
}else{
    $stuLoginEmail = $_SESSION['stuLoginEmail'];
}


include('maininclude/header.php');
include('dbConnection.php');

$sql = "SELECT * FROM user WHERE user_email = '$stuLoginEmail'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
echo $row['user_pass'];


$stuLoginEmail = $_SESSION['stuLoginEmail'];
if(isset($_REQUEST['passSubmitBtn'])){
    if(($_REQUEST['new_pass'])==""){
        $msg = '<div class="alert alert-warning mt-2 col-sm-6">Enter New Password</div>';
    }else{
        $exist_pass = ($_REQUEST['exist_pass']);
        $new_pass = ($_REQUEST['new_pass']);
        if($exist_pass == $new_pass){
            $msg = '<div class="alert alert-danger mt-2 col-sm-6">New Password cannot be same as old.</div>';
        }else{
            $sql = "UPDATE user SET user_pass='$new_pass' WHERE user_email = '$stuLoginEmail'";
            if($conn->query($sql) == TRUE){
                $msg = '<div class="alert alert-success mt-2 col-sm-6">Password Changed Succesfully!!</div>';
                //echo "Query: " . $sql . "<br>";
            }else{
                $msg = '<div class="alert alert-danger mt-2 col-sm-6">Unable to change password</div>';
                //echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }


    }
}


?>

<!-- Start Sidebar -->
<div class="container-fluid" style="height: 150px; background-color: #6610f2"></div>
    <div class="container-fluid mb-5">
        <div class="row">
            <nav class="col-sm-3 col-md-2 bg-light py-5 d-print-none">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li>
                        <img src="
                            <?php 
                            if(isset($row['user_img'])=='')
                            {
                                echo 'image/userimg/defaultuser.png';
                            }else{
                                echo $row['user_img'];
                            }
                            ?>" alt="user_img" class="img-thumbnail rounded-circle">
                        </li>
                        <li class="text-center"><?php echo $stuLoginEmail; ?></li>
                        <li class="nav-item mt-3">
                            <a href="userprofile.php" class="nav-link">
                                <i class="fas fa-user"></i>
                                Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="usercourse.php" class="nav-link">
                                <i class="fas fa-book"></i>
                                Courses Enrolled
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="userfeedback.php" class="nav-link">
                                <i class="fas fa-comment-dots"></i>
                                Feedback
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="userChangepass.php" class="nav-link">
                            <i class="fas fa-unlock-alt"></i>
                                Change Password
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
<!-- End sidebar -->

<div class="col-sm-9 mt-5">
    <div class="col-md-4 mx-5 mt-5">
    <p class="bg-dark text-white p-2 text-center" style="border:1px solid; border-radius: 10px;">Change user Password</p>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
                <label for="exist_pass">Existing Password</label>
                <input type="text" class="form-control" id="exist_pass" name="exist_pass" value="<?php echo $row['user_pass']; ?>" readonly>
        </div>
        <div class="form-group">
                <label for="new_pass">New Password</label>
                <input type="text" class="form-control" id="new_pass" name="new_pass">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="passSubmitBtn" name="passSubmitBtn">Change</button>
        </div>
        <?php if(isset($msg)){echo $msg;} ?>
    </form>
</div>
</div>

<?php
      include('maininclude/footer.php');
?>