<?php

include_once 'config.php';

if(isset($_POST['save_student']))
{
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']); // Corrected variable name
    $service = mysqli_real_escape_string($conn, $_POST['other_service']); // Updated to match the name attribute in the HTML
    $preferred_date = mysqli_real_escape_string($conn, $_POST['preferred_date']);
    $preferred_time = mysqli_real_escape_string($conn, $_POST['preferred_time']);
    $comments = mysqli_real_escape_string($conn, $_POST['comments']);

    if($firstname == NULL || $lastname == NULL || $email == NULL || $phone_number == NULL || $service == NULL || $preferred_date == NULL || $preferred_time == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO appointment_requests (firstname,lastname,email,phone_number,service,preferred_date,preferred_time,comments,status)
              VALUES ('$firstname','$lastname','$email','$phone_number','$service','$preferred_date','$preferred_time','$comments','confirmed')";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Student Created Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Student Not Created'
        ];
        echo json_encode($res);
        return;
    }
}
