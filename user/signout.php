<?php
  session_start();

  if(isset($_SESSION["user"])){
      if(($_SESSION["user"])=="" or $_SESSION['usertype']!='gu'){
          header("location: ../login.php");
      }else{
          $useremail=$_SESSION["user"];
      }

  }else{
      header("location: ../login.php");
  }
  //import database
  include("../connection.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Set the timezone to Tanzania
    date_default_timezone_set('Africa/Dar_es_Salaam');
    $timeout = date('H:i:s');
    echo "Time In: " . $timein; // Check if the time is correct

    $sql = "UPDATE visitor SET timeout='$timeout' WHERE id=$id AND timeout IS NULL";
    
    if ($database->query($sql) === TRUE) {
        echo "Time In recorded successfully.";
    } else {
        echo "Error updating record: " . $database->error;
    }

    $database->close();
}

header("Location: visitor.php");
exit();
?>
