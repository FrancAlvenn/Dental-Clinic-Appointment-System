
// Add Patient
$(document).on('submit', '#savePatient', function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("save_patient", true);

    $.ajax({
        type: "POST",
        url: "php/patient-crud.php",
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
                $('#savePatient')[0].reset();
                $('#add_patient').modal('hide');
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
            $('#savePatient')[0].reset();
        }
        
    });

});


//Edit View Appointment
$(document).on('click', '.editPatient', function () {

    const patient_id = $(this).val();

    document.getElementsByClassName('updateButton').value = patient_id;
    document.getElementsByClassName('deleteButton').value = patient_id;
    $.ajax({
        type: "GET",
        url: "php/patient-crud.php?patient_id=" + patient_id,
        success: function (response) {

            var res = jQuery.parseJSON(response);
            if(res.status == 404) {

                alert(res.message);
            }else if(res.status == 200){

                $('[name="firstname"]').val(res.data.firstname);
                $('[name="lastname"]').val(res.data.lastname);
                $('[name="email"]').val(res.data.email);
                $('[name="phone_number"]').val(res.data.phone_number);
                $('[name="date_of_birth"]').val(res.data.date_of_birth);
                $('[name="street"]').val(res.data.street);
                $('[name="baranggay"]').val(res.data.baranggay);
                $('[name="city"]').val(res.data.city_municipality);
                $('[name="province"]').val(res.data.province);

                $('#patientEditModal').modal('show');
            }

            $('#savePatient')[0].reset();

        }
    });

});


// Update Appointment
$(document).on('submit', '#updatePatient', function (e) {
    e.preventDefault();
    const patient_id = document.getElementsByClassName('updateButton').value
    const formData = new FormData(this);
    formData.append("update_patient", true);
    $.ajax({
        type: "POST",
        url: "php/patient-crud.php?update_patient=" + patient_id,
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

                $('#patientEditModal').modal('hide');
                $('#updatePatient')[0].reset();
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
            url: "php/patient-crud.php",
            data: {
                'delete_patient': true,
                'delete_id': delete_id
            },
            success: function (response) {

                var res = jQuery.parseJSON(response);
                if(res.status == 500) {
                
                alert(res.message);
                }else if(res.status == 200){
                    $('#errorMessageUpdate').addClass('d-none');
                    $('#patientEditModal').modal('hide');
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
