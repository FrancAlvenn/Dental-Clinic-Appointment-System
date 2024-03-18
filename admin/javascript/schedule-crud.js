
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
            
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                $('#errorMessage').removeClass('d-none');
                $('#errorMessage').text(res.message);
            }else if(res.status == 200){
                $('#errorMessage').addClass('d-none');
                $('#studentAddModal').modal('hide');
                $('#saveAppointment')[0].reset();
            }else if(res.status == 500) {
                alert(res.message);
            }
        }
    });

});


//Edit View Appointment
$(document).on('click', '.editAppointment', function () {

    const appointment_id = $(this).val();
    
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

        }
    });

});


// Update Appointment