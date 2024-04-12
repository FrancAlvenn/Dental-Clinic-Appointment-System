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
    <link rel="stylesheet" href="../admin-style.css">
    <link rel="stylesheet" href="admin-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <!-- JS for jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- JS for full calendar -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/js/all.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    

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

    <div class="notification-area">
        <div class="dropdown">
            
            <a href="#" class="dropdown-toggle" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none !important;">
                <span class="badge bg-danger rounded-pill count"></span>
                <span><i class="fa-solid fa-bell fa-shake" style="font-size:20px;"></i></span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li class="dropdown-header">Notifications<span><a href="#">Mark all as read</a></span></li>
            <hr style="width: 90%; margin: 15px auto;">
            <div class="notifications-items">

            </div>
            </ul>
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
        <li>
            <a href="all-user-list.php">
              <i class='bx bxs-user-account'></i>
            <span class="links_name">User List</span>
            </a>
            <span class="tooltip">User List</span>
        </li>
        <li class="profile">
            <div class="profile-details">
                <a href="php/logout-admin.php?logout_id=1285204384">
                    <i class='bx bx-log-out' ></i>
                    <span class="links_name">Logout</span>
                </a>
                <span class="tooltip">Logout</span>
            </div>

        </li>
        </ul>
    </div>


    <?php include_once "sched-crud.php"; ?>

    <script src="javascript/fetchNotification.js"></script>
    <script src="javascript/sidebar.js"></script>
    <script src="../javascript/sidebar.js"></script>