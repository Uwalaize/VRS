<?php
session_start();

// Check if the user is logged in and the usertype is 'gu'
if(isset($_SESSION["user"])) {
    if($_SESSION["user"] == "" || $_SESSION['usertype'] != 'gu') {
        header("location: ../login.php");
    } else {
        $useremail = $_SESSION["user"];
    }
} else {
    header("location: ../login.php");
}

// Import database connection
include("../connection.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Set the timezone to Tanzania (Dodoma falls under this timezone)
    date_default_timezone_set('Africa/Dar_es_Salaam');
    
    // Get the current time in the desired format
    $timein = date('H:i:s');
    
    // Prepare the SQL statement to update the visitor's time-in
    $stmt = $database->prepare("UPDATE visitor SET timein=? WHERE id=? AND timein IS NULL");
    
    // Bind the parameters ('si' means string for timein and integer for id)
    $stmt->bind_param('si', $timein, $id);
    
    // Execute the statement and check if successful
    if ($stmt->execute()) {
        // Redirect to visitor.php after successful update
        header("location: visitor.php");
    } else {
        // Output an error if the update fails
        echo "Error updating record: " . $stmt->error;
    }
    
    // Close the prepared statement and the database connection
    $stmt->close();
    $database->close();
}
?>
