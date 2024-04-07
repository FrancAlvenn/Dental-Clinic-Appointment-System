
// Add Appointment s
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
                $('.alert').addClass("error");
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
                $('.alert').removeClass("error");
                $('.alert').addClass("success");
                $('#add_appointment').modal('hide');
                $('.modal-backdrop').remove();
                $('#saveAppointment')[0].reset();
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
                $('.alert').addClass("error");
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
                console.log(appointment_id);
            }else if(res.status == 200){

                $('[name="firstname"]').val(res.data.firstname);
                $('[name="lastname"]').val(res.data.lastname);
                $('[name="email"]').val(res.data.email);
                $('[name="phone_number"]').val(res.data.phone_number);
                $('[name="service"]').val(res.data.service);
                $('[name="status"]').val(res.data.status);
                $('[name="preferred_date"]').val(res.data.preferred_date);
                $('[name="preferred_time"]').val(res.data.preferred_time);
                $('[name="comments"]').val(res.data.comments);


                $('#appointmentEditModal').modal('show');
            }

            $('#saveAppointment')[0].reset();

        }
    });

});

$(document).on('click', '.editAppointments', function (event) {
    event.preventDefault();
    appointment_id = $(this).attr('value');

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
                $('[name="status"]').val(res.data.status);
                $('[name="preferred_date"]').val(res.data.preferred_date);
                $('[name="preferred_time"]').val(res.data.preferred_time);
                $('[name="comments"]').val(res.data.comments);


                $('#appointmentEditModal').modal('show');
            }

            $('#saveAppointment')[0].reset();

        }
    });

});


// Function to load appointment details
function loadAppointmentDetails(commentId) {
    $.ajax({
        type: "GET",
        url: "php/schedule-crud.php",
        data: { comment_id: commentId }, // Pass comment ID to the server
        dataType: "json",
        success: function(response) {
            if (response.status == 404) {
                alert(response.message);
            } else if (response.status == 200) {
                // Set form field values based on response data
                $('[name="firstname"]').val(response.data.firstname);
                $('[name="lastname"]').val(response.data.lastname);
                $('[name="email"]').val(response.data.email);
                $('[name="phone_number"]').val(response.data.phone_number);
                $('[name="service"]').val(response.data.service);
                $('[name="status"]').val(response.data.status);
                $('[name="preferred_date"]').val(response.data.preferred_date);
                $('[name="preferred_time"]').val(response.data.preferred_time);
                $('[name="comments"]').val(response.data.comments);

                // Show the modal
                $('#appointmentEditModal').modal('show');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            console.error(error);
        }
    });
}


// Update Appointment
$(document).on('submit', '#updateAppointment', function (e) {
    e.preventDefault();
    let appointment_id = document.getElementsByClassName('updateButton').value;
    if(appointment_id == undefined){
        const appointmentButton = document.getElementsByClassName('updateButton')[0]; // Access the first element with the class 'updateButton'
        appointment_id = appointmentButton.value;
    }
    const formData = new FormData(this);
    formData.append("update_appointment", true);
    console.log(appointment_id);
    $.ajax({
        type: "POST",
        url: "php/schedule-crud.php?update_appointment=" + appointment_id,
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                $('.alert').addClass("error");
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
                $('.alert').removeClass("error");
                $('.alert').addClass("success");
                $('#errorMessageUpdate').addClass('d-none');
                $('.modal-backdrop').remove();
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

                let audio = new Audio("../resources/system-notification-199277.mp3")
                audio.play();

            }else if(res.status == 500) {
                $('.alert').addClass("error");
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
        let delete_id = document.getElementsByClassName('deleteButton').value
        if(delete_id == undefined){
            const appointmentButton = document.getElementsByClassName('deleteButton')[0]; // Access the first element with the class 'updateButton'
            delete_id = appointmentButton.value;
        }
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
                    $('.alert').removeClass("error");
                    $('.alert').addClass("success");
                    $('#errorMessageUpdate').addClass('d-none');
                    $('.modal-backdrop').remove();
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

                    let audio = new Audio("../resources/system-notification-199277.mp3")
                    audio.play();
                }else{

                }
            }
        });
    }
});
