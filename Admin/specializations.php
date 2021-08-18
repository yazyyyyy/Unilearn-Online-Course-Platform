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
        <p class="bg-dark text-white p-2">List of Specializations</p>
        <?php
            $sql = "SELECT s.*, c.course_name 
                    FROM specialization s, course c
                    WHERE s.course_id = c.course_id";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Specialization Name</th>
                    <th scope="col">Course Name</th>
                    <th scope="col">Course Number</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = $result->fetch_assoc()){ 
                echo '<tr>';
                echo '<td>'.$row['specialization_name'].'</td>';
                echo '<td>'.$row['course_name'].'</td>';
                echo '<td>'.$row['course_count'].'</td>';
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
            </tbody>
        </table>
        <?php }else{
            echo "0 Results";
        }
        
        //Delete Row
        if(isset($_REQUEST['delete'])){
            $sql = "DELETE FROM specialization WHERE course_id = {$_REQUEST['id']}";
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
    <a href="addSpecialization.php" class="btn btn-success box"><i class="fas fa-plus fa-2x"></i></a>
</div>

<?php 
include('footerAdmin.php');
?>