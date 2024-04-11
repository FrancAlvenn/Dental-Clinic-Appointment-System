<?php
// Database connection
include 'config.php';

// Check if search term is provided
if (isset($_POST['searchTerm'])) {
    // Sanitize the search term to prevent SQL injection
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    // SQL query to search for contacts with first name, last name, email, or phone number that contains the search term
    $sql = "SELECT * FROM appointment_requests
            WHERE firstname LIKE '%$searchTerm%'
            OR lastname LIKE '%$searchTerm%'
            OR email LIKE '%$searchTerm%'
            OR phone_number LIKE '%$searchTerm%'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if any rows are returned
    if (mysqli_num_rows($result) > 0) {
        // Fetch and return the results as JSON
        $contacts = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $contacts[] = $row;
        }
        $totalContacts = mysqli_num_rows($result);
        // Construct the response object
        $response = array(
            'success' => true,
            'contacts' => $contacts,
            'count' => $totalContacts
        );

        // Return the response as JSON
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
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
