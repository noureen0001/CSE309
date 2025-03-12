<?php

use PgSql\Lob;

    include 'connect.php';

    if ($_SERVER["REQUEST_METHOD"]  === "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "SELECT username, email, password FROM users WHERE email = '$email' AND password = '$password'";

        $result = $conn->query($sql);

        if ($result->num_rows === 1) {
            echo "Login successful!<br>";

            $user_name;
            $password;

            while ($row = $result->fetch_assoc()) {
                $user_name = $row['username'];
                $email = $row['email'];
                $password = $row['password'];
            }

            session_start();
            $_SESSION['name'] = $user_name;
            $_SESSION['email'] = $email;
            header('Location: ../userdashboard.php');
        }
        
        else {
            echo "Login failed. Please check your username and password.";
        }
    }
?>