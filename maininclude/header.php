<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniLearn</title>
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!--Font Awesome CSS-->
    <link rel="stylesheet" href="css/all.min.css">
    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@500&display=swap" rel="stylesheet">
    <!--Custom CSS-->
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
    <!--Start Navigation-->
    <nav class="navbar navbar-expand-md navbar-dark pl-5 fixed-top">
        <a class="navbar-brand" href="index.php">UniLearn</a>
        <span class="navbar-text">Skills that matter!</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <ul class="navbar-nav custom-nav pl-5">
            <li class="nav-item custom-nav-item"><a href="index.php" class="nav-link">Home</a></li>
            <li class="nav-item custom-nav-item"><a href="course.php" class="nav-link">Courses</a></li>
            <?php
              if(!isset($_SESSION)){session_start();}
              if(isset($_SESSION['is_login'])){
                echo '
                <li class="nav-item custom-nav-item"><a href="userprofile.php" class="nav-link">'.$_SESSION['stuLoginEmail'].'</a></li>
                <li class="nav-item custom-nav-item"><a href="logout.php" class="nav-link">Sign out</a></li>';
              }else{
                echo '
                <li class="nav-item custom-nav-item"><a href="#" class="nav-link" data-toggle="modal" data-target="#stuLoginModal">Sign in</a></li>
                <li class="nav-item custom-nav-item"><a href="#" class="nav-link" data-toggle="modal" data-target="#registrationModal">Register</a></li>';
              }

            ?>
            
            <li class="nav-item custom-nav-item"><a href="#feedback_carousel" class="nav-link">Feedback</a></li>
            <li class="nav-item custom-nav-item"><a href="#contactUs" class="nav-link">Contact</a></li>
          </ul>
          
        </div>
      </nav>
    <!--End Navigation-->