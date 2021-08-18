<?php
  include('maininclude/header.php');
  include('dbConnection.php');
?>


<!-- Start image banner -->
<div class="container-fluid bg-dark">
    <div class="row">
        <img src="image/imgbanner.jpg" alt="image banner" style="height:500px; width:100%; object-fit:cover; box-shadow:10px;">
    </div>
</div>
<!-- End image banner  -->


<!--Start Popular Course-->
<div class="container-fluid">
  <h1 class="text-center">All Courses</h1>
  <?php
      $sql = "SELECT * FROM course";
      $result = $conn->query($sql);
      if($result->num_rows > 0){
  ?>
  <div class="row mx-5">
    <?php while($row = $result->fetch_assoc()){
      echo '<div class="col-md-6 col-lg-4 mt-5">
              <div class="card bg-primary">';
      echo      '<img class="card-img" src='.$row['course_img'].' alt="course image" />';
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
    }
  }
    ?>
  </div>
</div>
    
<!-- End Popular Course -->

<!-- Start footer -->
<?php
      include('maininclude/footer.php');
?>
<!-- End footer -->

