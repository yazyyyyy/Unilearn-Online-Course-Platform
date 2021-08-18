<?php 
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['is_admin_login'])){
    echo '<script> location.href="../index.php" </script>';
}


include('headerAdmin.php');
include('../dbConnection.php');


if(isset($_REQUEST['instructorSubmitBtn'])){
    //Checking for empty fields
    if(($_REQUEST['instructor_name'])=="" || ($_REQUEST['course_id'])=="" || ($_REQUEST['experience'])==""){
        $msg = '<div class="alert alert-warning mt-2 col-sm-6">Fill All Fields!!</div>';
    }else{

        $instructor_name = $_REQUEST['instructor_name'];
        $course_id = $_REQUEST['course_id'];
        $experience = $_REQUEST['experience'];
        $instructor_img = $_FILES['instructor_img']['name'];
        $instructor_img_temp = $_FILES['instructor_img']['tmp_name'];
        $img_folder = '../image/instructorimg/'.$instructor_img;
        move_uploaded_file($instructor_img_temp, $img_folder);

        $sql = "INSERT INTO instructor(instructor_name, course_id, experience, instructor_img) 
        VALUES('$instructor_name', '$course_id', '$experience', '$img_folder')";

        if($conn->query($sql) == TRUE){
            $msg = '<div class="alert alert-success mt-2 col-sm-6">instructor Added Succesfully!!</div>';
        }else{
            $msg = '<div class="alert alert-danger mt-2 col-sm-6">Unable to add instructor</div>';
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }
}

?>

<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Add new instructor</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="instructor_name">Instructor Name</label>
            <input type="text" class="form-control" id="instructor_name" name="instructor_name">
        </div>
        <div class="form-group">
            <label for="course_id">Course ID <small>(for course taught by instructor)</small></label>
            <input type="text" class="form-control" id="course_id" name="course_id">
        </div>
        <div class="form-group">
            <label for="experience">Instructor Experience</label>
            <input type="text" class="form-control" id="experience" name="experience">
        </div>
        <div class="form-group">
            <label for="instructor_img">instructor Image</label>
            <input type="file" class="form-control-file" id="instructor_img" name="instructor_img">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="instructorSubmitBtn" name="instructorSubmitBtn">Submit</button>
            <a href="instructors.php" class="btn btn-secondary">Close</a>
        </div>
        <?php if(isset($msg)){echo $msg;} ?>
    </form>
</div>

<?php 
include('footerAdmin.php');
?>