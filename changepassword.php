<?php
    include 'backend/connect.php';
    session_start();
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];


    $sql2 = "SELECT path FROM profile_photos WHERE email = '$email'";
    $result2 = $conn->query($sql2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name ?></title>
</head>
<body>
<div style="width: 50%; background-color: rgb(181, 226, 222); margin-left: 30%; border-radius: 5px; border-style: none; padding: 2px; font-family: tahoma; overflow: hidden;">

<h3 style="margin-left: 2%; background-color: rgb(181, 226, 222); text-align: center; font-family: tahoma; border-radius:10px; float: left; font-size: 34px;">

<?php echo $name?></h3>

<div style="margin-right: 2%; background-color: rgb(181, 226, 222); text-align: center; font-family: tahoma; border-radius:10px; float: right;">

<?php
    if ($result2->num_rows >= 0) {
        while ($row = $result2->fetch_assoc()) {
            echo "<img src='" . $row["path"] . "'alt='image' width='100px' height='100px' style='border-radius: 50px;'>";
        }
    } else {
        echo "Profile Photo of ". $name;
    }
?>

<div>
    <form action="#" method = "post">
        <label for="change_password">Change your password</label><br>
        <input type="password" name="old_password" placeholder="current_password" required></input>
        <input type="password" name="new_password" placeholder="new_password" required></input>
        <button type="submit" style="background-color: black; border-style: none; border-radius: 5px; width: 10%; font-family: tahoma; color: white">Change Password</button>
    </form>
</div>
</body>
</html>

<?php

    $sql = "SELECT password FROM users WHERE username='$name' AND email='$email'";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    $curr = $row["password"];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $old = $_POST['old_password'];
        $new = $_POST['new_password'];

        if ($curr == $old) {
            $sql3 = "UPDATE users SET password='$new' WHERE email='$email'";
            $conn->query($sql3);
        }

        header('Location: userdashboard.php');
    }

?>