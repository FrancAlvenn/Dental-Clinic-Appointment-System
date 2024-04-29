
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
            console.log(res);
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
    e.stopImmediatePropagation();
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

                if(res.send_sms == 0){
                    sendConfirmationMessage(res.recipient, res.notification_message)
                }

            }else if(res.status == 500) {
                $('.alert').addClass("error");
                alert(res.message);
            }
        }
    });

});

$(document).ready(function() {
    // Function to load appointments and send notifications
    function loadAppointmentToSendNotification() {
        $.ajax({
            type: "GET",
            url: "php/schedule-crud.php",
            dataType: "json",
            success: function(response) {
                if (response.status == 404) {
                    console.log(response.message);
                } else if (response.status == 200) {
                    // Iterate over each appointment
                    response.appointments.forEach(function(appointment, index) {
                        // Check if notification has already been sent for this appointment
                        if (response.notification_sent[index] == 0 && response.status == 'confirmed' ) {
                            // Use phoneNumber and notificationMessage as needed
                            console.log("Phone number: " + appointment);
                            console.log("Notification message: " + response.notificationMessages[index]);
                            console.log("Viewed: " + response.notification_sent[index]);
                            console.log("Status:" + response.appointmentStatus[index])
                            
                            // Here you can call the function to send SMS notifications
                            sendNotificationMessage(appointment, response.notificationMessages[index]);
                        } else {
                            console.log("Notification already sent for appointment or the appointment status is not yet confirmed!");
                        }
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                console.error(error);
            }
        });
    }

    var now = new Date();
    var millisTill7 = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 7, 0, 0, 0) - now;

    // Function to calculate and print time until the next interval
    function printTimeUntilNextInterval() {
        if (millisTill7 < 0) {
            millisTill7 += 86400000; // it's after 7am, try again tomorrow
        }
        var hoursTillNextInterval = Math.floor((millisTill7 % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutesTillNextInterval = Math.floor((millisTill7 % (1000 * 60 * 60)) / (1000 * 60));
        var secondsTillNextInterval = Math.floor((millisTill7 % (1000 * 60)) / 1000);

        console.log("Time until next interval: " + hoursTillNextInterval + " hours, " + minutesTillNextInterval + " minutes, " + secondsTillNextInterval + " seconds");
    }

    // Run the function initially
    loadAppointmentToSendNotification();

    // Calculate and print time until the next interval
    printTimeUntilNextInterval();

    // Set interval to run the function once a day at 7 am
    setTimeout(function() {
        setInterval(function() {
            loadAppointmentToSendNotification();
            printTimeUntilNextInterval();
        }, 24 * 60 * 60 * 1000); // 24 hours
    }, millisTill7);
});


function sendNotificationMessage(recipients, notificationMessages) {
    // Iterate over each recipient and message pair
    for (var i = 0; i < recipients.length; i++) {
        var recipientValue = recipients[i];
        var message = notificationMessages[i];

        // Split the recipient value using the separator ','
        var recipientsList = recipientValue.split(',');

        // Iterate over each number and send separate AJAX calls
        recipientsList.forEach(function(recipient) {
            // Trim any leading or trailing whitespace
            recipient = recipient.trim();

            // Collect form data for each number
            var formData = {
                number: recipient,
                message: message
            };

            console.log(formData);

            // Send AJAX request for each number
            $.ajax({
                type: 'POST',
                url: 'php/message-sender.php',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    console.log('Message sent successfully!');
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        });
    }
}



function sendConfirmationMessage(recipientFromDatabase, messageFromDatabase) {
    // get the value from the number input field
    var recipientValue = recipientFromDatabase;

    // split the value using the separator ','
    var recipients = recipientValue.split(',');

    // get the message value
    var message = messageFromDatabase;

    // iterate over each number and send separate AJAX calls
    recipients.forEach(function(recipient) {
        // trim any leading or trailing whitespace
        recipient = recipient.trim();

        // collect form data for each number
        var formData = {
            number: recipient,
            message: message
        };

        console.log(formData);

        //send AJAX request for each number
        $.ajax({
             type: 'POST',
             url: 'php/message-sender.php',
             data: formData,
             dataType: 'json',
             success: function(response) {
                 alert('Message sent successfully!');
             },
             error: function(xhr, status, error) {
                 // handle error
                console.error(xhr.responseText);
            }
         });
    });
    
}

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

                }else{

                }
            }
        });
    }
});
