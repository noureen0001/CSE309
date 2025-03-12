<?php
    include 'connect.php';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"]  === "POST") {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "INSERT INTO users(username, email, password) VALUES('$name', '$email', '$password')";

        $result = $conn->query($sql);

        header('Location: ../login.html');

        // if (strtolower($user_type) === "farmer") {
        //     $sql1 = "INSERT INTO farmer_t(FarmerID, FName, LName, AreaName, District, Division, ContactNumber) VALUES('$userid', '$first_name', '$last_name', '$area', '$district', '$division' '$contact_number', 'NULL')";

        //     if ($conn->query($sql1) === TRUE) {
        //         echo "Data updated successfully!";
        //         header('Location: ../login.html');
        //     }
        //     else {
        //         echo $conn->query($sql1);
        //     }
        // } 
        
        // else if (strtolower($user_type) === "driver") {
        //     $sql1 = "INSERT INTO driver_t VALUES('$userid', '$first_name', '$last_name', '$area', '$district', '$division', '$contact_number', NULL, NULL)";

        //     if ($conn->query($sql1) === TRUE) {
        //         echo "Data updated successfully!";
        //         header('Location: ../login.html');
        //     }
        //     else {
        //         echo $conn->query($sql1);
        //     }
        // }

        // else if (strtolower($user_type) === "warehouse manager") {
        //     $sql1 = "INSERT INTO warehouse_manager_t VALUES('$userid', '$first_name', '$last_name', '$area', '$district', '$division', '$contact_number')";

        //     if ($conn->query($sql1) === TRUE) {
        //         echo "Data updated successfully!";
        //         header('Location: ../login.html');
        //     }
        //     else {
        //         echo $conn->query($sql1);
        //     }
        // }

        // else if (strtolower($user_type) === "supplier") {
        //         $sql1 = "INSERT INTO supplier_t VALUES('$userid', '$user_name', '$area', '$district', '$division', '$contact_number')";
    
        //         if ($conn->query($sql1) === TRUE) {
        //             echo "Data updated successfully!";
        //             header('Location: ../login.html');
        //         }
        //         else {
        //             echo $conn->query($sql1);
        //         }
        // }
    }
?>