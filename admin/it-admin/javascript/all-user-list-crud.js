
// Add User

$(document).on('submit', '#saveUser', function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("save_user", true);

    $.ajax({
        type: "POST",
        url: "php/all-user-crud.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            
            const res = jQuery.parseJSON(response);
            if(res.status == 422) {
                const alertMessage = document.querySelector('.alert-msg');
                alertMessage.textContent = res.message;
                $('.alert').addClass("show");
                $('.alert').removeClass("hide");
                $('.alert').addClass("showAlert");
                setTimeout(function(){
                    $('.alert').removeClass("show");
                    $('.alert').addClass("hide");
                }, 5000);
                
            }else if(res.status == 200){
                $('#saveUser')[0].reset();
                $('#add_User').modal('hide');
                // Show the notification popup
                const alertMessage = document.querySelector('.alert-msg');
                alertMessage.textContent = res.message;
                $('.alert').addClass("show");
                $('.alert').removeClass("hide");
                $('.alert').addClass("showAlert");
                setTimeout(function(){
                    $('.alert').removeClass("show");
                    $('.alert').addClass("hide");
                }, 5000);

            }else if(res.status == 500) {
                alert(res.message);
            }
            $('#saveUser')[0].reset();
        }
        
    });

});


//Edit View Appointment
$(document).on('click', '.editUser', function () {

    const user_id = $(this).val();

    document.getElementsByClassName('updateButton').value = user_id;
    document.getElementsByClassName('deleteButton').value = user_id;
    $.ajax({
        type: "GET",
        url: "php/all-user-crud.php?user_id=" + user_id,
        success: function (response) {

            var res = jQuery.parseJSON(response);
            if(res.status == 404) {

                alert(res.message);
            }else if(res.status == 200){

                $('[name="firstname"]').val(res.data.fname);
                $('[name="lastname"]').val(res.data.lname);
                $('[name="email"]').val(res.data.email);
                $('[name="status"]').val(res.data.status);
                $('[name="auth"]').val(res.data.auth);
                $('[name="password"').val(res.data.password);

                $('#userEditModal').modal('show');
            }

            $('#saveUser')[0].reset();

        }
    });

});


// Update Appointment
$(document).on('submit', '#updateUser', function (e) {
    e.preventDefault();
    const user_id = document.getElementsByClassName('updateButton').value
    const formData = new FormData(this);
    formData.append("update_user", true);
    $.ajax({
        type: "POST",
        url: "php/all-user-crud.php?update_user=" + user_id,
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log(response + "This works");
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                const alertMessage = document.querySelector('.alert-msg');
                alertMessage.textContent = res.message;
                $('.alert').addClass("show");
                $('.alert').removeClass("hide");
                $('.alert').addClass("showAlert");
                setTimeout(function(){
                    $('.alert').removeClass("show");
                    $('.alert').addClass("hide");
                }, 5000);

            }else if(res.status == 200){

                $('#errorMessageUpdate').addClass('d-none');

                $('#userEditModal').modal('hide');
                $('#updateUser')[0].reset();
                // Show the notification popup
                const alertMessage = document.querySelector('.alert-msg');
                alertMessage.textContent = res.message;
                $('.alert').addClass("show");
                $('.alert').removeClass("hide");
                $('.alert').addClass("showAlert");
                setTimeout(function(){
                    $('.alert').removeClass("show");
                    $('.alert').addClass("hide");
                }, 5000);

            }else if(res.status == 500) {
                alert(res.message);
            }
        }
    });

});


//Delete Appointment
$(document).on('click', '.deleteButton', function (e) {
    e.preventDefault();

    if(confirm('Are you sure you want to delete this data?'))
    {
        const delete_id = document.getElementsByClassName('deleteButton').value
        console.log(delete_id);
        $.ajax({
            type: "POST",
            url: "php/all-user-crud.php",
            data: {
                'delete_user': true,
                'delete_id': delete_id
            },
            success: function (response) {

                var res = jQuery.parseJSON(response);
                if(res.status == 500) {
                
                alert(res.message);
                }else if(res.status == 200){
                    $('#errorMessageUpdate').addClass('d-none');
                    $('#userEditModal').modal('hide');
                    // Show the notification popup
                    const alertMessage = document.querySelector('.alert-msg');
                    alertMessage.textContent = res.message;
                    $('.alert').addClass("show");
                    $('.alert').removeClass("hide");
                    $('.alert').addClass("showAlert");
                    setTimeout(function(){
                        $('.alert').removeClass("show");
                        $('.alert').addClass("hide");
                    }, 5000);
                }else{

                }
            }
        });
    }
});
