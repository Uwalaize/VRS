<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='gu'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    
    if($_GET){
        //import database
        include("../connection.php");
        $id=$_GET["id"];
        $result001= $database->query("select * from visitor where id=$id;");
        $id=($result001->fetch_assoc())["id"];
        $sql= $database->query("delete from visitor where id='$id';");
        //print_r($email);
        header("location: visitor.php");
    }


?>