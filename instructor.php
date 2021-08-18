<?php
include('maininclude/header.php');
include('dbConnection.php');

if(isset($_GET['course_id'])){
    $course_id = $_GET['course_id'];
    $sql = "SELECT *
            FROM instructor
            WHERE course_id=$course_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $instructor_id = $row['instructor_id'];
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
    <div class="row">
        <div class="col-md-4">
            <?php
                if(isset($row['instructor_img']['name'])!='')
                {
                    echo '<img src="'.$row['instructor_img'].'" alt="instructor_img" class="img-thumbnail rounded-circle">';
                }else{
                    echo '<img src="'.'image/userimg/defaultuser.png'.'" alt="instructor_img" class="img-thumbnail rounded-circle">';
                }
                echo '</div>';
                echo '<div class="col-md-8">';
                echo '<div class="card-body">';
                    echo '<h3 class="card-title">'.$row['instructor_name'].'</h3>';
                    echo '<p class="card-text">Experience: '.$row['experience'].'</p>';
            ?>
            <p class="bg-dark text-white p-2 text-center" style="border:1px solid; border-radius: 10px;">Courses by Instructor</p>
            <?php
            $sql = "SELECT i.*, c.course_name 
                    FROM instructor i, course c
                    WHERE i.course_id = c.course_id
                    AND i.instructor_id = $instructor_id";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
            ?>
            <table class=table table-border table-hover>
            <thead>
                <tr>
                    <th scope="col">Course id.</th>
                    <th scope="col">Course Name</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = $result->fetch_assoc()){ 
                echo '<tr>';
                echo '<th scope=row>'.$row['course_id'].'</th>';
                echo '<td><a href="coursedetails.php?course_id='.$row['course_id'].'">'.$row['course_name'].'</a></td>';
                echo '</tr>';
            }
        }
            ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
</div>
<!-- End main content -->


<?php
    include('maininclude/footer.php');
?>
