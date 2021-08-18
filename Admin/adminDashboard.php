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


<!-- Start Dashboard main content -->
<div class="col-sm-9 mt-5">
    <div class="row mx-5 text-center">
        <div class="col-sm-4 mt-5">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-header">
                    Courses
                </div>
                <div class="card-body">
                    <h4 class="card-title">
                    <?php 
                    $sql = "SELECT * FROM course";
                    $result = $conn->query($sql);
                    $row = $result->num_rows;
                    if($row > 0){
                        echo $row;
                    }else{
                        echo '-';
                    }
                    ?></h4>
                    <a href="courses.php" class="btn text-white">View</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mt-5">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header">
                    Registered Users
                </div>
                <div class="card-title">
                </div>
                <div class="card-body">
                    <h4 class="card-title">
                    <?php 
                    $sql = "SELECT * FROM user";
                    $result = $conn->query($sql);
                    $row = $result->num_rows;
                    if($row > 0){
                        echo $row;
                    }else{
                        echo '-';
                    }
                    ?></h4>
                    <a href="users.php" class="btn text-white">View</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mt-5">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-header">
                    Instructors
                </div>
                <div class="card-title">
                </div>
                <div class="card-body">
                    <h4 class="card-title">
                    <?php 
                    $sql = "SELECT * FROM instructor";
                    $result = $conn->query($sql);
                    $row = $result->num_rows;
                    if($row > 0){
                        echo $row;
                    }else{
                        echo '-';
                    }
                    ?></h4>
                    <a href="instructors.php" class="btn text-white">View</a>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-5 mt-5 text-center">
        <!-- Table  -->
        <p class="bg-dark text-white p-2">Course Enrolled</p>
        <?php
            $sql = "SELECT e.*, u.user_email 
                    FROM enrolls_in e, user u
                    WHERE e.user_id=u.user_id
                    ORDER BY e.start_date DESC
                    LIMIT 5;";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Course ID</th>
                    <th scope="col">User Email</th>
                    <th scope="col">Enroll Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = $result->fetch_assoc()){ 
                echo '<tr>';
                echo '<th scope=row>'.$row['course_id'].'</th>';
                echo '<td>'.$row['user_email'].'</td>';
                echo '<td>'.$row['start_date'].'</td>';
                echo '<td>
                        <form action="" method="POST" class="d-inline">
                            <input type="hidden" name="id" value='.$row['course_id'].'>
                            <button type="submit" class="btn btn-secondary" name="delete" value="Delete">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>';
                echo '</tr>';
            } ?>
        </table>
        <?php }else{
            echo "0 Results";
        }
        ?>
    </div>
</div>
<!-- End Dashboard main content  -->
        
<?php 
include('footerAdmin.php');
?>