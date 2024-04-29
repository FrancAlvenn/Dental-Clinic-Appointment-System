<?php
include_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["action"]) && $_GET["action"] == "get_contacts") {
    // Fetch contacts from the database
    $query = "SELECT * FROM appointment_requests ORDER BY firstname ASC";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $contacts = array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Append each contact to the array
                $contacts[] = $row;
            }
        }

        $totalContacts = mysqli_num_rows($result);

        // Close database connection
        mysqli_close($conn);

        // Construct the response object
        $response = array(
            'success' => true,
            'contacts' => $contacts,
            'count' => $totalContacts
        );

        // Return the response as JSON
        header('Content-Type: application/json');
        echo json_encode($response);
        exit; // Stop further execution
    } else {
        // Database query failed
        $response = array(
            'success' => false,
            'message' => 'Database query failed',
            'count' => $totalContacts
        );

        // Return the response as JSON
        header('Content-Type: application/json');
        echo json_encode($response);
        exit; // Stop further execution
    }
}
