<?php 
  session_start();
  include_once "../php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: /DentalClinicAppointment_SAD/admin/admin-login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link rel="stylesheet" href="../admin-style.css">
    <link rel="stylesheet" href="admin-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet" />

    <!-- JS for jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- JS for full calendar -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>

    <!-- bootstrap js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Dental Clinic Scheduling</title>
</head>
<body>
    <!-- Alert Notification -->
    <div class="notification-container d-flex  justify-content-between ">
        <div class="alert">
            <span class="fas fa-exclamation-circle"></span>
            <p class="alert-msg" style="margin: 5px 0px!important"></p>
        </div>
    </div>

    
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
            <a href="message-sender.php">
                <i class='bx bx-message-square-edit'></i>
            <span class="links_name">Compose Message</span>
            </a>
            <span class="tooltip">Compose Message</span>
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
    <script src="../javascript/sidebar.js"></script>