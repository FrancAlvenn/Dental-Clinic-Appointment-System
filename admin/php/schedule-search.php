<?php
    session_start();
    include_once "config.php";
    if(isset($_GET['date'])) {
        $selectedDate = $_GET['date'];
    } else {
        // Default to current date if no date is provided
        $selectedDate = date('Y-m-d');
    }
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    $sql = "SELECT * FROM appointment_requests
        WHERE DATE(preferred_date) = '$selectedDate'
        AND status = 'confirmed'
        AND (firstname LIKE '%$searchTerm%' OR lastname LIKE '%$searchTerm%')";

    $output = "";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        include_once "schedule-data.php";
    }else{
        $output .= '... No user found related to your search term';
    }
    echo $output;
?>