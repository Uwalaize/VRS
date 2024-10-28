<?php
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if user is logged in and has the correct user type
if (isset($_SESSION["user"])) {
    if ($_SESSION["user"] == "" || $_SESSION['usertype'] != 'gu') {
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
    $name = $_POST['name'];
    $unapotoka = $_POST['unapotoka'];
    $unapoenda = $_POST['unapoenda'];
    $detail = $_POST['detail'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];

    // Automatically set the current date
    $currentDateTime = date("Y-m-d");

    // Get the security guard's email from the session
    $guardEmail = $_SESSION["user"];

    // Insert visitor details along with the guard's email into the database
    $sql = "INSERT INTO visitor (name, unapotoka, unapoenda, detail, phone, date, guemail) 
            VALUES ('$name', '$unapotoka', '$unapoenda', '$detail', '$phone', '$currentDateTime', '$guardEmail')";

    // Execute SQL query
    if ($database->query($sql) === TRUE) {
        // Redirect to visitor list after successful insertion
        header("Location: visitor.php");
        exit();
    } else {
        echo "<p style='color:red;'>Error: " . $sql . "<br>" . $database->error . "</p>";
    }

    $database->close();
}

// Redirect after processing
header("location: visitor.php?action=add&error=".$error);
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
        
    <title>Visitors</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
</style>
</head>
<body>
</body>
</html>