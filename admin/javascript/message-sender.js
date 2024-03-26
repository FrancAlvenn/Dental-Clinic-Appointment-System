$(document).ready(function() {
    $('#smsForm').submit(function(event) {
        // Prevent default form submission
        event.preventDefault();

        // Collect form data
        var formData = {
            number: $('#number').val(),
            message: $('#message').val()
        };

        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: 'php/message-sender.php',
            data: formData,
            dataType: 'json',
            success: function(response) {
                alert('Message sent!');
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(xhr.responseText);
                alert('Error: Message not sent.');
            }
        });
    });
});
