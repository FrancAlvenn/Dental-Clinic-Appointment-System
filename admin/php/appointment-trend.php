<?php
// Setting header to JSON
header('Content-Type: application/json');
session_start();
include_once "config.php";
if(!isset($_SESSION['unique_id'])){
  header("location: ../login.php");
}

// Get connection
$mysqli = new mysqli($hostname, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Initialize an array to store the data
$data = array();

// Loop through each month and status combination
for ($month = 1; $month <= 12; $month++) {
    // Initialize counters for confirmed, pending, and total appointments
    $confirmed_count = 0;
    $pending_count = 0;
    $total_count = 0;

    // Query to get data from the table for the current month and status
    $query = "SELECT COUNT(*) AS count, status FROM appointment_requests
              WHERE MONTH(preferred_date) = $month
              GROUP BY status";

    // Execute query
    $result = $mysqli->query($query);

    // Check if query was successful
    if ($result) {
        // Fetch data
        while ($row = $result->fetch_assoc()) {
            if ($row['status'] == 'confirmed') {
                $confirmed_count = $row['count'];
            } elseif ($row['status'] == 'pending') {
                $pending_count = $row['count'];
            }
            // Update total count
            $total_count += $row['count'];
        }
        // Free result set
        $result->free();
    } else {
        // Handle query error
        die("Query failed: " . $mysqli->error);
    }

    $month_name = date("F", mktime(0, 0, 0, $month, 1));
    // Store the data in an associative array
    $data[$month_name] = array(
        'month' => $month_name,
        'total_appointment' => $total_count,
        'confirmed_appointment' => $confirmed_count,
        'pending_appointment' => $pending_count
        
    );
}

// Close connection
$mysqli->close();

// Print the data as JSON
echo json_encode($data);
?>
