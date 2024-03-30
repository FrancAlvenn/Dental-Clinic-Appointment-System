<?php
    session_start();
    include_once "config.php";
    $sql = "SELECT * FROM users";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No user";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "all-user-data.php";
    }
    echo $output;
