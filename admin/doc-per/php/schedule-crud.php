<?php

include_once 'config.php';

if(isset($_POST['save_appointment']))
{
    $ran_id = rand(time(),100000000);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']); // Corrected variable name
    $service = mysqli_real_escape_string($conn, $_POST['service']); // Updated to match the name attribute in the HTML
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

    // Check for existing appointments with the same preferred_date and preferred_time
        $query_check_date_time = "SELECT * FROM appointment_requests WHERE preferred_date = '$preferred_date' AND preferred_time = '$preferred_time'";
        $result_date_time = mysqli_query($conn, $query_check_date_time);

        if (mysqli_num_rows($result_date_time) > 0) {
            // Appointment already exists at the selected date and time
            $res = [
                'status' => 422,
                'message' => 'An appointment already exists at the selected date and time.'
            ];
            echo json_encode($res);
            return;
        }

        // Check for existing appointments with the same firstname, lastname, email, and request_id
        $query_check_duplicate = "SELECT * FROM appointment_requests WHERE firstname = '$firstname' AND lastname = '$lastname' AND email = '$email'";
        $result_duplicate = mysqli_query($conn, $query_check_duplicate);

        if (mysqli_num_rows($result_duplicate) > 0) {
            // Duplicate entry found
            $res = [
                'status' => 422,
                'message' => 'An appointment with the same name and email already exists.'
            ];
            echo json_encode($res);
            return;
        }

    $query = "INSERT INTO appointment_requests (request_id,firstname,lastname,email,phone_number,service,preferred_date,preferred_time,comments,status)
              VALUES ('$ran_id','$firstname','$lastname','$email','$phone_number','$service','$preferred_date','$preferred_time','$comments','confirmed')";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $subject = "Appointment Added";
            $comment = "Appointment scheduled for " . $firstname . " " . $lastname;
            $query = "INSERT INTO comments(request_id, comment_subject, comment_text)VALUES ('$ran_id','$subject', '$comment')";
            mysqli_query($conn, $query);
        $res = [
            'status' => 200,
            'message' => 'Appointment Created Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Appointment Not Created'
        ];
        echo json_encode($res);
        return;
    }
}

// Get Appointment Record
if(isset($_GET['appointment_id']))
{
    $appointment_id = mysqli_real_escape_string($conn, $_GET['appointment_id']);

    $query = "SELECT * FROM appointment_requests WHERE request_id='$appointment_id'";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $appointment = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Appointment Fetch Successfully by id',
            'data' => $appointment
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Appointment Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}


// Update Appointment
if(isset($_POST['update_appointment']))
{
    $appointment_id = mysqli_real_escape_string($conn, $_GET['update_appointment']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $service = mysqli_real_escape_string($conn, $_POST['service']);
    $status = mysqli_real_escape_string($conn,$_POST['status']);
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

    // Check for existing appointments with the same preferred_date and preferred_time
    $query_check_date_time = "SELECT * FROM appointment_requests WHERE preferred_date = '$preferred_date' AND preferred_time = '$preferred_time' AND request_id != '$appointment_id'";
    $result_date_time = mysqli_query($conn, $query_check_date_time);

    if (mysqli_num_rows($result_date_time) > 0) {
        // Appointment already exists at the selected date and time
        $res = [
            'status' => 422,
            'message' => 'An appointment already exists at the selected date and time.'
        ];
        echo json_encode($res);
        return;
    }

    // Check for existing appointments with the same firstname, lastname, email, and request_id
    $query_check_duplicate = "SELECT * FROM appointment_requests WHERE firstname = '$firstname' AND lastname = '$lastname' AND email = '$email' AND request_id != '$appointment_id'";
    $result_duplicate = mysqli_query($conn, $query_check_duplicate);

    if (mysqli_num_rows($result_duplicate) > 0) {
        // Duplicate entry found
        $res = [
            'status' => 422,
            'message' => 'An appointment with the same name and email already exists.'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE appointment_requests SET firstname='$firstname', lastname='$lastname', email='$email', phone_number='$phone_number', service='$service',status='$status', preferred_date='$preferred_date', preferred_time='$preferred_time', comments='$comments' 
                WHERE request_id='$appointment_id'";
    $query_run = mysqli_query($conn, $query);

    $sql = "SELECT sms_sent FROM appointment_requests WHERE request_id = '$appointment_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $sms_sent;
    if ($row) {
        $sms_sent = $row['sms_sent'];
    }

    if($query_run)
    {
        $subject = "Appointment Updated";
        $comment = "Appointment details have been successfully updated for , " . $firstname . " " . $lastname;
        $query = "INSERT INTO comments(request_id, comment_subject, comment_text)VALUES ('$appointment_id','$subject', '$comment')";
        mysqli_query($conn, $query);

        $send_message;
        if($status == 'confirmed' && $sms_sent == 0){
            $send_message = 0;
        }else{
            $send_message = 1;
        }
        // Check if the phone number starts with a zero
        if (substr($phone_number, 0, 1) === "0") {
            // Remove the leading zero and prepend "63"
            $modifiedPhoneNumber = "63" . substr($phone_number, 1);
        } else {
            // If the number doesn't start with zero, keep it unchanged
            $modifiedPhoneNumber = $phone_number;
        }

        $res = [
            'status' => 200,
            'message' => 'Appointment Updated Successfully',
            'recipient' => $modifiedPhoneNumber .','. $email,
            'notification_message' => 'Your appointment has been confirmed! Please be available on '. $preferred_date .' at '. $preferred_time .'. Thank you for choosing Doc. Johnny Mar Cabungon Dental Clinic',
            'send_sms' => $send_message
        ];

        $sql_update = "UPDATE appointment_requests SET sms_sent = 1 WHERE request_id = '$appointment_id'";
        $query_update = mysqli_query($conn, $sql_update);
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Appointment Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


//Delete Appointment

if(isset($_POST['delete_appointment']))
{
    $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

    $query = "DELETE FROM appointment_requests WHERE request_id='$delete_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $subject = "Appointment Deleted";
            $comment = "Appointment deleted!";
            $query = "INSERT INTO comments(request_id, comment_subject, comment_text)VALUES ('$delete_id','$subject', '$comment')";
            mysqli_query($conn, $query);
        $res = [
            'status' => 200,
            'message' => 'Appointment Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Appointment Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}












if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT * FROM appointment_requests WHERE DATE(preferred_date) = DATE(DATE_ADD(CURDATE(), INTERVAL 1 DAY))";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
            $appointments = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

            // Initialize an empty array to store notification messages
            $recipients = [];
            $notificationMessages = [];
            $viewedArray = [];
            $statusArray=[];

            // Iterate over each appointment to construct the notification message
            foreach ($appointments as $appointment) {
                $notificationMessage = 'Hello '.$appointment['firstname'].' '.$appointment['lastname'].', this is a friendly reminder of your upcoming appointment with Dr. Johnny Mar Cabungon Dental Clinic on '.$appointment['preferred_date'].' at '.$appointment['preferred_time'].'. Please remember to arrive on time. If you have any questions or need to reschedule, please contact us. We look forward to seeing you!';
                $notificationMessages[] = $notificationMessage;

                $recipient =  $appointment['phone_number'] .','. $appointment['email'];
                $recipients[] = $recipient;

                $viewed = $appointment['viewed'];
                $viewedArray[] = $viewed;

                $stat = $appointment['status'];
                $statusArray[] = $stat;
            }

            // Prepare the response
            $res = [
                'status' => 200,
                'message' => 'Appointments Fetched Successfully',
                'appointments' => $recipients,
                'notificationMessages' => $notificationMessages,
                'notification_sent' => $viewedArray,
                'appointmentStatus' => $statusArray
            ];
            echo json_encode($res);

            $updateQuery = "UPDATE appointment_requests SET viewed = 1 WHERE DATE(preferred_date) = DATE(DATE_ADD(CURDATE(), INTERVAL 1 DAY)) AND status = 'confirmed'";
            mysqli_query($conn, $updateQuery);
            return;
        } else {
            $res = [
                'status' => 404,
                'message' => 'No Appointments Found'
            ];
            echo json_encode($res);
            return;
        }
    }
}

