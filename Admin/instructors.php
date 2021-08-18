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

<div class="col-sm-9 mt-5">
<div class="mx-5 mt-5 text-center">
        <!-- Table  -->
        <p class="bg-dark text-white p-2">List of Instructors</p>
        <?php
            $sql = "SELECT i.*, c.course_name 
                    FROM instructor i, course c
                    WHERE i.course_id = c.course_id";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Instructor ID</th>
                    <th scope="col">Instructor Name</th>
                    <th scope="col">Course Name</th>
                    <th scope="col">Experience</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = $result->fetch_assoc()){ 
                echo '<tr>';
                echo '<th scope=row>'.$row['instructor_id'].'</th>';
                echo '<td>'.$row['instructor_name'].'</td>';
                echo '<td>'.$row['course_name'].'</td>';
                echo '<td>'.$row['experience'].'</td>';
                echo '<td>
                        <form action="editinstructor.php" method="POST" class="d-inline">
                            <input type="hidden" name="id" value='.$row['instructor_id'].'>
                            <button type="submit" class="btn btn-info" name="edit" value="Edit">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                        </form>
                        <form action="" method="POST" class="d-inline">
                            <input type="hidden" name="id" value='.$row['instructor_id'].'>
                            <button type="submit" class="btn btn-secondary" name="delete" value="Delete">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>';
                echo '</tr>';
            } ?>
            </tbody>
        </table>
        <?php }else{
            echo "0 Results";
        }
        
        //Delete Row
        if(isset($_REQUEST['delete'])){
            $sql = "DELETE FROM instructor WHERE instructor_id = {$_REQUEST['id']}";
            if($conn->query($sql)){
                echo '<meta http-equiv="refresh" content="0;URL=?deleted">';
            }else{
                echo 'Unable to delete row';
            }
        }
        
        ?>
    </div>
</div>

<div>
    <a href="addInstructor.php" class="btn btn-success box"><i class="fas fa-plus fa-2x"></i></a>
</div>

<?php 
include('footerAdmin.php');
?>