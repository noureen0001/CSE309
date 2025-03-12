<?php
    $servername = "localhost";
    $username = "nishat";
    $password = "";
    $dbname = "uni_lab";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>