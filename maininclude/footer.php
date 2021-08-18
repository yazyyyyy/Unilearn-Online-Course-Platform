<!--Start social banner-->
<div class="container-fluid bg-danger mt-5">
  <div class="row text-center p-1">
    <div class="col-sm">
      <a href="#" class="social-hover text-white"><i class="fab fa-facebook-square mr-2"></i>Facebook</a>
    </div>
    <div class="col-sm">
      <a href="#" class="social-hover text-white"><i class="fab fa-twitter-square mr-2"></i>Twitter</a>
    </div>
    <div class="col-sm">
      <a href="#" class="social-hover text-white"><i class="fab fa-linkedin mr-2"></i>LinkedIn</a>
    </div>
    <div class="col-sm">
      <a href="#" class="social-hover text-white"><i class="fab fa-youtube mr-2"></i>YouTube</a>
    </div>
  </div>
</div>
<!--End social banner--> 

<!-- Start About us section -->
<div class="container-fluid p-4 abt-section">
  <div class="container abt-section">
    <div class="row text-center">
      <div class="col-sm">
        <h5>About Us</h5>
        <p>UniLearn is an online course platform to offer specialization courses to college 
          students made by teachers and professors from the best colleges.
        </p>
      </div>
      <div class="col-sm">
        <h5>Category</h5>
        <a href="#" class="text-dark">Deep Learning</a><br>
        <a href="#" class="text-dark">Web Development</a><br>
        <a href="#" class="text-dark">Machine Learning</a><br>
        <a href="#" class="text-dark">Cloud Computing</a><br>
        <a href="#" class="text-dark">Mobile App Development</a><br>
        <a href="#" class="text-dark">Data Analysiss</a><br>
      </div>
      <div class="col-sm" id="contactUs">
        <h5>Contact Us</h5>
        <p>UniLearn Building, ABC, Bangalore, Karnataka.<br>
          Phone: 080-8765XXXX<br></p>
      </div>
    </div>
  </div>
</div>
<!-- End About us section -->

<!-- Start footer section -->
<div class="container-fluid bg-dark text-center p-2">
  <small class="text-white">UniLearn Copyright &copy; 2020.&nbsp;&nbsp;&nbsp;</small><a href="#" data-toggle="modal" data-target="#adminLoginModal">
    Admin Login</a> 
</div>
<!-- End footer section -->

    <!-- Start registration modal -->
<div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="registrationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registrationModalLabel">Registration Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Start registration form -->
          <?php include('userRegistrationForm.php'); ?>
        <!-- End registration form -->
      <div class="modal-footer">
        <span id="successMsg"></span>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addStu()" id="registerBtn">Register</button>
      </div>
    </div>
  </div>
</div>
    
    <!-- End registration modal -->

<!-- Start stuLogin modal -->
<div class="modal fade" id="stuLoginModal" tabindex="-2" role="dialog" aria-labelledby="stuLoginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="stuLoginModalLabel">User Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Start login form -->
        <form>
          <div class="form-group">
                <i class="fas fa-envelope mr-1"></i>
                <label for="stuLoginEmail">Email id</label>
                <input type="text" class="form-control" id="stuLoginEmail" autofocus>
            </div>
            <div class="form-group">
                <i class="fas fa-key mr-1"></i>
                <label for="stuLoginPassword">Password</label>
                <input type="password" class="form-control" id="stuLoginPassword">
            </div>
        </form>
        <!-- End login form -->
      </div>
      <div class="modal-footer">
        <span id="stuLoginMsg"></span>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="loginStu()">Sign In</button>
      </div>
    </div>
  </div>
</div>
<!-- End stuLogin modal -->

<!-- Start adminLogin modal -->
<div class="modal fade" id="adminLoginModal" tabindex="-2" role="dialog" aria-labelledby="adminLoginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="adminLoginModalLabel">Admin Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Start login form -->
        <form>
          <div class="form-group">
                <i class="fas fa-envelope mr-1"></i>
                <label for="adminLoginEmail">Email id</label>
                <input type="text" class="form-control" id="adminLoginEmail" autofocus>
            </div>
            <div class="form-group">
                <i class="fas fa-key mr-1"></i>
                <label for="admiLoginPassword">Password</label>
                <input type="password" class="form-control" id="adminLoginPassword">
            </div>
        </form>
        <!-- End login form -->
      </div>
      <div class="modal-footer">
        <span id="adminLoginMsg"></span>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="loginAdmin()">Sign In</button>
      </div>
    </div>
  </div>
</div>
<!-- End adminLogin modal -->

<!--jQuery and Bootstrap JavaScript-->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--Font Awesome JavaScript-->
<script src="js/all.min.js"></script>
<!--Ajax Call Request JavaScript-->
<script type="text/javascript" src="js/searchScript.js"></script>
<script type="text/javascript" src="js/ajaxrequest.js"></script>
<script type="text/javascript" src="js/adminajaxrequest.js"></script>
<!--Script for modal autofocus-->
<script> 
  $('.modal').on('shown.bs.modal', function() {
    $(this).find('[autofocus]').focus();
  });
  // Scrolling navbar
  $(window).scroll(function () {
    if ($(window).scrollTop() >= 150) {
    $('.navbar').css('background','#590995');
    } else {
    $('.navbar').css('background','transparent');
    }
  });
</script>
    
</body>
</html>