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
            -webkit-print-color-adjust:exact !important;
            print-color-adjust:exact !important;
        }

        .container {
            width: 29.7cm;
            height: 21cm;
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


        #userTable thead th {
        background-color: #6fd1ff !important;
        }

        .patient-email{
        max-width: 250px;
        overflow: hidden !important;
        white-space: nowrap;
        text-overflow: ellipsis !important;
        }

        .patient-address{
        max-width: 400px;
        overflow: hidden !important;
        white-space: nowrap;
        text-overflow: ellipsis !important;
        }

        td{
            text-align: left;
            white-space: nowrap;
        }

        th{
            white-space: nowrap;
        }
        #patientTable thead th {
            background-color: #6fd1ff;
            border-right: 1px solid #D3D3D3; 
            border-top: 1px solid #D3D3D3; 
            border-left: 1px solid #D3D3D3;
        }

        /* Style for table data cells */
        #patientTable tbody td {
            border: 1px solid #D3D3D3;
        }




    @media print {
    @page {
        size: landscape;
    }
    #patientTable thead th {
        border-bottom: 2px solid #6fd1ff;
    }

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
    <h5 id="text-header">PATIENT RECORD SUMMARY</h5>
    <hr>
    <br>
    <div class="row">
    <div>
            <div class="row ">
                <div>
                    <div class="box p-3 "  style="height:90vh;">
                        <div class="center-div chat-space-admin d-flex flex-column align-items-center justify-content-center ">
                            <!-- Patient List Area -->
                            <section class="schedule">

                                <div class="schedule-list">
                                <div class="row mb-5 patient-list-area">
                                    <!-- Patient List Area -->
                                    <div>
                                    
                                    <table class="table table-hover text-center" id="patientTable">
                                        <thead class="" >
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">First Name</th>
                                                <th scope="col">Last Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Phone Number</th>
                                                <th scope="col">Date of Birth</th>
                                                <th scope="col">Address</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <!-- Table Data Here -->
                                            </tr>
                                        </tbody>
                                    </table>

                                    </div>
                                </div>
                                </div>

                            </section>

                        </div>
                    </div>
                </div>
            </div>
    </div>
        
    </div>
</div>


<script>
    window.onload = function() {
    fetchAndDisplayPatients();
};

function fetchAndDisplayPatients() {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "php/patient-list.php", true);
    xhr.onload = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            let patients = JSON.parse(xhr.responseText);
            updateTable(patients);
            window.print(); // Call print() after data is loaded
        }
    };
    xhr.send();
}

function updateTable(patients) {
    let tbody = document.querySelector("#patientTable tbody");
    tbody.innerHTML = ""; // Clear existing table content
    patients.forEach(patient => {
        let row = document.createElement("tr");
        row.innerHTML = `
            <td class="align-middle ">${patient.patient_id}</td>
            <td class="align-middle ">${patient.firstname}</td>
            <td class="align-middle ">${patient.lastname}</td>
            <td class="align-middle  patient-email">${patient.email}</td>
            <td class="align-middle ">${patient.phone_number}</td>
            <td class="align-middle patient-dob">${patient.date_of_birth || 'N/A'}</td>
            <td class="align-middle patient-address">${patient.address || 'N/A'}</td>
        `;
        tbody.appendChild(row);
    });
}


</script>


</body>
</html>