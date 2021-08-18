<?php
include('maininclude/header.php');
include('dbConnection.php');

if(isset($_GET['course_id'])){
    $course_id = $_GET['course_id'];
    $sql = "SELECT *
            FROM specialization
            WHERE course_id=$course_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $specialization_name = $row['specialization_name'];
}
?>

<!-- Start image banner -->
<div class="container-fluid bg-dark">
        <div class="row">
            <img src="image/imgbanner.jpg" alt="image banner" style="height:500px; width:100%; object-fit:cover; box-shadow:10px;">
        </div>
</div>
<!-- End image banner  -->

<!-- Start main content -->
<div class="container mt-5">
<?php
    echo '<h3>Specialization: '.$row['specialization_name'].'</h3>';
    echo '<p class="bg-dark text-white p-2 text-center mt-5" style="border:1px solid; border-radius: 10px;">Courses under specialization</p>';
    $sql = "SELECT c.*, s.course_count
            FROM specialization s, course c
            WHERE s.specialization_name='$specialization_name'
            AND c.course_id=s.course_id
            ORDER BY s.course_count";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo '<div class="mt-1">
                    <div class="card bg-primary">';
            echo '<div class="row">
                  <div class="col-sm-4">';        
            echo      '<img class="card-img" src='.$row['course_img'].' alt="Deep Learning" />';
            echo '</div>';
            echo '<div class="col-sm-8">';
            echo      '<div class="card-body">';
            echo        '<h5 class="card-title text-white">'.$row['course_name'].'</h5>';
            echo        '<p class="card-text text-white">'.$row['course_desc'].'</p>
                      </div>';
            echo    '<div class="card-footer">';
            echo      '<span class="text-white">'.$row['course_difficulty'].'</span>';
            echo      '<a class="btn text-white font-weight-bolder float-right" href="coursedetails.php?course_id='.$row['course_id'].'">Enroll</a>
                    </div>
                  </div>
                </div>';
            echo '</div>';
            echo '</div>';
        }
    }
?>
</div>
<!-- End main content -->


<?php
    include('maininclude/footer.php');
?>
