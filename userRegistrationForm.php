<!-- Start registration form -->
<form id="userRegForm">
    <div class="form-group">
        <i class="fas fa-user mr-1"></i>
        <label for="inputName">Name <small id="statusMsg1"></small></label>
        <input type="text" class="form-control" id="inputName" autofocus>
    </div>
    <div class="form-group">
        <i class="fas fa-envelope mr-1"></i>
        <label for="inputEmail">Email id <small id="statusMsg2"></small></label>
        <input type="text" class="form-control" id="inputEmail">
    </div>
    <div class="form-group">
        <i class="fas fa-key mr-1"></i>
        <label for="inputPassword">Create Password <small id="statusMsg3"></small></label>
        <input type="password" class="form-control" id="inputPassword">
    </div>
    <div class="form-group">
        <i class="fas fa-phone-square-alt mr-1"></i>
        <label for="inputPhone">Phone Number <small id="statusMsg4"></small></label>
        <input type="text" class="form-control" id="inputPhone">
    </div>
    <div class="form-group">
        <i class="fas fa-house-user mr-1"></i>
        <label for="inputAddress">Address <small id="statusMsg5"></small></label>
        <textarea class="form-control" id="inputAddress" rows="3"></textarea>
    </div>
    <div class="form-group">
        <i class="fas fa-graduation-cap mr-1"></i>
        <label for="inputCollege">College Name <small id="statusMsg6"></small></label>
        <input type="text" class="form-control" id="inputCollege">
    </div>
    <small id="statusMsg7"></small>
    <small id="statusMsg8"></small>
    <select class="form-select" aria-label="degreeSelect" id="inputDegree">
        <option selected value="">Degree</option>
        <option value="B.E/B.Tech">B.E/B.Tech</option>
        <option value="M.E/M.Tech">M.E/M.Tech</option>
        <option value="MBA">MBA</option>
    </select>
    <select class="form-select" aria-label="semSelect" id="inputSem">
        <option selected value="">Semester</option>
        <option value="1">I</option>
        <option value="2">II</option>
        <option value="3">III</option>
        <option value="4">IV</option>
        <option value="5">V</option>
        <option value="6">VI</option>
        <option value="7">VII</option>
        <option value="8">VIII</option>
    </select>
    </form>
</div>
<!-- End registration form -->