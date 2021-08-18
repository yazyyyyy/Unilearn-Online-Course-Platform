<?php
ini_set('display_errors',0);
include('maininclude/header.php');
include('dbConnection.php');
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['is_login'])){
    
}else{
    $stuLoginEmail = $_SESSION['stuLoginEmail'];

    $sql = "SELECT * FROM user WHERE user_email='$stuLoginEmail'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $user_id = $row['user_id'];
}

    

    

?>

    <!-- Start image banner -->
    <div class="container-fluid bg-dark">
        <div class="row">
            <img src="image/imgbanner.jpg" alt="image banner" style="height:500px; width:100%; object-fit:cover; box-shadow:10px;">
        </div>
    </div>
    <!-- End image banner  -->

<!-- Start course content  -->
<?php
    if(isset($_GET['course_id'])){
      $course_id = $_GET['course_id'];
    //   $sql = "SELECT c.*, i.instructor_id, i.instructor_name
    //           FROM course c, instructor i
    //           WHERE c.course_id=$course_id
    //           AND i.course_id=c.course_id";
    $sql = "SELECT *
            FROM course
            WHERE course_id=$course_id";
    //         UNION
    //         SELECT i.instructor_id, i.instructor_name
    //         FROM course c, instructor i
    //         WHERE c.course_id=$course_id
    //         AND i.course_id=c.course_id";

      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
    }

    if(isset($_REQUEST['enroll'])){
        $date = date("Y-m-d");
        $sql = "INSERT INTO enrolls_in VALUES($course_id, $user_id, '$date')";
        if($conn->query($sql) == TRUE){
            $msg = '<div class="alert alert-success mt-2 col-sm-6">Enrolled in Course Succesfully!!</div>';
            //echo "Query: " . $sql . "<br>";
        }else{
            $msg = '<div class="alert alert-danger mt-2 col-sm-6">Unable to enroll in Course</div>';
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
  ?>
<!-- End course content  -->


<!-- Start main content -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
        <?php
            echo '<img src="'.$row['course_img'].'" alt="course image" class="card-img-top">';
            echo '</div>';
            echo '<div class="col-md-8">';
            echo '<div class="card-body">';
                echo '<h5 class="card-title">Course Name: '.$row['course_name'].'</h5>';
                echo '<p class="card-text">Description: '.$row['course_desc'].'</p>';
                echo '<p class="card-text">Duration: '.$row['course_duration'].'</p>';
                $sql2 = "SELECT instructor_id, instructor_name
                         FROM   instructor
                         WHERE  course_id=$course_id";
                $result2 = $conn->query($sql2);
                $row2 = $result2->fetch_assoc();  
                echo '<p class="card-text">Instructor: <a href="instructor.php?course_id='.$course_id.'">'
                    .$row2['instructor_name'].'</a></p>';
                $sql3 = "SELECT *
                         FROM   specialization
                         WHERE  course_id=$course_id";
                $result3 = $conn->query($sql3);
                $row3 = $result3->fetch_assoc();  
                echo '<p class="card-text">Specialization: <a href="specialization.php?course_id='.$course_id.'">'
                    .$row3['specialization_name'].'</a></p>';
                if(isset($_SESSION['is_login'])){
                    $sql = "SELECT course_id, user_id 
                            FROM enrolls_in 
                            WHERE course_id=$course_id
                            AND user_id=$user_id";
                    $result = $conn->query($sql);
                    if($result->num_rows == 0){
                        echo '<form action="" method="post">
                          <input type="hidden" name="id" value="'.$course_id.'">
                          <button type="submit" class="btn btn-primary text-white font-weight-bolder float-right" name="enroll">';
                        echo 'Enroll Now<br><small>Start Today</small></button>';
                        if(isset($msg)){echo $msg;}
                    }else{
                        echo '<a class="btn btn-primary text-white font-weight-bolder float-right" disabled>Enrolled</a>';
                    }
                    echo '</form>';
                }else{
                    echo '<button type="submit" class="btn btn-primary text-white font-weight-bolder float-right" data-toggle="modal" data-target="#registrationModal">';
                    echo 'Sign up<br><small>and Enroll</small></button>';
                }
                //...Start Stored procedure 
                $sql1 = "CALL countCourseEnroll('$course_id')";
                $result1 = $conn->query($sql1);
                $row1 = $result1->fetch_assoc();
                echo '<p class="float-right mr-2">No. of users enrolled: <strong>'.$row1['enrollCount'].'</strong></p>';
                //...End Stored Procedure
                ?>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <table class=table table-border table-hover>
            <thead>
                <tr>
                    <th scope="col">Lesson No.</th>
                    <th scope="col">Lesson Name</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Introduction</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- End main content -->


<?php
    include('maininclude/footer.php');
?>