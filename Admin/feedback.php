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
        <p class="bg-dark text-white p-2">List of Users</p>
        <?php
            $sql = "SELECT * FROM feedback";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">Feedback Title</th>
                    <th scope="col">Feedback Message</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = $result->fetch_assoc()){ 
                echo '<tr>';
                echo '<th scope=row>'.$row['user_id'].'</th>';
                echo '<td>'.$row['fb_title'].'</td>';
                echo '<td>'.$row['fb_msg'].'</td>';
                echo '<td>
                        <form action="" method="POST" class="d-inline">
                            <input type="hidden" name="fid" value='.$row['user_id'].'>
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
            $sql = "DELETE FROM feedback WHERE user_id = {$_REQUEST['fid']}";
            if($conn->query($sql)){
                echo '<meta http-equiv="refresh" content="0;URL=?deleted">';
            }else{
                echo 'Unable to delete row';
            }
        }
        
        ?>
    </div>
</div>


<?php 
include('footerAdmin.php');
?>