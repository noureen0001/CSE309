<?php 
session_start();
$name = $_SESSION['name'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name ?></title>
</head>
<body>
    <h2 style="width : 50%; margin-left: 30%; background-color: rgb(181, 226, 222); text-align: center; font-family: tahoma; border-radius:10px;"><?php echo $name?></h2>

    <div style="width: 50%; background-color: rgb(181, 226, 222); margin-left: 30%; border-radius: 5px; border-style: none; padding: 2px; font-family: tahoma;">
        <form action="#" method="post" enctype="multipart/form-data">
            <p>Select image to upload:</p>
            <input type="file" name="fileToUpload">
            <input type="submit" value="Upload Image" name="submit">
        </form><br><br><br>

        <button style="background-color: black; border-style: none; border-radius: 5px; width: 10%; font-family: tahoma; color: white;"><a href="user_dashboard.php" style="color: white; text-decoration: none;">Home</a></button>

        <button style="background-color: black; border-style: none; border-radius: 5px; width: 10%; font-family: tahoma; color: white;"><a href="all_images.php" style="color: white; text-decoration: none;">All Images</a></button>

        <button style="background-color: black; border-style: none; border-radius: 5px; width: 10%; font-family: tahoma; color: white;"><a href="login.html" style="color: white; text-decoration: none;">Logout</a></button>


    </div>
</body>
</html>


<?php

include 'backend/connect.php';

$upload_dir = "assets/images/uploads/";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_file = $upload_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 50000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, PNG, JPEG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } 
    
    else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $image_name = basename($_FILES["fileToUpload"]["name"]);
            $image_path = $target_file;

            $sql = "UPDATE profile_photos SET path='$image_path' WHERE email='$email'";

            if ($conn->query($sql) === TRUE) {
                echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
                header('Location: userdashboard.php');
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

$conn->close();
?>