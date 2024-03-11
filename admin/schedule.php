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

    <title>Chat Feature</title>
</head>
<body>
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
                    <div class="row box-header">
                        <div class="center-div chat-space-admin d-flex align-items-center justify-content-around text-center ">
                        <!-- Dashboard Header-->
                                <div class="col-3 ">
                                    <div class="row">
                                        <div class="col-4 d-flex align-items-center">
                                            <i class="fa-solid fa-users"></i>
                                        </div>
                                        <div class="col-8 ">
                                            <div class="row ">
                                                <div class="col mt-2 ">
                                                    <h6 class="number_of_patients" style="font-size: 13px">Number of Patients</h6>
                                                </div>
                                            </div>
                                            <div class="row mt-2 ">
                                                <div class="col ">
                                                    <h3>20</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="vertical-line"></div>
                                <div class="col-3 ">
                                    <div class="row">
                                        <div class="col-4 d-flex align-items-center">
                                            <i class="fa-solid fa-user-plus"></i>
                                        </div>
                                        <div class="col-8 ">
                                            <div class="row ">
                                                <div class="col mt-2 ">
                                                    <h6 class="number_of_patients" style="font-size: 13px">New Patients</h6>
                                                </div>
                                            </div>
                                            <div class="row mt-2 ">
                                                <div class="col ">
                                                    <h3>5</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="vertical-line"></div>
                                <div class="col-3 ">
                                    <div class="row">
                                        <div class="col-4 d-flex align-items-center">
                                        <i class="fa-solid fa-address-book" style="font-size: 19px;"></i>
                                        </div>
                                        <div class="col-8 ">
                                            <div class="row ">
                                                <div class="col mt-2 ">
                                                    <h6 class="number_of_patients" style="font-size: 13px">Total Patients</h6>
                                                </div>
                                            </div>
                                            <div class="row mt-2 ">
                                                <div class="col ">
                                                    <h3>120</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="row box-body p-5 ">
                        <div class="center-div chat-space-admin d-flex flex-column align-items-center justify-content-center ">
                        <!-- Dashboard -->

                        </div>
                    </div>

                </div>
            </div>
    </div>


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