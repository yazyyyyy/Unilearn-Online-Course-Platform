<?php 
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['is_admin_login'])){
    echo '<script> location.href="../index.php" </script>';
}


include('headerAdmin.php');
include('../dbConnection.php');


if(isset($_REQUEST['specializationSubmitBtn'])){
    //Checking for empty fields
    if(($_REQUEST['specialization_name'])=="" || ($_REQUEST['course_id'])=="" || ($_REQUEST['course_count'])==""){
        $msg = '<div class="alert alert-warning mt-2 col-sm-6">Fill All Fields!!</div>';
    }else{

        $specialization_name = $_REQUEST['specialization_name'];
        $course_id = $_REQUEST['course_id'];
        $course_count = $_REQUEST['course_count'];

        $sql = "INSERT INTO specialization(specialization_name, course_id, course_count) 
        VALUES('$specialization_name', '$course_id', '$course_count')";

        if($conn->query($sql) == TRUE){
            $msg = '<div class="alert alert-success mt-2 col-sm-6">Specialization Added Succesfully!!</div>';
        }else{
            $msg = '<div class="alert alert-danger mt-2 col-sm-6">Unable to add specialization</div>';
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }
}

?>

<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Add new specialization</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="specialization_name">Specialization Name</label>
            <input type="text" class="form-control" id="specialization_name" name="specialization_name">
        </div>
        <div class="form-group">
            <label for="course_id">Course ID <small>(for course under specialization)</small></label>
            <input type="text" class="form-control" id="course_id" name="course_id">
        </div>
        <div class="form-group">
            <label for="course_count">Course Index</label>
            <input type="text" class="form-control" id="course_count" name="course_count">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="specializationSubmitBtn" name="specializationSubmitBtn">Submit</button>
            <a href="specializations.php" class="btn btn-secondary">Close</a>
        </div>
        <?php if(isset($msg)){echo $msg;} ?>
    </form>
</div>

<?php 
include('footerAdmin.php');
?>