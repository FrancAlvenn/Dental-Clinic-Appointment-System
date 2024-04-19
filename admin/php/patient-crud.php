<?php

include_once 'config.php';

if(isset($_POST['save_patient']))
{
    $ran_id = rand(time(),100000000);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $date_of_birth = mysqli_real_escape_string($conn, $_POST['date_of_birth']);
    $street = mysqli_real_escape_string($conn,$_POST['street']);
    $baranggay = mysqli_real_escape_string($conn,$_POST['baranggay']);
    $city = mysqli_real_escape_string($conn,$_POST['city']);
    $province = mysqli_real_escape_string($conn,$_POST['province']);
    $service = mysqli_real_escape_string($conn,$_POST['patient-history']);

    if($firstname == NULL || $lastname == NULL || $email == NULL || $phone_number == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    // Validate date of birth
    $current_date = date('Y-m-d');
    if ($date_of_birth > $current_date) {
        $res = [
            'status' => 422,
            'message' => 'Date of birth cannot be greater than today\'s date.'
        ];
        echo json_encode($res);
        return;
    }

    // Check for existing appointments with the same firstname, lastname, email, and request_id
    $query_check_duplicate = "SELECT * FROM patient_list WHERE firstname = '$firstname' AND lastname = '$lastname' AND email = '$email'";
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

    $query = "INSERT INTO patient_list (patient_id,firstname,lastname,email,phone_number,date_of_birth,street,baranggay,city_municipality,province)
              VALUES ('$ran_id','$firstname','$lastname','$email','$phone_number','$date_of_birth','$street','$baranggay','$city','$province')";
    $query_run = mysqli_query($conn, $query);


    $query2 = "INSERT INTO patient_history (patient_id, service) VALUES ('$ran_id','$service');";
    $query_run2 = mysqli_query($conn, $query2);

    if($query_run)
    {
        $subject = "Patient Record Added";
            $comment = "Patient record successfully added for , " . $firstname . " " . $lastname;
            $query = "INSERT INTO comments(request_id, comment_subject, comment_text)VALUES ('$ran_id','$subject', '$comment')";
            mysqli_query($conn, $query);
        $res = [
            'status' => 200,
            'message' => 'Patient Added Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Patient Not Added'
        ];
        echo json_encode($res);
        return;
    }
}

// Get Appointment Record
if(isset($_GET['patient_id']))
{
    $patient_id = mysqli_real_escape_string($conn, $_GET['patient_id']);

    $query = "SELECT * FROM patient_list WHERE patient_id='$patient_id'";
    $query_run = mysqli_query($conn, $query);

    $query2 = "SELECT service, appointment_date FROM patient_history WHERE patient_id='$patient_id'";
    $query_run2 = mysqli_query($conn, $query2);

    $history_array = array(); // Initialize an empty array to store the results

    if ($query_run2) {
        // Fetch and store results in the array
        while ($row = mysqli_fetch_assoc($query_run2)) {
            $history_array[] = $row; // Append each row to the array
        }
    } else {
        // Handle query error
        echo "Error: " . mysqli_error($conn);
    }

    if(mysqli_num_rows($query_run) == 1)
    {
        $patient = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Appointment Fetch Successfully by id',
            'data' => $patient,
            'history' => $history_array
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
if(isset($_POST['update_patient']))
{
    $patient_id = mysqli_real_escape_string($conn, $_GET['update_patient']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $date_of_birth = mysqli_real_escape_string($conn, $_POST['date_of_birth']);
    $street = mysqli_real_escape_string($conn,$_POST['street']);
    $baranggay = mysqli_real_escape_string($conn,$_POST['baranggay']);
    $city = mysqli_real_escape_string($conn,$_POST['city']);
    $province = mysqli_real_escape_string($conn,$_POST['province']);
    $service = mysqli_real_escape_string($conn,$_POST['patient-history']);

    if($firstname == NULL || $lastname == NULL || $email == NULL || $phone_number == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    // Validate date of birth
    $current_date = date('Y-m-d');
    if ($date_of_birth > $current_date) {
        $res = [
            'status' => 422,
            'message' => 'Date of birth cannot be greater than today\'s date.'
        ];
        echo json_encode($res);
        return;
    }

    // Check for existing appointments with the same firstname, lastname, email, and request_id
    $query_check_duplicate = "SELECT * FROM patient_list WHERE firstname = '$firstname' AND lastname = '$lastname' AND email = '$email' AND patient_id != '$patient_id'";
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

    $query = "UPDATE patient_list SET firstname='$firstname', lastname='$lastname', email='$email', phone_number='$phone_number', date_of_birth='$date_of_birth',street='$street', baranggay='$baranggay', city_municipality='$city', province='$province' 
                WHERE patient_id='$patient_id'";
    $query_run = mysqli_query($conn, $query);

    $query2 = "INSERT INTO patient_history (patient_id, service) VALUES ('$patient_id','$service');";
    $query_run2 = mysqli_query($conn, $query2);

    if($query_run)
    {
        $subject = "Patient Record Updated";
            $comment = "Patient record successfully updated for , " . $firstname . " " . $lastname;
            $query = "INSERT INTO comments(request_id, comment_subject, comment_text)VALUES ('$patient_id','$subject', '$comment')";
            mysqli_query($conn, $query);
        $res = [
            'status' => 200,
            'message' => 'Patient Information Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Patient Information Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


//Delete Appointment

if(isset($_POST['delete_patient']))
{
    $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

    $query = "DELETE FROM patient_list WHERE patient_id='$delete_id'";
    $query_run = mysqli_query($conn, $query);

    $query2 = "DELETE FROM patient_history WHERE patient_id='$delete_id'";
    $query_run2 = mysqli_query($conn, $query2);

    if($query_run)
    {
        $subject = "Patient Record Deleted";
            $comment = "Patient record successfully deleted";
            $query = "INSERT INTO comments(request_id, comment_subject, comment_text)VALUES ('$delete_id','$subject', '$comment')";
            mysqli_query($conn, $query);
        $res = [
            'status' => 200,
            'message' => 'Patient Record Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Patient Record Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}
