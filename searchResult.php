<?php
include('maininclude/header.php');
include('dbConnection.php');

if(isset($_GET['submit'])){
  $searchText = $_GET['searchText'];
  $sql="SELECT * FROM course WHERE LOWER(course_name) LIKE '%$searchText%' OR LOWER(course_category) LIKE '%$searchText%'";

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
    echo '<p class="bg-dark text-white p-2 text-center mt-5" style="border:1px solid; border-radius: 10px;">Search Results</p>';
    
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
     }else{
       echo '<h3>No Results found.</h3>';
     }
?>
</div>
<!-- End main content -->


<?php
    include('maininclude/footer.php');
?>
