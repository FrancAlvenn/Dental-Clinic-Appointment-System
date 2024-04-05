$(document).ready(function() {
	display_events();
    setInterval(display_events, 500);
});

function display_events() {
	var events = new Array();
    console.log("update");
$.ajax({
    url: 'php/display-event-calendar.php',  
    dataType: 'json',
    success: function (response) {

    var result=response.data;

    $.each(result, function (i, item) {
    	events.push({
            request_id: result[i].request_id,
            title:result[i].title,
            firstname:result[i].firstname,
            lastname:result[i].lastname,
            start: result[i].start,
            end: result[i].end,
            service: result[i].service,
            status: result[i].status,
            email: result[i].email,
            phone: result[i].phone,
            comments: result[i].comments,
            color: result[i].color
        });
    })
	$('#calendar').fullCalendar({
	    defaultView: 'month',
		timeZone: 'local',
	    editable: false,
        selectable: true,
		selectHelper: true,
        select: function(start, end) {
				//alert(start);
				//alert(end);
				$('#event_start_date').val(moment(start).format('YYYY-MM-DD'));
				$('#event_end_date').val(moment(end).format('YYYY-MM-DD'));
				$('#event_entry_modal').modal('show');
			},
        events: events,
	    eventRender: function(event, element, view) {
            element.bind('click', function() {
                var popupContent = '<div class="modal-body">' +
                '<div id="errorMessage" class="alert alert-warning d-none"></div>' +
                '<div class="row mb-5 mb-lg-3 pt-4 mb-md-3 form-appointment">' +
                '<div class="col-6">' +
                '<div class="form-floating">' +
                '<input type="text" class="form-control" name="firstname" placeholder="First Name" required="" style="margin-right: 10px;" value="' + event.firstname + '" >' +
                '<label for="text">First Name*</label>' +
                '</div>' +
                '</div>' +
                '<div class="col-6">' +
                '<div class="form-floating">' +
                '<input type="text" class="form-control" name="lastname" placeholder="First Name" required="" value="' + event.lastname + '" >' +
                '<label for="text">Last Name*</label>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="row mb-5 mb-lg-3 mb-md-3 form-appointment">' +
                '<div class="col-6">' +
                '<div class="form-floating">' +
                '<input type="email" class="form-control" name="email" placeholder="Enter your email here:" required="" value="' + event.email + '" >' +
                '<label for="email">Email*</label>' +
                '<div class="invalid-feedback">Invalid Email</div>' +
                '<div class="valid-feedback">Valid Email</div>' +
                '</div>' +
                '</div>' +
                '<div class="col-6">' +
                '<div class="form-floating">' +
                '<input type="tel" class="form-control" name="phone_number" placeholder="Enter your phone number here" required="" value="' + event.phone + '" >' +
                '<label for="number">Phone Number*</label>' +
                '<div class="invalid-feedback">Invalid Phone Number</div>' +
                '<div class="valid-feedback">Valid Phone Number</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="row mb-5 mb-lg-3 mb-md-3 form-appointment">' +
                '<div class="col-7">' +
                '<div class="form-floating">' +
                '<input type="text" class="form-control" name="service" placeholder="Enter service here" value="' + event.service + '" >' +
                '<label for="other_service">Service</label>' +
                '</div>' +
                '</div>' +
                '<div class="col-5">' +
                '<div class="form-floating">' +
                '<select class="form-select" name="status" id="status">' +
                '<option value="confirmed" ' + (event.status === 'confirmed' ? ' selected' : '') + '>Confirmed</option>' +
                '<option value="pending" ' + (event.status === 'pending' ? ' selected' : '') + '>Pending</option>' +
                '<option value="rejected" ' + (event.status === 'rejected' ? ' selected' : '') + '>Rejected</option>' +
                '</select>' +
                '<label for="status">Status</label>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="form-floating mb-5 mb-lg-3 mb-md-3 form-appointment">' +
                '<input type="date" class="form-control" name="preferred_date" placeholder="Enter your preferred date" required="" value="' + moment(event.start).format('YYYY-MM-DD') + '" >' +
                '<label for="date">Preferred Date*</label>' +
                '<div class="invalid-feedback">Invalid Date</div>' +
                '<div class="valid-feedback">Valid Date</div>' +
                '</div>' +
                '<div class="form-floating mb-5 mb-lg-3 mb-md-3 form-appointment">' +
                '<input type="time" class="form-control" name="preferred_time" placeholder="Enter your preferred time" required="" value="' + moment(event.start).format('HH:mm') + '" >' +
                '<label for="time">Preferred Time*</label>' +
                '<div class="invalid-feedback">Invalid Time</div>' +
                '<div class="valid-feedback">Valid Time</div>' +
                '</div>' +
                '<div class="form-floating mb-5 mb-lg-3 mb-md-3 form-appointment">' +
                '<textarea class="form-control" id="textarea" rows="4" name="comments" placeholder="Comments/Concerns" style="height: 200px; resize: none;" >' + event.comments + '</textarea>' +
                '<label for="textarea">Comments/Concerns</label>' +
                '</div>' +
                '</div>' +
                '<div class="modal-footer">' +
                '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>' +
                '<button type="button" value="'+ event.request_id +'" class="deleteButton btn btn-danger">Delete</button>'+
                '<button type="submit" value="'+ event.request_id +'" class="btn btn-primary updateButton">Update Appointment</button>'+
                '</div>';

                 // Set the content of the modal body
                 $('#updateAppointment').html(popupContent);

                 // Show the modal
                 $('#appointmentEditModal').modal('show'); 
				});
    	}
		}); //end fullCalendar block	
	  },//end success block
	  error: function (xhr, status) {
	//   alert(response.msg);
	  }
	});//end ajax block	
}