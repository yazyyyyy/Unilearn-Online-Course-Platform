$(document).ready(function(){
    //Ajax call on form for email already exists
    $("#inputEmail").on("blur", function(){
        var reg = /^[A-Z0-9.+%-]*@([A-Z0-9]+\.)+[A-Z]{2,4}$/i;
        var inputEmail = $('#inputEmail').val();
        $.ajax({
            url: 'Student/adduser.php',
            method: 'POST',
            data: {
                checkemail: "checkmail",
                inputEmail: inputEmail,
            },
            success: function(data){
                console.log(data);
                if(data != 0){
                    $('#statusMsg2').html('<small style="color:red;">(Email already exists!!)</small>');
                    $('#registerBtn').attr("disabled", true);
                }else{
                    $('#statusMsg2').html('<small style="color:green;">(Good to go!)</small>');
                    $('#registerBtn').attr("disabled", false);
                }
                if(!reg.test(inputEmail)){
                    $('#statusMsg2').html('<small style="color:red;">(Please enter a valid Email e.g. example@mail.com)</small>');
                    $('#registerBtn').attr("disabled", true);
                }
            }
        });
    });
});

//Ajax call for User Registration
function addStu(){
    var emailReg = /^[A-Z0-9.+%-]*@([A-Z0-9]+\.)+[A-Z]{2,4}$/i;
    var phoneReg = /^[0-9]{10}$/;
    var inputName = $("#inputName").val();
    var inputEmail = $("#inputEmail").val();
    var inputPassword = $("#inputPassword").val();
    var inputPhone = $("#inputPhone").val();
    var inputAddress = $("#inputAddress").val();
    var inputCollege = $("#inputCollege").val();
    var inputDegree = $('#inputDegree option:selected').val();
    var inputSem = $('#inputSem option:selected').val();
    // console.log(inputName);
    // console.log(inputEmail);
    // console.log(inputPassword);
    // console.log(inputPhone);
    // console.log(inputAddress);
    // console.log(inputCollege);
    // console.log(inputDegree);
    // console.log(inputSem);

    //Checking Form Fields on Form Submission
    if(inputName.trim() == ""){
        $('#statusMsg1').html('<small style="color:red;">(Please enter name)</small>');
        $('#inputName').focus();
        return false;
    }else if(inputEmail.trim() == ""){
        $('#statusMsg2').html('<small style="color:red;">(Please enter Email)</small>');
        $('#inputEmail').focus();
        return false;
    }else if(inputEmail.trim() != "" && !emailReg.test(inputEmail)){
        $('#statusMsg2').html('<small style="color:red;">(Please enter a valid Email e.g. example@mail.com)</small>');
        $('#inputEmail').focus();
        return false;
    }else if(inputPassword.trim() == ""){
        $('#statusMsg3').html('<small style="color:red;">(Please enter Password)</small>');
        $('#inputPassword').focus();
        return false;
    }else if(!phoneReg.test(inputPhone)){
        $('#statusMsg4').html('<small style="color:red;">(Please enter valid 10 digit phone No.)</small>');
        $('#inputPhone').focus();
        return false;
    }else if(inputAddress.trim() == ""){
        $('#statusMsg5').html('<small style="color:red;">(Please enter Address)</small>');
        $('#inputAddress').focus();
        return false;
    }else if(inputCollege.trim() == ""){
        $('#statusMsg6').html('<small style="color:red;">(Please enter College)</small>');
        $('#inputCollege').focus();
        return false;
    }else if(inputDegree.trim() == ""){
        $('#statusMsg7').html('<small style="color:red;">(Please select Degree)</small>');
        return false;
    }else if(inputSem.trim() == ""){
        $('#statusMsg8').html('<small style="color:red;">(Please select Semester)</small>');
        return false;
    }else{
        $.ajax({
            url: 'Student/adduser.php',
            method: 'POST',
            dataType: 'json',
            data: {
                userRegister: "userRegister",
                inputName: inputName,
                inputEmail: inputEmail,
                inputPassword: inputPassword,
                inputPhone: inputPhone,
                inputAddress: inputAddress,
                inputCollege: inputCollege,
                inputDegree: inputDegree,
                inputSem: inputSem,
            },
            success: function(data){
                console.log(data);
                if (data == "OK"){
                    $('#successMsg').html('<span class="alert alert-success">Registration Sucessful!</span>');
                    clearStuRegField();
                }
                else if(data == "Failed"){
                    $('#successMsg').html('<span class="alert alert-danger">Unable to register! Please check.</span>');
                }
            },
        });
    }
    //--
    
}

//Empty all fields
function clearStuRegField(){
    $('#userRegForm').trigger("reset");
    $('#statusMsg1').html(" ");
    $('#statusMsg2').html(" ");
    $('#statusMsg3').html(" ");
    $('#statusMsg4').html(" ");
    $('#statusMsg5').html(" ");
    $('#statusMsg6').html(" ");
    $('#statusMsg7').html(" ");
    $('#statusMsg8').html(" ");
    
}

//Ajax call for user login verification
function loginStu(){
    var stuLoginEmail = $('#stuLoginEmail').val();
    var stuLoginPassword = $('#stuLoginPassword').val();
    // console.log(stuLoginEmail);
    // console.log(stuLoginPassword);
    $.ajax({
        url: 'Student/adduser.php',
        method: 'POST',
        dataType: 'json',
        data: {
            stulogincheck: "stulogincheck",
            stuLoginEmail: stuLoginEmail,
            stuLoginPassword: stuLoginPassword,
        },
        success: function(data){
            console.log(data);
            if(data == 0){
                $('#stuLoginMsg').html('<span class="alert alert-danger">Username or Password is incorrect!</span>');
            }else if(data == 1){
                $('#stuLoginMsg').html('<div class="spinner-border text-success" role="status"></div>');
                setTimeout(() => {window.location.href = "index.php"}, 1000);
            }
        },
    });
}






