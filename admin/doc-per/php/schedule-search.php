<?php
session_start();
include_once "config.php";

$status = mysqli_real_escape_string($conn, $_POST['status']);
$selectedDate = mysqli_real_escape_string($conn, $_POST['date']);
$comboBoxSelect = mysqli_real_escape_string($conn, $_POST['comboBoxSelect']);
$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
$output = '';

$colorText;
    $text;
    if($status === 'confirmed'){
        $colorText = "color:green!important";
        $text = "confirmed";
    }else if($status === 'pending'){
        $colorText = "color:orange!important";
        $text = "pending";
    }else{
        $colorText = "color:red!important";
        $text = "rejected";
    }


    $months = [
        '1' => 'January',
        '2' => 'February',
        '3' => 'March',
        '4' => 'April',
        '5' => 'May',
        '6' => 'June',
        '7' => 'July',
        '8' => 'August',
        '9' => 'September',
        '10' => 'October',
        '11' => 'November',
        '12' => 'December'
    ];    

if ($comboBoxSelect === "all") {
    // Retrieve all appointments regardless of status
    $sql = "SELECT * FROM appointment_requests WHERE (firstname LIKE '%$searchTerm%' OR lastname LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%') ORDER BY preferred_date, TIME(preferred_time)";
    $text .= "No appointments found!";
} elseif ($comboBoxSelect === "upcoming") {
    // Retrieve upcoming appointments based on the current date
    $sql = "SELECT * FROM appointment_requests WHERE status = '$status' AND preferred_date >= CURDATE() AND (firstname LIKE '%$searchTerm%' OR lastname LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%') ORDER BY preferred_date, TIME(preferred_time) ";
    $text .= "No upcoming appointments found!";
} elseif ($comboBoxSelect === "past") {
    // Retrieve past appointments based on the current date
    $sql = "SELECT * FROM appointment_requests WHERE status = '$status' AND preferred_date < CURDATE() AND (firstname LIKE '%$searchTerm%' OR lastname LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%') ORDER BY preferred_date DESC, TIME(preferred_time) DESC";
    $text .= "No past appointments found!";
} elseif (in_array($comboBoxSelect, ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'])) {
    // Retrieve appointments for a specific month
    $selectedMonth = $months[$comboBoxSelect];
    $sql = "SELECT * FROM appointment_requests WHERE status = '$status' AND MONTH(preferred_date) = '$comboBoxSelect' AND (firstname LIKE '%$searchTerm%' OR lastname LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%') ORDER BY preferred_date, TIME(preferred_time)";
    $text .= "No appointments found in " . $selectedMonth;
}else{
    $sql = "SELECT * FROM appointment_requests WHERE preferred_date = '$selectedDate' AND (firstname LIKE '%$searchTerm%' OR lastname LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%') ORDER BY preferred_date, TIME(preferred_time)";
    $text .= "No appointments found on " .  $selectedDate;
}


$query2 = mysqli_query($conn, $sql);

// Check if there are appointments based on the search term
if (mysqli_num_rows($query2) > 0) {
    // Loop through the appointments
    while ($row2 = mysqli_fetch_assoc($query2)) {
        $output .= '<div class="col d-flex justify-content-center align-items-center pb-5 col-xl-4">
                    <div class="card" style="width: 30rem;">
                        <div class="container pt-3">
                            <i class="fas fa-circle" style="'. $colorText .'"></i>
                            <h4 class="card-title text-center pt-3">' . $row2['service'] . '</h4>
                            <div class="card-body text-center">
                                <p class="card-text">' . $row2['firstname'] . ' ' . $row2['lastname'] . '</p>
                                <h6>' . $row2['preferred_date'] . '</h6>
                                <h6>' . $row2['preferred_time'] . '</h6>
                            </div>
                        </div>
                        <button type="button" value="' . $row2['request_id'] . '" class="editAppointment btn p-3">View Details</button>
                    </div>
                </div>';
    }
} else {
    // No appointments based on the search term
    $output = " ...  There is no appointment based on your search";
}

echo $output;
?>
