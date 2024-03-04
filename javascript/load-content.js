
$(document).ready(function() {
    // Define the AJAX function using a variable
    const fetchContent = function(url) {
        // AJAX request to load content from PHP file
        $.ajax({
          url: url, // URL of the PHP file
          type: 'GET',
          success: function(response) {
            $('.chat_box').html(response); // Insert content into container div
          },
          error: function() {
            console.error('Error loading content from ' + url);
          }
        });
      };

  
    // Call the AJAX function when the button is clicked

    //Function Call for Toggle

    //Function Call for Login Now
    $('.content-link-login').on('click', function(event) {
        event.preventDefault(); // Prevent the default action of the link
        fetchContent('login.php'); // Fetch content from login.php
    });

    // Function Call for Signup
    $('.content-link-signup').on('click', function(event) {
        event.preventDefault(); // Prevent the default action of the link
        fetchContent('signup.php'); // Fetch content from login.php
    });




  });