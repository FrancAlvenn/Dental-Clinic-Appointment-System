<?php
// Database connection
include 'config.php';

// Check if search term is provided
if (isset($_POST['searchTerm'])) {
    // Sanitize the search term to prevent SQL injection
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    // SQL query to search for patients matching the search term
    $sql = "SELECT * FROM patient_list 
            WHERE firstname LIKE '%$searchTerm%' 
            OR lastname LIKE '%$searchTerm%' 
            OR email LIKE '%$searchTerm%' 
            OR phone_number LIKE '%$searchTerm%'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if any rows are returned
    if (mysqli_num_rows($result) > 0) {
        // Fetch and return the results as JSON
        $patients = array();
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
        echo json_encode($patients);
    } else {
        // No matching patients found
        echo json_encode(array());
    }
} else {
    // Search term not provided
    echo json_encode(array());
}

// Close database connection
mysqli_close($conn);
?>
