<?php
include_once "config.php";
// Fetch patient data from the database
$sql = "SELECT * FROM users WHERE unique_id != " . $_SESSION['unique_id'];

$result = mysqli_query($conn, $sql);

$users = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        $users[] = array(
            'id' => $row['unique_id'],
            'firstname' => $row['fname'],
            'lastname' => $row['lname'],
            'email' => $row['email'],
            'status' => $row['status'],
            'auth' => $row['auth']
        );
    }
}

// Return patient data as JSON
header('Content-Type: application/json');
echo json_encode($users);