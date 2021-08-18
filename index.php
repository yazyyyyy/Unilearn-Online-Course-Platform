<?php
  include('maininclude/header.php');
  include('dbConnection.php');
?>

    <!--Start Video Background-->
    <div class="container-fluid remove-vid-mrg">
      <div class="vid-parent">
        <video playsinline autoplay muted loop>
          <source src="video/banvid3.mp4"></source>
        </video>
        <div class="vid-overlay"></div>
      </div>
      <div class="vid-content col-sm-12 text-center">
        <h1 class="my-content">Welcome to UniLearn</h1>
        <span class="my-content"><em>Skills that matter!</em></span> <br>
        <?php

          if(isset($_SESSION['is_login'])){
            echo '<a href="userprofile.php" class="btn btn-primary custom-btn">My Profile</a>';
          }else{
            echo '<a href="#" class="btn btn-danger custom-btn" data-toggle="modal" data-target="#registrationModal">Get Started</a>';
          }

        ?>
        <!-- Start search bar  -->
        <div class="container search-bg">
          <div class="row mt-4">
            <div class="col-md-8 mx-auto bg-light rounded p-4">
              <form action="searchResult.php" method="get" class="p-3">
                <div class="input-group">
                  <input type="text" name="searchText" id="searchText" class="form-control form-control-lg rounded-0 border-search" placeholder="Search for a course or specialization..." autocomplete="off" required>
                  <div class="input-group-append">
                    <input type="submit" name="submit" class="btn btn-info btn-search rounded-0">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      <!-- End of search bar  -->
      </div>
    </div>
    <!--End Video Background--> 

    <!--Start Text Banner-->
    <div class="container-fluid bg-danger text-center txt-banner">
      <div class="row bottom-banner">
        <div class="col-sm">
          <h5><i class="fas fa-book-open mr-3"></i>Specializations with learning paths</h5>
        </div>
        <div class="col-sm">
          <h5><i class="fas fa-chalkboard-teacher mr-3"></i>Best Instructors</h5>
        </div>
        <div class="col-sm">
          <h5><i class="fas fa-clock mr-3"></i>Lifetime access</h5>
        </div>
      </div>
    </div>
    <!--End Text Banner-->

    <!--Start Popular Course-->
    <div class="container-fluid">
      <h1 class="text-center">Popular Courses</h1>
      <?php
          $sql = "SELECT * FROM course";
          $result = $conn->query($sql);
          $row_count = 0;
          if($result->num_rows > 0){
      ?>
      <div class="row mx-5">
        <?php while(($row = $result->fetch_assoc()) && ($row_count < 3)){
          echo '<div class="col-md-6 col-lg-4 mt-5">
                  <div class="card bg-primary">';
          echo      '<img class="card-img" src='.$row['course_img'].' alt="Deep Learning" />';
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
              $row_count = $row_count + 1;
        }
      }
        ?>
      </div>
      <div class="text-center"><a href="course.php" class="btn btn-danger text-white mt-5">View All Courses</a></div>
    </div>
    <!-- End Popular Course -->

<!-- Start feedback carousel -->
<div class="col-lg-10 offset-lg-1 pt-5 pb-5 bg-dark text-light mt-5" id="feedback_carousel">
  <div id="client-testimonial-carousel" class="carousel slide" data-ride="carousel" style="height:200px;">
    <div class="carousel-inner" role="listbox">
    <?php
          $sql = "SELECT f.*, u.user_name, u.college 
          FROM feedback f, user u
          WHERE u.user_id = f.user_id
          ORDER BY fb_date DESC";
          $result = $conn->query($sql);
          $row_count = 0;
          if($result->num_rows > 0){
      ?>
      <div class="carousel-item active text-center p-4">
        <blockquote class="blockquote text-center">
        <?php 
          $row = $result->fetch_assoc();
          echo '<p class="mb-0"><i class="fa fa-quote-left"></i>'.$row['fb_title'].'</p>';
          echo '<p><small>'.$row['fb_msg'].'</small></p>';
          echo '<footer class="blockquote-footer">'.$row['user_name'].'<cite title="College name">, &nbsp;'.$row['college'].'</cite></footer>';
          ?>
          <!-- Client review stars -->
          <!-- "fas fa-star" for a full star, "far fa-star" for an empty star, "far fa-star-half-alt" for a half star. -->
        </blockquote>
      </div>
      <?php while(($row = $result->fetch_assoc()) && ($row_count < 3)){
      echo '<div class="carousel-item text-center p-4">';
      echo '<blockquote class="blockquote text-center">';
          echo '<p class="mb-0"><i class="fa fa-quote-left"></i>'.$row['fb_title'].'</p>';
          echo '<p><small>'.$row['fb_msg'].'</small></p>';
          echo '<footer class="blockquote-footer">'.$row['user_name'].'<cite title="College name">, &nbsp;'.$row['college'].'</cite></footer>';
          
          // <!-- Client review stars -->
          // <!-- "fas fa-star" for a full star, "far fa-star" for an empty star, "far fa-star-half-alt" for a half star. -->
        echo '</blockquote>';
      echo '</div>';
      }
    }
    ?>
    </div>
    <ol class="carousel-indicators">
      <li data-target="#client-testimonial-carousel" data-slide-to="0" class="active"></li>
      <li data-target="#client-testimonial-carousel" data-slide-to="1"></li>
      <li data-target="#client-testimonial-carousel" data-slide-to="2"></li>
      <li data-target="#client-testimonial-carousel" data-slide-to="3"></li>
    </ol>
  </div>
</div>
<!-- End feedback carousel -->

<!-- Start footer -->
<?php
      include('maininclude/footer.php');
?>
<!-- End footer -->
