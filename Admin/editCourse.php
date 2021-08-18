<?php 
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['is_admin_login'])){
    echo '<script> location.href="../index.php" </script>';
}


include('headerAdmin.php');
include('../dbConnection.php');

?>

<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Update Course Details</h3>
    <?php 
    if(isset($_REQUEST['edit'])){
        $sql = "SELECT * FROM course WHERE course_id = {$_REQUEST['id']}";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $course_img_bef = str_replace('./','../', $row['course_img']);
    }

    if(isset($_REQUEST['courseUpdateBtn'])){
        //Checking for empty fields
        if(($_REQUEST['course_name'])=="" || ($_REQUEST['course_desc'])=="" || ($_REQUEST['course_duration'])=="" 
        || ($_REQUEST['course_difficulty'])=="" || ($_REQUEST['course_category'])==""){
            $msg = '<div class="alert alert-warning mt-2 col-sm-6">Fill All Fields!!</div>';
        }else{
    
            $course_id = $_REQUEST['course_id'];
            $course_name = $_REQUEST['course_name'];
            $course_desc = trim($_REQUEST['course_desc']);
            $course_duration = $_REQUEST['course_duration'];
            $course_difficulty = $_REQUEST['course_difficulty'];
            $course_category = $_REQUEST['course_category'];
            if($_FILES['course_img']['name'] != ""){
                $course_img = $_FILES['course_img']['name'];
                $course_img_temp = $_FILES['course_img']['tmp_name'];
                $img_folder = '../image/courseimg/'.$course_img;
                move_uploaded_file($course_img_temp, $img_folder);
                $course_img_aft = str_replace('../','./', $img_folder);
            }
            
            
            if($_FILES['course_img']['name'] == ""){
                $sql = "UPDATE course SET course_name='$course_name', course_desc='$course_desc', course_duration='$course_duration',
                        course_difficulty='$course_difficulty', course_category='$course_category'
                        WHERE course_id=$course_id";
            }else{
                $sql = "UPDATE course SET course_name='$course_name', course_desc='$course_desc', course_duration='$course_duration',
                        course_difficulty='$course_difficulty', course_category='$course_category', course_img='$course_img_aft' 
                        WHERE course_id=$course_id";
            }
    
            if($conn->query($sql) == TRUE){
                $msg = '<div class="alert alert-success mt-2 col-sm-6">Course Updated Succesfully!!</div>';
                //echo "Query: " . $sql . "<br>";
            }else{
                $msg = '<div class="alert alert-danger mt-2 col-sm-6">Unable to update Course</div>';
                //echo "Error: " . $sql . "<br>" . $conn->error;
            }
    
        }
    }
    
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <?php if(isset($msg)){echo $msg;} ?>
        <div class="form-group">
            <label for="course_id">Course ID</label>
            <input type="text" class="form-control" id="course_id" name="course_id"
             value="<?php if(isset($row['course_id'])){ echo $row['course_id'];} ?>" readonly>
        </div>
        <div class="form-group">
            <label for="course_name">Course Name</label>
            <input type="text" class="form-control" id="course_name" name="course_name"
             value="<?php if(isset($row['course_name'])){ echo $row['course_name'];} ?>">
        </div>
        <div class="form-group">
            <label for="course_desc">Course Description</label>
            <textarea class="form-control" id="course_desc" name="course_desc" rows="2">
            <?php if(isset($row['course_desc'])){ echo trim($row['course_desc']," ");} ?></textarea>
        </div>
        <div class="form-group">
            <label for="course_duration">Course Duration</label>
            <input type="text" class="form-control" id="course_duration" name="course_duration"
            value="<?php if(isset($row['course_duration'])){ echo $row['course_duration'];} ?>">
        </div>
        <div class="form-group">
            <label for="course_difficulty">Course Difficulty</label>
            <input type="text" class="form-control" id="course_difficulty" name="course_difficulty"
            value="<?php if(isset($row['course_difficulty'])){ echo $row['course_difficulty'];} ?>">
        </div>
        <div class="form-group">
            <label for="course_category">Course Category</label>
            <input type="text" class="form-control" id="course_category" name="course_category"
            value="<?php if(isset($row['course_category'])){ echo $row['course_category'];} ?>">
        </div>
        <div class="form-group">
            <label for="course_img">Course Image</label>
            <img src="<?php if(isset($row['course_img'])){ echo $course_img_bef;} ?>" alt="course_img" class="img-thumbnail">
            <input type="file" class="form-control-file" id="course_img" name="course_img">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="courseUpdateBtn" name="courseUpdateBtn">Update</button>
            <a href="courses.php" class="btn btn-secondary">Close</a>
        </div>
        
    </form>
</div>

<?php 
include('footerAdmin.php');
?>