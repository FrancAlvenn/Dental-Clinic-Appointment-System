const submitButton = document.querySelector('#submit-button');
const appointmentForm = document.querySelector('#appointmentForm');
const notification = document.querySelector(".alert");

// Add event listener for form submission
submitButton.addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default form submission

    // Serialize form data
    var formData = $(appointmentForm).serialize();

    // Submit form data via AJAX
    $.ajax({
        type: 'POST',
        url: 'php/submit-appointment.php',
        data: formData,
        success: function(response) {
        const res = jQuery.parseJSON(response);
            if(res.status == 422) {
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
                
            }else if(res.status == 200){
                $('.alert').removeClass("error");
                $('.alert').addClass("success");
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
            appointmentForm.reset();
        }
    });
});