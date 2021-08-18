//Ajax call for admin login verification
function loginAdmin(){
    var adminLoginEmail = $('#adminLoginEmail').val();
    var adminLoginPassword = $('#adminLoginPassword').val();
    // console.log(stuLoginEmail);
    // console.log(stuLoginPassword);
    $.ajax({
        url: 'Admin/admin.php',
        method: 'POST',
        dataType: 'json',
        data: {
            adminlogincheck: "adminlogincheck",
            adminLoginEmail: adminLoginEmail,
            adminLoginPassword: adminLoginPassword,
        },
        success: function(data){
            console.log(data);
            if(data == 0){
                $('#adminLoginMsg').html('<span class="alert alert-danger">Access denied!</span>');
            }else if(data == 1){
                $('#adminLoginMsg').html('<div class="alert alert-success">Access Granted...</div>');
                setTimeout(() => {window.location.href = "Admin/adminDashboard.php"}, 1000);
            }
        },
    });
}