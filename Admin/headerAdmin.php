<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard-UniLearn</title>
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!--Font Awesome CSS-->
    <link rel="stylesheet" href="../css/all.min.css">
    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@500&display=swap" rel="stylesheet">
    <!--Custom CSS-->
    <link rel="stylesheet" href="../css/adminstyle.css" type="text/css">
</head>
<body>
    <!--Start Navigation-->
    <nav class="navbar navbar-expand-md navbar-dark pl-5 fixed-top" style="background-color: #225470;">
        <a class="navbar-brand" href="adminDashboard.php">UniLearn - <small>Admin Portal</small></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </nav>
    <!--End Navigation-->

    <!-- Start Sidebar -->
    <div class="container-fluid mb-5" style="margin-top: 40px;">
        <div class="row">
            <nav class="col-sm-3 col-md-2 bg-light py-5 d-print-none">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="adminDashboard.php" class="nav-link">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="courses.php" class="nav-link">
                                <i class="fas fa-book"></i>
                                Courses
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="instructors.php" class="nav-link">
                                <i class="fas fa-chalkboard-teacher"></i>
                                Instructors
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="specializations.php" class="nav-link">
                                <i class="fas fa-chart-pie"></i>
                                Specializations
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="users.php" class="nav-link">
                            <i class="fas fa-users"></i>
                                Registered Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="feedback.php" class="nav-link">
                                <i class="fas fa-comment-dots"></i>
                                Feedback
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="changepass.php" class="nav-link">
                            <i class="fas fa-unlock-alt"></i>
                                Change Password
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../logout.php" class="nav-link">
                            <i class="fas fa-sign-out-alt"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>