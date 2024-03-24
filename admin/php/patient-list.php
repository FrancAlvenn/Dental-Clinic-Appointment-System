<?php
    session_start();
    include_once "config.php";
    $sql = "SELECT * FROM patient_list";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "... No patients";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "patient-data.php";
    }
    echo $output;
