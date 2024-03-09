<?php
    session_start();
    include_once "config.php";
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
        //check if email is valid
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){  //if email is valid
            //check if email already exists in the database
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){ //if email already exists
                echo "$email - This email already exist!";
            }else{
                $ran_id = rand(time(), 100000000); // generate random id number
                $status = "Active now";
                $encrypt_pass = md5($password);
                $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, status, auth)
                VALUES ({$ran_id}, '{$fname}','{$lname}', '{$email}','{$encrypt_pass}','{$status}', '0')");
                if($insert_query){ //if these data inserted
                    $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                    
                    if(mysqli_num_rows($select_sql2) > 0){
                        $result = mysqli_fetch_assoc($select_sql2);
                        $_SESSION['unique_id'] = $result['unique_id'];


                        // Check user role
                        if($result['auth'] == '1'){
                            // Redirect admins to users.php
                            echo "success";
                        } else {
                            // Redirect regular users to chat.php with admin's unique_id
                            echo "failed";
                        }
                    }else{
                        echo "This email address not Exist!";
                    }
                }else{
                    echo "Something went wrong. Please try again!";
                }
            }
        }else{
            echo "$email is not a valid email!";
        }
    }else{
        echo "All input fields are required!";
    }
?>