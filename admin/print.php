<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dental Clinic Appointment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            font-family: 'calibri' , sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 21cm;
            min-height: 29.7cm;
            padding: 2cm;
            margin: auto;
            border: 1px solid #D3D3D3;
        }

        .header{
            margin-top: 30px;
        }

        .header .col-9{
            margin-top: 30px;
        }

        #text-header{
            font-weight: 900;
            text-decoration: underline;
        }

        h5, h6 {
            margin: 0;
        }

       p , h5{
            text-align: center;
        }

        .row {
            margin-bottom: 20px;
        }

        ul {
            padding-left: 20px;
        }

        .col-2 img {
            max-width: 100%;
        }
        
        img{
            position: absolute;
            top: 120px;
            border-radius: 50%;
            width: 75px;
        }

        #title_header{
            margin-bottom: 30px;
            font-size: 18px;
            font-weight: 900;
        }

        #title-body{
            margin-bottom: 25px;
        }

        #patientHistoryList li{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }


        @page {
            size: A4;
            margin: 0;
        }

        @media print {
        .container {
            max-width: unset;
            box-shadow: none;
            border: 0px;
            background-color: white;
            height: 100%;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            padding-left: 70px;
            font-size: 14px;
            line-height: 18px;
        }
        }
    </style>
</head>
<body>

<?php
include_once 'php/config.php';
// Check if patient_id is set in the URL
if(isset($_GET['patient_id'])) {
    // Sanitize the input to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_GET['patient_id']);

    // Construct the SQL query to select data based on patient_id
    $sql = "SELECT * FROM patient_list WHERE patient_id = '$id'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if($result) {
        // Fetch the data as an associative array
        $patient = mysqli_fetch_assoc($result);

        // Check if data was found
        if($patient) {
            // Extract data from the associative array
            $firstname = $patient['firstname'];
            $lastname = $patient['lastname'];
            $email = $patient['email'];
            $phone_number = $patient['phone_number'];
            $date_of_birth = $patient['date_of_birth'];
            $street = $patient['street'];
            $baranggay = $patient['baranggay'];
            $city_municipality = $patient['city_municipality'];
            $province = $patient['province'];
        } else {
            echo "No patient found with ID: $id";
        }
    } else {
        echo "Error executing query: " . mysqli_error($conn);
    }

    $query2 = "SELECT service, appointment_date FROM patient_history WHERE patient_id='$id'";
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


} else {
    echo "Patient ID not provided in the URL";
}



?>




<div class="container">
        <div class="col-2">
            <img src="../resources/brand_logo.jpg" alt="Image here">
        </div>
    <div class="row header">
        <div class="col">
            <h5>DR. JOHNNY MAR CABUNGON DENTAL CLINIC</h5>
            <p>019 Gov. F Halili Ext Ave Binang 2nd , Bocaue, Philippines | 0943 359 9161 | <br> docjohnny2018@gmail.com</p>
        </div>
    </div>
    <h5 id="text-header">PATIENT SUMMARY REPORT</h5>
    <hr>
    <br>
    <div class="row">
        <div class="col-6">
        <h6 id="title_header">PERSONAL INFORMATION</h6>
        <h6 id="title-body">Patient ID: <?php echo $id ?></h6>
        <h6 id="title-body">Name: <?php echo $firstname . ' ' . $lastname ?></h6>
        <h6 id="title-body">Email: <?php echo $email?></h6>
        <h6 id="title-body">Contact Number: <?php echo $phone_number?></h6>
        <h6 id="title-body">Date of Birth: <?php echo $date_of_birth ?></h6>
        </div>
        <div class="col-6">
        <h6 id="title_header">ADDRESS</h6>
        <h6 id="title-body">Street: <?php echo $street?></h6>
        <h6 id="title-body">Baranggay: <?php echo $baranggay?></h6>
        <h6 id="title-body">City/Municipality: <?php echo $city_municipality?></h6>
        <h6 id="title-body">Province: <?php echo $province ?></h6>
        </div>
        
        <br>
        
    </div>
    <hr>
    <br>
    <div class="row">
        <h6 id="title_header">PREVIOUS APPOINTMENTS</h6>
        <div id="pastVisitHistory">
            <ul id="patientHistoryList" >
                <?php
                // Loop through each entry in patient history
                foreach ($history_array as $visit) {
                    // Append a new <li> element for each visit
                    echo '<li>' . $visit['service'] . '<span>' . $visit['appointment_date'] . '</span>' . '</li>';
                }
                ?>
            </ul>
        </div>
    </div>

</div>

<script>
    let printBtn = document.querySelector("#print");

  window.onload = function() {
  window.print();
};
</script>


</body>
</html>