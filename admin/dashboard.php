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
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Chat Feature</title>
</head>
<body>
    <div class="sidebar">
        <div class="logo-details">
        <i class='bx bxs-user-circle icon'></i>
            <div class="logo_name">Administrator</div>
            <i class='bx bx-menu' id="btn" ></i>
        </div>
        <ul class="nav-list">
        <li>
            <a href="dashboard.php">
            <i class='bx bx-grid-alt'></i>
            <span class="links_name">Dashboard</span>
            </a>
            <span class="tooltip">Dashboard</span>
        </li>
        <li>
        <a href="schedule.php">
            <i class='bx bx-calendar-event' ></i>
            <span class="links_name">Schedule</span>
        </a>
        <span class="tooltip">Schedule</span>
        </li>
        <li>
            <a href="calendar.php">
            <i class='bx bx-calendar' ></i>
            <span class="links_name">Calendar</span>
            </a>
            <span class="tooltip">Calendar</span>
        </li>
        <li>
        <a href="users.php">
            <i class='bx bx-chat' ></i>
            <span class="links_name">Messages</span>
        </a>
        <span class="tooltip">Messages</span>
        </li>
        <li>
            <a href="patient-list.php">
                <i class='bx bxs-user-detail' ></i>
            <span class="links_name">Patient List</span>
            </a>
            <span class="tooltip">Patient List</span>
        </li>
        
        <li class="profile">
            <div class="profile-details">
                <a href="php/logout-admin.php?logout_id=1285204382">
                    <i class='bx bx-log-out' ></i>
                    <span class="links_name">Logout</span>
                </a>
                <span class="tooltip">Logout</span>
            </div>

        </li>
        </ul>
    </div>
    <script src="javascript/sidebar.js"></script>

        <div class="container">
                <div class=" p-4">
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

                    <div class="row box-body   ">
                        <div class="center-div chat-space-admin d-flex flex-column align-items-center justify-content-center ">
                        <!-- Dashboard -->
                        <div class="chart-container d-flex justify-content-center align-content-center">
                            <canvas id="mycanvas" >

                            </canvas>
                        </div>

                        <!-- javascript -->
                        <script type="text/javascript" src="javascript/jquery.min.js"></script>
                        <script type="text/javascript" src="javascript/Chart.min.js"></script>
                        <script type="text/javascript" src="javascript/linegraph.js"></script>
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
