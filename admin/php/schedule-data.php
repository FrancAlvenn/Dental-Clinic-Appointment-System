<?php
    // Get current date in the format YYYY-MM-DD
    
    if(isset($_GET['date'])) {
        $selectedDate = $_GET['date'];
    } else {
        // Default to current date if no date is provided
        $selectedDate = date('Y-m-d');
    }
    
    // SQL query to fetch appointments for the current date and arrange them based on time
    $sql2 = "SELECT * FROM appointment_requests
             WHERE DATE(preferred_date) = '$selectedDate' AND status = 'confirmed'
             ORDER BY TIME(preferred_time)";
    
    $query2 = mysqli_query($conn, $sql2);
    
    // Check if there are appointments for today
if(mysqli_num_rows($query2) > 0) {
    // Loop through the appointments
    while($row2 = mysqli_fetch_assoc($query)) {
        $output .= '<div class="col d-flex justify-content-center align-items-center pb-5 col-xl-4">
                        <div class="card" style="width: 18rem;">
                            <div class="container pt-3">
                                <i class="fas fa-circle"></i> 
                                <h4 class="card-title text-center pt-3">Teeth Whitening</h4>
                                <div class="card-body text-center">
                                    <p class="card-text">' . $row2['firstname'] . ' ' . $row2['lastname'] . '</p>
                                    <h6>' . $row2['preferred_time'] . '</h6>
                                </div>
                            </div>
                            <button type="button" class="btn p-3">View Details</button>
                        </div>
                    </div>';
    }
} else {
    // No appointments for today
    $output = " ...  No appointments today.";
}

