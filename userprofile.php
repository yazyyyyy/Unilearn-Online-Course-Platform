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

if(isset($_REQUEST['userUpdateBtn'])){
    //Checking for empty fields
    if(($_REQUEST['user_name'])=="" || ($_REQUEST['user_email'])=="" || ($_REQUEST['phone_no'])=="" 
    || ($_REQUEST['address'])=="" || ($_REQUEST['college'])=="" || ($_REQUEST['degree'])=="" || ($_REQUEST['sem'])==""){
        $msg = '<div class="alert alert-warning mt-2 col-sm-6">Fill All Fields!!</div>';
    }else{

        $user_name = $_REQUEST['user_name'];
        $user_email = $_REQUEST['user_email'];
        $phone_no = $_REQUEST['phone_no'];
        $address = trim($_REQUEST['address']);
        $college = $_REQUEST['college'];
        $degree = $_REQUEST['degree'];
        $sem = $_REQUEST['sem'];
        if($_FILES['user_img']['name'] != ""){
            $user_img = $_FILES['user_img']['name'];
            $user_img_temp = $_FILES['user_img']['tmp_name'];
            $img_folder = './image/userimg/'.$user_img;
            move_uploaded_file($user_img_temp, $img_folder);
        }
        // $timeStamp = date('Y/m/d H:i:s');

        if($_FILES['user_img']['name'] == ""){
            $sql = "UPDATE user SET user_name='$user_name', user_email='$user_email', phone_no='$phone_no',
                    address='$address', college='$college', degree='$degree', sem='$sem'
                    WHERE user_email='$stuLoginEmail'";
        }else{
            $sql = "UPDATE user SET user_name='$user_name', user_email='$user_email', phone_no='$phone_no',
                    address='$address', college='$college', degree='$degree', sem='$sem', user_img='$img_folder' 
                    WHERE user_email='$stuLoginEmail'";
        }

        if($conn->query($sql) == TRUE){
            $msg = '<div class="alert alert-success mt-2 col-sm-6">User Updated Succesfully!!</div>';
            //echo "Query: " . $sql . "<br>";
        }else{
            $msg = '<div class="alert alert-danger mt-2 col-sm-6">Unable to update user</div>';
            //echo "Error: " . $sql . "<br>" . $conn->error;
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

<div class="col-sm-6 mt-5 mx-3">
<h3>User Profile</h3>
<form action="" method="POST" enctype="multipart/form-data">
    <?php if(isset($msg)){echo $msg;} ?>
    <div class="form-group">
        <label for="user_name">Name</label>
        <input type="text" class="form-control" id="user_name" name="user_name"
        value="<?php if(isset($row['user_name'])){ echo $row['user_name'];} ?>">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="text" class="form-control" id="user_email" name="user_email"
        value="<?php if(isset($row['user_email'])){ echo $row['user_email'];} ?>" readonly>
    </div>
    <div class="form-group">
        <label for="phone_no">Phone No</label>
        <input type="text" class="form-control" id="phone_no" name="phone_no"
        value="<?php if(isset($row['phone_no'])){ echo $row['phone_no'];} ?>" readonly>
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <textarea class="form-control" id="address" name="address" rows="2">
        <?php if(isset($row['address'])){ echo trim($row['address']," ");} ?></textarea>
    </div>
    <div class="form-group">
        <label for="college">College</label>
        <input type="text" class="form-control" id="college" name="college"
        value="<?php if(isset($row['college'])){ echo $row['college'];} ?>">
    </div>
    <div class="form-group">
        <label for="degree">Degree</label>
        <input type="text" class="form-control" id="degree" name="degree"
        value="<?php if(isset($row['degree'])){ echo $row['degree'];} ?>">
    </div>
    <!-- <select class="form-select" aria-label="degreeSelect" id="inputDegree">
        <option selected value=""><?php //if(isset($row['degree'])){ echo $row['degree'];} ?></option>
        <option value="B.E/B.Tech">B.E/B.Tech</option>
        <option value="M.E/M.Tech">M.E/M.Tech</option>
        <option value="MBA">MBA</option>
    </select> -->
    <div class="form-group">
        <label for="sem">Semester</label>
        <input type="text" class="form-control" id="sem" name="sem"
        value="<?php if(isset($row['sem'])){ echo $row['sem'];} ?>" >
    </div>
    <!-- <select class="form-select" aria-label="semSelect" id="inputSem">
        <option selected value=""><?php //if(isset($row['sem'])){ echo $row['sem'];} ?></option>
        <option value="1">I</option>
        <option value="2">II</option>
        <option value="3">III</option>
        <option value="4">IV</option>
        <option value="5">V</option>
        <option value="6">VI</option>
        <option value="7">VII</option>
        <option value="8">VIII</option>
    </select> -->
    <div class="form-group">
        <label for="user_img">Profile Image</label>
        <input type="file" class="form-control-file" id="user_img" name="user_img">
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-danger" id="userUpdateBtn" name="userUpdateBtn">Update</button>
    </div>
    <div>
    <?php 
        if($row['modified_time']==""){
            echo '<span>Last modified: Never</span>';
        }else{
            echo '<span>Last modified: '.$row['modified_time'].'</span>';
        }   
    ?>
        <span></span>
    </div>
    
</form>
</div>

<?php
      include('maininclude/footer.php');
?>