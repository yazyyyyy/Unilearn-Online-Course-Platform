<?php 
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['is_admin_login'])){
    echo '<script> location.href="../index.php" </script>';
}


include('headerAdmin.php');
include('../dbConnection.php');


if(isset($_REQUEST['courseSubmitBtn'])){
    //Checking for empty fields
    if(($_REQUEST['course_name'])=="" || ($_REQUEST['course_desc'])=="" || ($_REQUEST['course_duration'])=="" 
    || ($_REQUEST['course_difficulty'])=="" || ($_REQUEST['course_category'])==""){
        $msg = '<div class="alert alert-warning mt-2 col-sm-6">Fill All Fields!!</div>';
    }else{

        $course_name = $_REQUEST['course_name'];
        $course_desc = $_REQUEST['course_desc'];
        $course_duration = $_REQUEST['course_duration'];
        $course_difficulty = $_REQUEST['course_difficulty'];
        $course_category = $_REQUEST['course_category'];
        $course_img = $_FILES['course_img']['name'];
        $course_img_temp = $_FILES['course_img']['tmp_name'];
        $img_folder = '../image/courseimg/'.$course_img;
        move_uploaded_file($course_img_temp, $img_folder);
        $img_folder1= str_replace('../', './', $img_folder);

        $sql = "INSERT INTO course(course_name, course_desc, course_duration, course_difficulty, course_category, course_img) 
        VALUES('$course_name', '$course_desc', '$course_duration', '$course_difficulty', '$course_category', '$img_folder1')";

        if($conn->query($sql) == TRUE){
            $msg = '<div class="alert alert-success mt-2 col-sm-6">Course Added Succesfully!!</div>';
        }else{
            $msg = '<div class="alert alert-danger mt-2 col-sm-6">Unable to add Course</div>';
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }
}

?>

<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Add new course</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="course_name">Course Name</label>
            <input type="text" class="form-control" id="course_name" name="course_name">
        </div>
        <div class="form-group">
            <label for="course_desc">Course Description</label>
            <textarea class="form-control" id="course_desc" name="course_desc" rows="2"></textarea>
        </div>
        <div class="form-group">
            <label for="course_duration">Course Duration</label>
            <input type="text" class="form-control" id="course_duration" name="course_duration">
        </div>
        <div class="form-group">
            <label for="course_difficulty">Course Difficulty</label>
            <input type="text" class="form-control" id="course_difficulty" name="course_difficulty">
        </div>
        <div class="form-group">
            <label for="course_category">Course Category</label>
            <input type="text" class="form-control" id="course_category" name="course_category">
        </div>
        <div class="form-group">
            <label for="course_img">Course Image</label>
            <input type="file" class="form-control-file" id="course_img" name="course_img">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="courseSubmitBtn" name="courseSubmitBtn">Submit</button>
            <a href="courses.php" class="btn btn-secondary">Close</a>
        </div>
        <?php if(isset($msg)){echo $msg;} ?>
    </form>
</div>

<?php 
include('footerAdmin.php');
?>