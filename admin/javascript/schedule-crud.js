
// Add Appointment
$(document).on('submit', '#saveAppointment', function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("save_appointment", true);

    $.ajax({
        type: "POST",
        url: "php/schedule-crud.php",
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
                $('#saveAppointment').find('input[type=date], input[type=time]').val('');
                setTimeout(function(){
                    $('.alert').removeClass("show");
                    $('.alert').addClass("hide");
                }, 5000);
                
            }else if(res.status == 200){
                $('#saveAppointment')[0].reset();
                $('#add_appointment').modal('hide');
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
            $('#saveAppointment')[0].reset();
        }
        
    });

});


//Edit View Appointment
$(document).on('click', '.editAppointment', function () {

    const appointment_id = $(this).val();

    document.getElementsByClassName('updateButton').value = appointment_id;
    document.getElementsByClassName('deleteButton').value = appointment_id;
    $.ajax({
        type: "GET",
        url: "php/schedule-crud.php?appointment_id=" + appointment_id,
        success: function (response) {

            var res = jQuery.parseJSON(response);
            if(res.status == 404) {

                alert(res.message);
            }else if(res.status == 200){

                $('[name="firstname"]').val(res.data.firstname);
                $('[name="lastname"]').val(res.data.lastname);
                $('[name="email"]').val(res.data.email);
                $('[name="phone_number"]').val(res.data.phone_number);
                $('[name="service"]').val(res.data.service);
                $('[name="preferred_date"]').val(res.data.preferred_date);
                $('[name="preferred_time"]').val(res.data.preferred_time);
                $('[name="comments"]').val(res.data.comments);


                $('#appointmentEditModal').modal('show');
            }

            $('#saveAppointment')[0].reset();

        }
    });

});


// Update Appointment
$(document).on('submit', '#updateAppointment', function (e) {
    e.preventDefault();
    const appointment_id = document.getElementsByClassName('updateButton').value
    const formData = new FormData(this);
    formData.append("update_appointment", true);
    $.ajax({
        type: "POST",
        url: "php/schedule-crud.php?update_appointment=" + appointment_id,
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                const alertMessage = document.querySelector('.alert-msg');
                alertMessage.textContent = res.message;
                $('.alert').addClass("show");
                $('.alert').removeClass("hide");
                $('.alert').addClass("showAlert");
                $('#updateAppointment').find('input[type=date], input[type=time]').val('');
                setTimeout(function(){
                    $('.alert').removeClass("show");
                    $('.alert').addClass("hide");
                }, 5000);

            }else if(res.status == 200){

                $('#errorMessageUpdate').addClass('d-none');

                $('#appointmentEditModal').modal('hide');
                $('#updateAppointment')[0].reset();
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
            url: "php/schedule-crud.php",
            data: {
                'delete_appointment': true,
                'delete_id': delete_id
            },
            success: function (response) {

                var res = jQuery.parseJSON(response);
                if(res.status == 500) {
                
                alert(res.message);
                }else if(res.status == 200){
                    $('#errorMessageUpdate').addClass('d-none');
                    $('#appointmentEditModal').modal('hide');
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
