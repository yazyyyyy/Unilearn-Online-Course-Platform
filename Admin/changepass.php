<?php 
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['is_admin_login'])){
    echo '<script> location.href="../index.php" </script>';
}else{
    $adminLoginEmail = $_SESSION['adminLoginEmail'];
}


include('headerAdmin.php');
include('../dbConnection.php');

$sql = "SELECT * FROM admin WHERE admin_email = '$adminLoginEmail'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
echo $row['admin_pass'];


$adminLoginEmail = $_SESSION['adminLoginEmail'];
if(isset($_REQUEST['passSubmitBtn'])){
    if(($_REQUEST['new_pass'])==""){
        $msg = '<div class="alert alert-warning mt-2 col-sm-6">Enter New Password</div>';
    }else{
        $exist_pass = ($_REQUEST['exist_pass']);
        $new_pass = ($_REQUEST['new_pass']);
        if($exist_pass == $new_pass){
            $msg = '<div class="alert alert-danger mt-2 col-sm-6">New Password cannot be same as old.</div>';
        }else{
            $sql = "UPDATE admin SET admin_pass='$new_pass' WHERE admin_email = '$adminLoginEmail'";
            if($conn->query($sql) == TRUE){
                $msg = '<div class="alert alert-success mt-2 col-sm-6">Password Changed Succesfully!!</div>';
                //echo "Query: " . $sql . "<br>";
            }else{
                $msg = '<div class="alert alert-danger mt-2 col-sm-6">Unable to change password</div>';
                //echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }


    }
}


?>

<div class="col-sm-9 mt-5">
    <div class="col-md-4 mx-5 mt-5">
    <p class="bg-dark text-white p-2 text-center" style="border:1px solid; border-radius: 10px;">Change Admin Password</p>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
                <label for="exist_pass">Existing Password</label>
                <input type="text" class="form-control" id="exist_pass" name="exist_pass" value="<?php echo $row['admin_pass']; ?>" readonly>
        </div>
        <div class="form-group">
                <label for="new_pass">New Password</label>
                <input type="text" class="form-control" id="new_pass" name="new_pass">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="passSubmitBtn" name="passSubmitBtn">Change</button>
        </div>
        <?php if(isset($msg)){echo $msg;} ?>
    </form>
</div>

<?php 
include('footerAdmin.php');
?>