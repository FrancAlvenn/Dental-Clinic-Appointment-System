<?php
// Setting header to JSON
header('Content-Type: application/json');

// Database configuration
define('DB_HOST', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'chat-feature');

// Get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Query to get data from the table
$query = "SELECT month, total_appointments, new_patient_appointment, followup_appointments FROM `appointment-trend`";

// Execute query
$result = $mysqli->query($query);

// Check if query was successful
if (!$result) {
    die("Query failed: " . $mysqli->error);
}

// Fetch data
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Free result set
$result->free();

// Close connection
$mysqli->close();

// Print the data as JSON
echo json_encode($data);
?>
