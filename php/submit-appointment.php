<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    include_once "config.php";

    // Check if all form fields are filled
    if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['phone_number']) || empty($_POST['preferred_date']) || empty($_POST['preferred_time'])) {
        $res = [
            'status' => 422,
            'message' => 'Please fill out the form!'
        ];
        echo json_encode($res);
        return;
    }

    // Access form data
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $preferred_date = mysqli_real_escape_string($conn, $_POST['preferred_date']);
    $preferred_time = mysqli_real_escape_string($conn, $_POST['preferred_time']);
    $comments = mysqli_real_escape_string($conn, $_POST['comments']);

    // Check if the user is already a patient based on email or phone number
    $query = "SELECT * FROM patient_list WHERE email = '$email' AND firstname = '$firstname' AND lastname = '$lastname'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // User is already a patient, use the existing patient record for the appointment
        $patient = mysqli_fetch_assoc($result);
        $patient_id = $patient['patient_id'];
    } else {
        // User is not a patient, insert a new patient record
        $ran_id = rand(time(),100000000);
        $patient_id = $ran_id;
    }

    // Insert appointment details, associating them with the patient record
    $sql = "INSERT INTO appointment_requests (request_id,firstname, lastname, email, phone_number, preferred_date, preferred_time, comments)
            VALUES ('$patient_id','$firstname', '$lastname', '$email', '$phone_number', '$preferred_date', '$preferred_time', '$comments')";

    if (mysqli_query($conn, $sql)) {
        $subject = "Appointment Request";
        $comment =  $firstname . " " . $lastname . " requested an appointment.";
        $query = "INSERT INTO comments(comment_subject, comment_text)VALUES ('$subject', '$comment')";
        mysqli_query($conn, $query);
        $res = [
            'status' => 200,
            'message' => 'Appointment Request Sent! Please wait for approval!'
        ];
        echo json_encode($res);
        return;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    // Handle case where no data was received
    echo "No data received";
}
?>
