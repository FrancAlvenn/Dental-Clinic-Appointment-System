$(document).ready(function() {
    //declarations
    let selectedContacts = [];


    //function to auto adjust the textarea for the recipient input field
    function autoAdjustTextarea() {
        var textarea = document.getElementById('number');
        textarea.style.height = 'auto';
        textarea.style.height = (textarea.scrollHeight) + 'px';
    }

    //event listener on change of checkbox and adjust the selected innerHTML
    $('.list-group').on('change', 'input.contact-checkbox', function() {
        document.querySelector('.selected-info').innerHTML =  $('.contact-checkbox:checked').length + " selected!";
    });


    // event lister on select contact button to show contact on the input field
    // and store the contact email and phone in an array
    $('.selectContact').on('click', function() {
        // clear selectedContacts array
        selectedContacts = [];

        // iterate over checked checkboxes and push their data-contact-id value to selectedContacts
        $('.contact-checkbox:checked').each(function() {
            selectedContacts.push($(this).data('contact-id'));
        });

        // split the input field value by comma and add its contents to selectedContacts array
        var inputFieldValue = $('#number').val();
        if (inputFieldValue) {
            var inputContacts = inputFieldValue.split(', ');
            selectedContacts = selectedContacts.concat(inputContacts);
        }

        // update the input field value with the combined list of contacts
        $('#number').val(selectedContacts.join(', '));

        // auto adjust the height of the textarea
        autoAdjustTextarea();

        // close the modal
        $('#contactSelectorModal').modal('hide');
    });

    // event listener on the unselect all button
    // to uncheck all checkboxes and clear the input field
    $('.unselectContact').on('click', function() {
        console.log("unselect all clicked");
        $('.contact-checkbox').prop('checked', false);
        $('#number').val('');
        document.querySelector('.selected-info').innerHTML =  "0 selected!";
    });

    // event listener on document ready to show the contact selector modal on page load.
    // The AJAX request is sent to fetch the contacts and the contacts are inserted into the modal.
    // The modal is shown when the icon is clicked.
    // The contact selector modal is used to select the contacts to send the message to.
    // The selected contacts are stored in an array and the input field is updated with the selected contacts.
    // The contact selector modal is hidden when the select contact button is clicked.
    // The message is sent to the selected contacts using AJAX request.
    $(document).ready(function() {
        // open contact selector modal when the icon is clicked
        $('#openContactSelector').click(function(e) {
            e.preventDefault();
            $('#contactSelectorModal').modal('show');
            selectedContacts = [];
            document.querySelector('.selected-info').innerHTML =  "0 selected!";
            // Send AJAX request to fetch contacts
            $.ajax({
                type: 'GET',
                url: 'php/get-contacts.php',
                data: { action: 'get_contacts' },
                dataType: 'json',
                success: function(response) {
                    // Insert contacts into the modal
                    if (response.success) {
                        var contacts = response.contacts;
                        var output = '';
                        contacts.forEach(function(contact) {
                            output += '<li class="list-group-item">' +
                                        '<label>' +
                                            '<input type="checkbox" class="contact-checkbox" data-contact-id="' + contact.email +','+ contact.phone_number + '">' +
                                            '<span class="contact-name">' + contact.firstname + ' ' + contact.lastname + '</span>' +
                                            '<span class="contact-email">' + contact.email + '</span>' +
                                            '<span class="contact-phone">' + contact.phone_number + '</span>' +
                                        '</label>' +
                                    '</li>';

                        });
                        $('.numContact').html(response.count + " contacts available!");
                        $('.list-group').html(output);
                    } else {
                        console.error('Error fetching contacts:', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error('Error fetching contacts:', error);
                }
            });
        });
    });


    //message submission event listener on the form submit button to send the message to the selected contacts
    // and handle the response from the server using AJAX request.
    // The form data is collected and sent to the server using AJAX request.
    // The response from the server is handled using the success and error callbacks.
    $('#smsForm').submit(function(event) {
        // prevent default form submission
        event.preventDefault();

        // get the value from the number input field
        var numberValue = $('#number').val();

        // split the value using the separator ','
        var numbers = numberValue.split(',');

        // get the message value
        var message = $('#message').val();

        // iterate over each number and send separate AJAX calls
        numbers.forEach(function(number) {
            // trim any leading or trailing whitespace
            number = number.trim();

            // collect form data for each number
            var formData = {
                number: number,
                message: message
         };
    
            // send AJAX request for each number
            $.ajax({
                type: 'POST',
                url: 'php/message-sender.php',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    console.log('Message sent to: ' + number);
                },
                error: function(xhr, status, error) {
                    // handle error
                    console.error(xhr.responseText);
                    alert('Error: Message not sent to ' + number);
                }
            });
        });
        alert('Message sent successfully!');
    });
});



$(document).ready(function() {
    let searchBar = document.querySelector(".search input"),
        searchIcon = document.querySelector(".search button");
    
    let scheduleIntervalId;
  
    searchIcon.onclick = () => {
        searchBar.classList.toggle("show");
        searchIcon.classList.toggle("active");
        searchBar.focus();
        if (searchBar.classList.contains("active")) {
            searchBar.value = "";
            searchBar.classList.remove("active");
            searchBar.value = "";
            fetchAndDisplayPatients();
        }
      }
    
  
    searchBar.onkeyup = () => {
        let searchTerm = searchBar.value;
        if (searchTerm != "") {
            searchBar.classList.add("active");
        } else {
            searchBar.classList.remove("active");
        }
        searchContact(searchTerm);
    }

    function searchContact(searchTerm) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "php/contact-search.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    var contacts = response.contacts;
                    var output = '';
                    contacts.forEach(function(contact) {
                        output += '<li class="list-group-item">' +
                                    '<label>' +
                                        '<input type="checkbox" class="contact-checkbox" data-contact-id="' + contact.email +','+ contact.phone_number + '">' +
                                        '<span class="contact-name">' + contact.firstname + ' ' + contact.lastname + '</span>' +
                                        '<span class="contact-email">' + contact.email + '</span>' +
                                        '<span class="contact-phone">' + contact.phone_number + '</span>' +
                                    '</label>' +
                                '</li>';
                    });
                    $('.numContact').html(response.count + " contacts available!");
                    $('.list-group').html(output);
                }
            }
        };
        xhr.send("searchTerm=" + searchTerm);
    }
  });
  
