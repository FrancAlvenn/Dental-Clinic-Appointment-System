<?php
include_once "config.php";
// Fetch patient data from the database
$sql = "SELECT * FROM patient_list";
$result = mysqli_query($conn, $sql);

$patients = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $address = '';
        if (!empty($row['street'])) {
            $address .= $row['street'] . ', ';
        }
        if (!empty($row['baranggay'])) {
            $address .= $row['baranggay'] . ', ';
        }
        if (!empty($row['city_municipality'])) {
            $address .= $row['city_municipality'] . ', ';
        }
        if (!empty($row['province'])) {
            $address .= $row['province'];
        }

        $patients[] = array(
            'patient_id' => $row['patient_id'],
            'firstname' => $row['firstname'],
            'lastname' => $row['lastname'],
            'email' => $row['email'],
            'phone_number' => $row['phone_number'],
            'date_of_birth' => $row['date_of_birth'],
            'address' => $address,
        );
    }
}

// Return patient data as JSON
header('Content-Type: application/json');
echo json_encode($patients);