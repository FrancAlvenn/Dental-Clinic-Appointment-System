<?php
// Database connection
session_start();
include 'config.php';
$unique_id = $_GET['unique_id'];


// Check if search term is provided
if (isset($_POST['searchTerm'])) {
    // Sanitize the search term to prevent SQL injection
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    // SQL query to search for users matching the search term
    $sql = "SELECT * FROM users
        WHERE unique_id != '$unique_id'
        AND (fname LIKE '%$searchTerm%'
        OR lname LIKE '%$searchTerm%'
        OR unique_id LIKE '%$searchTerm%'
        OR email LIKE '%$searchTerm%'
        OR status LIKE '%$searchTerm%'
        OR auth LIKE '%$searchTerm%')";


    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if any rows are returned
    if (mysqli_num_rows($result) > 0) {
        // Fetch and return the results as JSON
        $users = array();
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
        echo json_encode($users);
    } else {
        // No matching users found
        echo json_encode(array());
    }
} else {
    // Search term not provided
    echo json_encode(array());
}

// Close database connection
mysqli_close($conn);
?>
