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
            $sql = "SELECT * FROM user";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">User Name</th>
                    <th scope="col">User Email</th>
                    <th scope="col">Phone No.</th>
                    <th scope="col">College</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = $result->fetch_assoc()){ 
                echo '<tr>';
                echo '<th scope=row>'.$row['user_id'].'</th>';
                echo '<td>'.$row['user_name'].'</td>';
                echo '<td>'.$row['user_email'].'</td>';
                echo '<td>'.$row['phone_no'].'</td>';
                echo '<td>'.$row['college'].'</td>';
                echo '<td>
                        <form action="" method="POST" class="d-inline">
                            <input type="hidden" name="uid" value='.$row['user_id'].'>
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
            $sql = "DELETE FROM user WHERE user_id = {$_REQUEST['uid']}";
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
    <a href="addUser.php" class="btn btn-success box"><i class="fas fa-plus fa-2x"></i></a>
</div>

<?php 
include('footerAdmin.php');
?>