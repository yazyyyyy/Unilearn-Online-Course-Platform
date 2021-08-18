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
<div class="mx-5 mt-5 text-center">
        <!-- Table  -->
        <p class="bg-dark text-white p-2">Courses Enrolled</p>
        <?php

            $sql = "SELECT e.*, c.course_name 
            FROM course c, enrolls_in e 
            WHERE e.user_id=$user_id
            AND e.course_id=c.course_id";
            $result = $conn->query($sql);
        if($result->num_rows > 0){
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Course ID</th>
                    <th scope="col">Course Name</th>
                    <th scope="col">Enroll Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = $result->fetch_assoc()){ 
                echo '<th scope=row>'.$row['course_id'].'</th>';
                echo '<td><a href="coursedetails.php?course_id='.$row['course_id'].'">'.$row['course_name'].'</a></td>';
                echo '<td>'.$row['start_date'].'</td>';
                echo '<td>
                    <form action="" method="POST" class="d-inline">
                                <input type="hidden" name="un_id" value='.$row['course_id'].'>
                                <button type="submit" class="btn btn-secondary" name="unenroll" value="Uneroll">
                                    Unenroll
                                </button>
                            </form>
                    </td>
            </tbody>';
            }
            ?>
        </table>
        <?php }else{
            echo "0 Results";
        }
        
        //Delete Row
        if(isset($_REQUEST['unenroll'])){
            $sql = "DELETE FROM enrolls_in WHERE course_id = {$_REQUEST['un_id']} AND user_id=$user_id";
            if($conn->query($sql)){
                echo '<meta http-equiv="refresh" content="0;URL=?deleted">';
            }else{
                echo 'Unable to delete row';
            }
        }
        
        ?>
    </div>
</div>

<?php
      include('maininclude/footer.php');
?>