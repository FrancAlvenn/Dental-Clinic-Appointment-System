<?php
    session_start();
    include_once "config.php";
    $sql = "SELECT * FROM appointment_requests";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No appointments";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "schedule-data.php";
    }
    echo $output;
