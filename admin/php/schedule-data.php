<?php
    // Get current date in the format YYYY-MM-DD
    
    if(isset($_GET['date'])) {
        $selectedDate = $_GET['date'];
    } else {
        // Default to current date if no date is provided
        $selectedDate = date('Y-m-d');
    }
    
    if(isset($_GET['status'])) {
        $status = $_GET['status'];
    } else {
        // Default status value if not provided
        $status = ''; // You can set a default value here
    }
    if(isset($_GET['showAllDate'])) {
        $showAllDate = $_GET['showAllDate'];
    } else {
        // Default status value if not provided
        $showAllDate= ''; // You can set a default value here
    }


    if($showAllDate === 'checked'){
        if($status === 'confirmed'){
            // SQL query to fetch appointments for the current date and arrange them based on time
                $sql2 = "SELECT * FROM appointment_requests
                WHERE status = '$status'
                ORDER BY TIME(preferred_time)";
    
            $query2 = mysqli_query($conn, $sql2);
    
            // Check if there are appointments for today
            if(mysqli_num_rows($query2) > 0) {
            // Loop through the appointments
            while($row2 = mysqli_fetch_assoc($query2)) {
            $output .= '<div class="col d-flex justify-content-center align-items-center pb-5 col-xl-4">
                        <div class="card" style="width: 30rem;">
                            <div class="container pt-3">
                                <i class="fas fa-circle" style="color: green!important"></i>
                                <h4 class="card-title text-center pt-3">' . $row2['service'] . '</h4>
                                <div class="card-body text-center">
                                    <p class="card-text">' . $row2['firstname'] . ' ' . $row2['lastname'] . '</p>
                                    <h6>' . $row2['preferred_date'] . '</h6>
                                    <h6>' . $row2['preferred_time'] . '</h6>
                                </div>
                            </div>
                            <button type="button" value="' . $row2['request_id'] . '" class="editAppointment btn p-3">View Details</button>
                        </div>
                    </div>';
            }
            } else {
            // No appointments for today
            $output = " ...  No appointments found";
            }
        }elseif($status === 'pending' || $status === 'rejected'){
            $colorText;
            if($status === 'pending'){
                $colorText = "color:orange!important";
            }else{
                $colorText = "color:red!important";
            }
            // SQL query to fetch appointments for the current date and arrange them based on time
            $sql2 = "SELECT * FROM appointment_requests
             WHERE status = '$status'
             ORDER BY preferred_date, TIME(preferred_time)";
    
            $query2 = mysqli_query($conn, $sql2);
    
            // Check if there are appointments for today
            if(mysqli_num_rows($query2) > 0) {
            // Loop through the appointments
            while($row2 = mysqli_fetch_assoc($query2)) {
            $output .= '<div class="col d-flex justify-content-center align-items-center pb-5 col-xl-4">
                        <div class="card" style="width: 30rem;">
                            <div class="container pt-3">
                                <i class="fas fa-circle" style="'. $colorText .'"></i>
                                <h4 class="card-title text-center pt-3">' . $row2['service'] . '</h4>
                                <div class="card-body text-center">
                                    <p class="card-text">' . $row2['firstname'] . ' ' . $row2['lastname'] . '</p>
                                    <h6>' . $row2['preferred_date'] . '</h6>
                                    <h6>' . $row2['preferred_time'] . '</h6>
                                </div>
                            </div>
                            <button type="button" value="' . $row2['request_id'] . '" class="editAppointment btn p-3">View Details</button>
                        </div>
                    </div>';
            }
            } else {
            // No appointments for today
    
            $output = " ...  No appointments found";
            }
        }
    }else{
        if($status === 'confirmed'){
            // SQL query to fetch appointments for the current date and arrange them based on time
                $sql2 = "SELECT * FROM appointment_requests
                WHERE DATE(preferred_date) = '$selectedDate' AND status = '$status'
                ORDER BY TIME(preferred_time)";
    
            $query2 = mysqli_query($conn, $sql2);
    
            // Check if there are appointments for today
            if(mysqli_num_rows($query2) > 0) {
            // Loop through the appointments
            while($row2 = mysqli_fetch_assoc($query2)) {
            $output .= '<div class="col d-flex justify-content-center align-items-center pb-5 col-xl-4">
                        <div class="card" style="width: 30rem;">
                            <div class="container pt-3">
                                <i class="fas fa-circle"></i>
                                <h4 class="card-title text-center pt-3">' . $row2['service'] . '</h4>
                                <div class="card-body text-center">
                                    <p class="card-text">' . $row2['firstname'] . ' ' . $row2['lastname'] . '</p>
                                    <h6>' . $row2['preferred_date'] . '</h6>
                                    <h6>' . $row2['preferred_time'] . '</h6>
                                </div>
                            </div>
                            <button type="button" value="' . $row2['request_id'] . '" class="editAppointment btn p-3">View Details</button>
                        </div>
                    </div>';
            }
            } else {
            // No appointments for today
            $output = " ...  No confirmed appointments for " . $selectedDate;
            }
        }elseif($status === 'pending' || $status === 'rejected'){
            $colorText;
            $text;
            if($status === 'pending'){
                $colorText = "color:orange!important";
                $text = "pending";
            }else{
                $colorText = "color:red!important";
                $text = "rejected";
            }
            // SQL query to fetch appointments for the current date and arrange them based on time
            $sql2 = "SELECT * FROM appointment_requests
             WHERE DATE(preferred_date) = '$selectedDate' AND status = '$status'
             ORDER BY preferred_date, TIME(preferred_time)";
    
            $query2 = mysqli_query($conn, $sql2);
    
            // Check if there are appointments for today
            if(mysqli_num_rows($query2) > 0) {
            // Loop through the appointments
            while($row2 = mysqli_fetch_assoc($query2)) {
            $output .= '<div class="col d-flex justify-content-center align-items-center pb-5 col-xl-4">
                        <div class="card" style="width: 30rem;">
                            <div class="container pt-3">
                                <i class="fas fa-circle" style="'. $colorText .'"></i>
                                <h4 class="card-title text-center pt-3">' . $row2['service'] . '</h4>
                                <div class="card-body text-center">
                                    <p class="card-text">' . $row2['firstname'] . ' ' . $row2['lastname'] . '</p>
                                    <h6>' . $row2['preferred_date'] . '</h6>
                                    <h6>' . $row2['preferred_time'] . '</h6>
                                </div>
                            </div>
                            <button type="button" value="' . $row2['request_id'] . '" class="editAppointment btn p-3">View Details</button>
                        </div>
                    </div>';
            }
            } else {
            // No appointments for today
    
            $output = " ...  No ". $text ." appointments for " . $selectedDate;
            }
        }
    }

    
