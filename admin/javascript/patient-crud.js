
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
                $('.alert').addClass("error");
                const alertMessage = document.querySelector('.alert-msg');
                alertMessage.textContent = res.message;
                $('.alert').addClass("show");
                $('.alert').removeClass("hide");
                $('.alert').addClass("showAlert");
                $('.modal-backdrop').remove();
                setTimeout(function(){
                    $('.alert').removeClass("show");
                    $('.alert').addClass("hide");
                }, 5000);
                
            }else if(res.status == 200){
                $('.alert').removeClass("error");
                $('.alert').addClass("success");
                $('#savePatient')[0].reset();
                $('#add_patient').modal('hide');
                $('.modal-backdrop').remove();
                // Show the notification popup
                const alertMessage = document.querySelector('.alert-msg');
                alertMessage.textContent = res.message;
                $('.alert').addClass("show");
                $('.alert').removeClass("hide");
                $('.alert').addClass("showAlert");
                setTimeout(function(){
                    $('.alert').removeClass("show");
                    $('.alert').removeClass("success");
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

                $('#patientHistoryList').empty();

                if (res && Array.isArray(res.history)) {
                    // Loop through each entry in patient history
                    res.history.forEach(function (visit) {
                        // Append a new <li> element for each visit
                        $('#patientHistoryList').append('<li>' + visit.service + '<span>' + visit.appointment_date + '</span>' +'</li>');
                    });
                } else {
                    // Handle the case when there is no data in the database or res.history is not an array
                    $('#patientHistoryList').append('<li>No past visits</li>');
                }

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
            var res = jQuery.parseJSON(response);
            console.log(res)
            if(res.status == 422) {
                $('.alert').addClass("error");
                const alertMessage = document.querySelector('.alert-msg');
                alertMessage.textContent = res.message;
                $('.alert').addClass("show");
                $('.alert').removeClass("hide");
                $('.alert').addClass("showAlert");
                $('.modal-backdrop').remove();
                setTimeout(function(){
                    $('.alert').removeClass("show");
                    $('.alert').addClass("hide");
                }, 5000);

            }else if(res.status == 200){
                $('.alert').removeClass("error");
                $('.alert').addClass("success");
                $('#errorMessageUpdate').addClass('d-none');
                $('#patientEditModal').modal('hide');
                $('#updatePatient')[0].reset();
                $('.modal-backdrop').remove();
                // Show the notification popup
                const alertMessage = document.querySelector('.alert-msg');
                alertMessage.textContent = res.message;
                $('.alert').addClass("show");
                $('.alert').removeClass("hide");
                $('.alert').addClass("showAlert");
                setTimeout(function(){
                    $('.alert').removeClass("show");
                    $('.alert').addClass("hide");
                    $('.alert').removeClass("success");
                }, 5000);

            }else if(res.status == 500) {
                alert(res.message);
            }
        }
    });

});


//Delete Appointment
$(document).on('click', '.deleteButtonPatient', function (e) {
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
                    $('.alert').addClass("error");
                    const alertMessage = document.querySelector('.alert-msg');
                    alertMessage.textContent = res.message;
                    $('.alert').addClass("show");
                    $('.alert').removeClass("hide");
                    $('.alert').addClass("showAlert");
                    setTimeout(function(){
                        $('.alert').removeClass("show");
                        $('.alert').addClass("hide");
                    }, 5000);
                alert(res.message);
                }else if(res.status == 200){
                    $('.alert').addClass("success ");
                    $('#errorMessageUpdate').addClass('d-none');
                    $('#patientEditModal').modal('hide');
                    // Show the notification popup
                    const alertMessage = document.querySelector('.alert-msg');
                    alertMessage.textContent = res.message;
                    $('.alert').addClass("show");
                    $('.alert').removeClass("hide");
                    $('.alert').addClass("showAlert");
                    $('.modal-backdrop').remove();
                    setTimeout(function(){
                        $('.alert').removeClass("show");
                        $('.alert').removeClass("success");
                        $('.alert').addClass("hide");
                    }, 5000);
                }else{
                    $('.alert').addClass("error");
                    const alertMessage = document.querySelector('.alert-msg');
                    alertMessage.textContent = res.message;
                    $('.alert').addClass("show");
                    $('.alert').removeClass("hide");
                    $('.alert').addClass("showAlert");
                    $('.modal-backdrop').remove();
                    setTimeout(function(){
                        $('.alert').removeClass("show");
                        $('.alert').addClass("hide");
                    }, 5000);
                }
            }
        });
    }
});



document.querySelector('#print').addEventListener('click', function() {
    // Get the patient_id from the button
    const patient_id = document.getElementsByClassName('updateButton').value;
    console.log(patient_id);
    // Construct the print URL
    const printUrl = 'print.php?patient_id=' + patient_id;
    // Open the print URL in a new tab
    window.open(printUrl, '_blank');
});