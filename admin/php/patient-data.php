<?php
// SQL query to fetch appointments for the current date and arrange them based on time
        $sql2 = "SELECT * FROM patient_list";

        $query2 = mysqli_query($conn, $sql2);

        // Check if there are appointments for today
        if(mysqli_num_rows($query2) > 0) {
        // Loop through the appointments
        while($row2 = mysqli_fetch_assoc($query2)) {
        $output .= '<div class="col d-flex justify-content-center align-items-center pb-5 col-xl-4">
                    <div class="card" style="width: 30rem;">
                        <div class="container pt-3">
                            <!-- <i class="fas fa-circle"></i> -->
                            <h5 class="card-title text-center pt-3">' . $row2['firstname'] . ' ' . $row2['lastname'] . '</h5>
                            <div class="card-body text-center">
                                <h6>' . $row2['email'] . '</h6>
                                <h6>' . $row2['phone_number'] . '</h6>
                            </div>
                        </div>
                        <button type="button" value="' . $row2['patient_id'] . '" class="editAppointment btn p-3">View Details</button>
                    </div>
                </div>';
        }
        } else {
        // No appointments for today
        $output = " ...  No patients found";
        }

