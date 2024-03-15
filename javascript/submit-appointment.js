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
        url: 'php/submit-appointment.php', // Replace with your server-side endpoint
        data: formData,
        success: function(response) {
           // Show the notification popup
           $('.alert').addClass("show");
           $('.alert').removeClass("hide");
           $('.alert').addClass("showAlert");
           setTimeout(function(){
               $('.alert').removeClass("show");
               $('.alert').addClass("hide");
           }, 5000);

           // Clear form values
           appointmentForm.reset();
        },
        error: function(xhr, status, error) {
            // Handle error (e.g., display error message)
            console.error('Error:', error);
        }
    });
});