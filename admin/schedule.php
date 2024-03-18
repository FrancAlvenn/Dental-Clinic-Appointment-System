<?php 
  session_start();
  include_once "../php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: ../login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link rel="stylesheet" href="admin-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <title>Chat Feature</title>
</head>
<body>

    <!-- Alert Notification -->
    <div class="notification-container d-flex  justify-content-between ">
        <div class="alert">
            <span class="fas fa-exclamation-circle"></span>
            <p class="alert-msg" style="margin: 5px 0px!important"></p>
        </div>
    </div>

    <div class="container pt-5 ">
            <div class="row ">
                <div class="col-3 pt-5 ">
                    <div class="box d-flex flex-column align-items-between justify-content-between ">
                        <div class="header">
                            <div class="row d-flex align-items-center justify-content-center pt-5">
                                <div class="col-auto "><i class="fa-solid fa-user-tie"></i></div>
                                <div class="col-auto"><h5 style="margin:0;">Administrator</h5></div>
                            </div>
                        </div>
                        <div class="body">
                            <div class="row d-flex align-items-center justify-content-center pt-5">
                                <div class="col-2 "><i class="fa-solid fa-gauge-high"></i></div>
                                <div class="col-5">
                                    <a href="dashboard.php" class="sidebar-link"" >Dashboard</a>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center justify-content-center pt-5">
                                <div class="col-2 "><i class="fa-solid fa-clipboard-list"></i></div>
                                <div class="col-5">
                                    <a href="schedule.php" class="sidebar-link" id="current-page">Schedule</a>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center justify-content-center pt-5">
                                <div class="col-2 "><i class="fa-solid fa-calendar-days"></i></div>
                                <div class="col-5">
                                    <a href="calendar.php" class="sidebar-link">Calendar</a>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center justify-content-center pt-5">
                                <div class="col-2 "><i class="fa-solid fa-envelope"></i></div>
                                <div class="col-5">
                                    <a href="users.php" class="sidebar-link">Messages</a>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center justify-content-center pt-5">
                                <div class="col-2 "><i class="fa-solid fa-hospital-user"></i></div>
                                <div class="col-5">
                                    <a href="patient-list.php" class="sidebar-link">Patient List</a>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <div class="row d-flex align-items-center justify-content-center pt-5 pb-5 ">
                                <div class="col-3"><i class="fa-solid fa-right-from-bracket"></i></div>
                                <div class="col-4">
                                    <a href="php/logout-admin.php?logout_id=1285204382" class="sidebar-link">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-9 pt-5 ">
                    <div class="row box-body " style="height:745px;">
                    
                        <div class="center-div chat-space-admin d-flex justify-content-center">
                        
                        <!-- Schedule -->
                        <section class="schedule">
                            <div class="container d-flex justify-content-between mb-3 ">
                                <h6 style="margin-bottom:15px!important;">Appointment List</h6>
                                <button type="button" class="btn float-end" data-bs-toggle="modal" data-bs-target="#add_appointment">
                                    Add Appointment
                                </button>
                            </div>
                            
                            <header style="display: flex; justify-content: space-between;margin-bottom: 10px;">
                            <div class="form-floating form-appointment">
                                <input type="date" class="form-control input-date" name="schedule_date" placeholder ="Enter a date" style="font-size:12px;" value="<?php echo date('Y-m-d'); ?>">
                                <label for="date">Date</label>
                                <div class="invalid-feedback">Invalid Date</div>
                                <div class="valid-feedback">Valid Date</div>
                            </div>
                            
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="appointment-status" id="confirm-radio">
                                <label class="form-check-label custom-radio confirm-radio" for="confirm-radio">
                                    Confirmed
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="appointment-status" id="pending-radio">
                                <label class="form-check-label custom-radio pending-radio" for="pending-radio">
                                    Pending
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="appointment-status" id="rejected-radio">
                                <label class="form-check-label custom-radio rejected-radio" for="rejected-radio">
                                    Rejected
                                </label>
                            </div>

                                <div class="search" style="margin: 5px 0;">
                                    <span class="text" ></span>
                                    <input type="text" placeholder="Enter name to search...">
                                    <button><i class="fas fa-search"></i></button>
                                </div>
                            </header>
                            <div class="schedule-list">
                            <div class="row mb-5 schedule-list-area">
                                <!-- Schedule List Area -->
                                
                            </div>
                            </div>

                          </section>

                        <script src="javascript/schedule.js"></script>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                
            </div>
    </div>


    <!-- Add Appointment -->

    <div class="modal fade" id="add_appointment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="saveAppointment">
                <div class="modal-body">
                    <div id="errorMessage" class="alert alert-warning d-none"></div>
                        <div class="row mb-5 mb-lg-3 pt-4 mb-md-3 form-appointment">
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="firstname" placeholder="First Name" required="" style="margin-right: 10px;">
                                    <label for="text">First Name*</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="lastname" placeholder="First Name" required="">
                                    <label for="text">Last Name*</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5 mb-lg-3 mb-md-3 form-appointment">
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="email" placeholder="Enter you email here:" required="">
                                    <label for="email">Email*</label>
                                    <div class="invalid-feedback">Invalid Email</div>
                                    <div class="valid-feedback">Valid Email</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="number_format" class="form-control" name="phone_number" placeholder="Enter you phone number here" required="">
                                    <label for="number">Phone Number*</label>
                                    <div class="invalid-feedback">Invalid Phone Number</div>
                                    <div class="valid-feedback">Valid Phone Number</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-floating mb-5 mb-lg-3 mb-md-3 form-appointment">
                            <input type="text" class="form-control" name="service" placeholder="Enter service here">
                            <label for="other_service">Service</label>
                        </div>

                                            
                        <div class="form-floating mb-5 mb-lg-3 mb-md-3 form-appointment">
                            <input type="date" class="form-control" name="preferred_date" placeholder="Enter your preferred date" required="">
                            <label for="date">Preferred Date*</label>
                            <div class="invalid-feedback">Invalid Date</div>
                            <div class="valid-feedback">Valid Date</div>
                        </div>
                        <div class="form-floating mb-5 mb-lg-3 mb-md-3 form-appointment">
                            <input type="time" class="form-control" name="preferred_time" placeholder="Enter your preferred time" required="">
                            <label for="time">Preferred Time*</label>
                            <div class="invalid-feedback">Invalid Time</div>
                            <div class="valid-feedback">Valid Time</div>
                        </div>
                        <div class="form-floating mb-5 mb-lg-3 mb-md-3 form-appointment">
                            <textarea class="form-control" id="textarea" rows="4" name="comments" placeholder="Comments/Concerns" style="height: 200px; resize: none;"></textarea>
                            <label for="textarea">Comments/Concerns</label>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Appointment</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- Update/Edit Appointment -->

    <div class="modal fade" id="appointmentEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateAppointment">
            <div class="modal-body">
                    <div id="errorMessage" class="alert alert-warning d-none"></div>
                        <div class="row mb-5 mb-lg-3 pt-4 mb-md-3 form-appointment">
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="firstname" placeholder="First Name" required="" style="margin-right: 10px;">
                                    <label for="text">First Name*</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="lastname" placeholder="First Name" required="">
                                    <label for="text">Last Name*</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5 mb-lg-3 mb-md-3 form-appointment">
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="email" placeholder="Enter you email here:" required="">
                                    <label for="email">Email*</label>
                                    <div class="invalid-feedback">Invalid Email</div>
                                    <div class="valid-feedback">Valid Email</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="number_format" class="form-control" name="phone_number" placeholder="Enter you phone number here" required="">
                                    <label for="number">Phone Number*</label>
                                    <div class="invalid-feedback">Invalid Phone Number</div>
                                    <div class="valid-feedback">Valid Phone Number</div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5 mb-lg-3 mb-md-3 form-appointment">
                            <div class="col-7">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="service" placeholder="Enter service here">
                                <label for="other_service">Service</label>
                            </div>
                            </div>
                            <div class="col-5">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="status" placeholder="Enter status here">
                                <label for="status">Status</label>
                            </div>
                            </div>
                        </div>


                        <div class="form-floating mb-5 mb-lg-3 mb-md-3 form-appointment">
                            <input type="date" class="form-control" name="preferred_date" placeholder="Enter your preferred date" required="">
                            <label for="date">Preferred Date*</label>
                            <div class="invalid-feedback">Invalid Date</div>
                            <div class="valid-feedback">Valid Date</div>
                        </div>
                        <div class="form-floating mb-5 mb-lg-3 mb-md-3 form-appointment">
                            <input type="time" class="form-control" name="preferred_time" placeholder="Enter your preferred time" required="">
                            <label for="time">Preferred Time*</label>
                            <div class="invalid-feedback">Invalid Time</div>
                            <div class="valid-feedback">Valid Time</div>
                        </div>
                        <div class="form-floating mb-5 mb-lg-3 mb-md-3 form-appointment">
                            <textarea class="form-control" id="textarea" rows="4" name="comments" placeholder="Comments/Concerns" style="height: 200px; resize: none;"></textarea>
                            <label for="textarea">Comments/Concerns</label>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" value="" class="deleteButton btn btn-danger">Delete</button>
                    <button type="submit" value="" class="btn btn-primary updateButton">Update Appointment</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    


    <script src="javascript/schedule-crud.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script>
        $(document).ready(function() {
            // Define the AJAX function using a variable
            const fetchContent = function(url) {
                // AJAX request to load content from PHP file
                $.ajax({
                url: url, // URL of the PHP file
                type: 'GET',
                success: function(response) {
                    $('.chat-space-admin').html(response); // Insert content into container div
                },
                error: function() {
                    console.error('Error loading content from ' + url);
                }
                });
            };

            window.onload = function() {
                // fetchContent('../login.php');
                console.log("Page loaded");
            };
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>
</html>
