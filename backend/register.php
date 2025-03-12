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

    }
?>