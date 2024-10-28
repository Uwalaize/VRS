<?php
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if user is logged in and has the correct user type
if (isset($_SESSION["user"])) {
    if ($_SESSION["user"] == "" || $_SESSION['usertype'] != 'a') {
        header("location: ../login.php");
        exit(); // Stop further script execution
    }
} else {
    header("location: ../login.php");
    exit(); // Stop further script execution
}

// Include the database connection
include("../connection.php");

$error = ''; // Initialize the error variable

if ($_POST) {
    // Capture form inputs
    $email = $_POST['guemail'];
    $name = $_POST['guname'];
    $password= $_POST['gupassword'];
    $cpassword = $_POST['cpassword'];
    $phone = $_POST['guphone'];
    // Check if passwords match
    if ($password == $cpassword) {
        // Check if email already exists
        $result = $database->query("SELECT * FROM webuser WHERE email='$email'");
        if ($result->num_rows == 1) {
            $error = '1'; // Email already exists
        } else {
            // Prepare and execute SQL queries
            $sql1 = "INSERT INTO guards(guemail, guname, gupassword, guphone) 
                     VALUES('$email', '$name', '$password', '$phone')";
            $sql2 = "INSERT INTO webuser(email, usertype) VALUES('$email', 'gu')";

            // Check for SQL errors
            if ($database->query($sql1) === TRUE && $database->query($sql2) === TRUE) {
                $error = '4'; // Success
            } else {
                // Output any SQL errors for debugging
                echo "Error: " . $database->error;
                exit(); // Stop script execution on error
            }
        }
    } else {
        $error = '2'; // Passwords do not match
    }
} else {
    $error = '3'; // Form not submitted properly
}

// Redirect after processing
header("location: guards.php?action=add&error=".$error);
exit(); // Ensure no further code is executed after redirection
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Guards</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
</style>
</head>
<body>
</body>
</html>