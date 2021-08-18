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

$sql = "SELECT * FROM user WHERE user_email='$stuLoginEmail'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$user_id = $row['user_id'];

if(isset($_REQUEST['submitFb'])){
    if(($_REQUEST['fb_title'])=="" || ($_REQUEST['fb_msg'])==""){
        $msg = '<div class="alert alert-warning mt-2 col-sm-6">Fill All Fields!!</div>';
    }else{
        $fb_title = $_REQUEST['fb_title'];
        $fb_msg = $_REQUEST['fb_msg'];
        $fb_time = date('Y-m-d');

        $sql= "INSERT INTO feedback(user_id, fb_title, fb_msg, fb_date) VALUES($user_id, '$fb_title', '$fb_msg', '$fb_time')";

        if($conn->query($sql) == TRUE){
            $msg = '<div class="alert alert-success mt-2 col-sm-6">Feedback Submitted Succesfully!!</div>';
            //echo "Query: " . $sql . "<br>";
        }else{
            $msg = '<div class="alert alert-danger mt-2 col-sm-6">Unable to submit feedback</div>';
            echo "Error: " . $sql . "<br>" . $conn->error;
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
                            if(isset($row['user_img']['name'])!='')
                            {
                                 echo $row['user_img'];
                            }else{
                                echo 'image/userimg/defaultuser.png';
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

<div class="col-sm-6 mt-5 mx-3">
<h3>My Feedback</h3>
<?php if(isset($msg)){echo $msg;} ?>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="fb_title">Title</label>
        <input type="text" class="form-control" id="fb_title" name="fb_title"
        value="<?php if(isset($row['fb_title'])){ echo $row['fb_title'];} ?>">
    </div>
    <div class="form-group">
        <label for="fb_msg">Feedback</label>
        <textarea class="form-control" id="fb_msg" name="fb_msg" rows="3">
        <?php if(isset($row['fb_msg'])){ echo trim($row['fb_msg']," ");} ?></textarea>
    </div>
    <div class="text-center">
            <button type="submit" class="btn btn-danger" id="submitFb" name="submitFb">Submit</button>
            <a href="courses.php" class="btn btn-secondary">Close</a>
    </div>
</form>
</div>

<?php
      include('maininclude/footer.php');
?>