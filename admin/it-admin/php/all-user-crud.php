<?php

include_once 'config.php';

if(isset($_POST['save_user']))
{
    $ran_id = rand(time(),100000000);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $auth = mysqli_real_escape_string($conn, $_POST['auth']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if($firstname == NULL || $lastname == NULL || $email == NULL ||  $password == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }


    // Check for existing appointments with the same firstname, lastname, email, and request_id
    $query_check_duplicate = "SELECT * FROM users WHERE fname = '$firstname' AND lname = '$lastname' AND email = '$email'";
    $result_duplicate = mysqli_query($conn, $query_check_duplicate);

    if (mysqli_num_rows($result_duplicate) > 0) {
        // Duplicate entry found
        $res = [
            'status' => 422,
            'message' => 'A user with the same name and email already exists.'
        ];
        echo json_encode($res);
        return;
    }

    $encrypt_pass = md5($password);

    $query = "INSERT INTO users (unique_id,fname,lname,email,password,status,auth)
              VALUES ('$ran_id','$firstname','$lastname','$email','$encrypt_pass','$status','$auth')";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'User Added Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'User Not Added'
        ];
        echo json_encode($res);
        return;
    }
}

// Get Appointment Record
if(isset($_GET['user_id']))
{
    $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);

    $query = "SELECT * FROM users WHERE unique_id='$user_id'";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $patient = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'User Fetch Successfully by ID',
            'data' => $patient
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'User Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}


// Update Appointment
if(isset($_POST['update_user']))
{
    $user_id = mysqli_real_escape_string($conn, $_GET['update_user']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $auth = mysqli_real_escape_string($conn, $_POST['auth']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if($firstname == NULL || $lastname == NULL || $email == NULL || $password == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    // Check for existing appointments with the same firstname, lastname, email, and request_id
    $query_check_duplicate = "SELECT * FROM users WHERE fname = '$firstname' AND lname = '$lastname' AND email = '$email' AND unique_id != '$user_id'";
    $result_duplicate = mysqli_query($conn, $query_check_duplicate);

    if (mysqli_num_rows($result_duplicate) > 0) {
        // Duplicate entry found
        $res = [
            'status' => 422,
            'message' => 'A user with the same name and email already exists.'
        ];
        echo json_encode($res);
        return;
    }

    // Check if the password is changed
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '$user_id'");

    $encrypt_pass = "";
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_assoc($sql);
        $enc_pass = $row['password']; // Existing encrypted password from the database
        $encrypt_pass = $row['password'];
        // Check if the provided password matches the existing password
        if($password === $enc_pass){
            // Password not changed, use existing encrypted password
            $encrypt_pass = $password;
        } else {
            // Password changed, re-encrypt the provided password
            $encrypt_pass = md5($password);
        }
    }


    $query = "UPDATE users SET fname='$firstname', lname='$lastname', email='$email', password='$encrypt_pass', status='$status',auth='$auth'
                WHERE unique_id='$user_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'User Information Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'User Information Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


//Delete Appointment

if(isset($_POST['delete_user']))
{
    $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

    $query = "DELETE FROM users WHERE unique_id='$delete_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'User Record Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'User Record Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}
