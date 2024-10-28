<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mahakamavisitor";

// Create connection
$database = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($database->connect_error) {
    die("Connection failed: " . $database->connect_error);
}
?>
