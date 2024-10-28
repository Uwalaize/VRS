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
    $userrow = $database->query("select * from guards where guemail='$useremail'");
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["guid"];
    $username=$userfetch["guname"];    
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
        
    <title>Dashboard</title>
    <style>
        .dashbord-tables,.doctor-heade{
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container{
            animation: transitionIn-Y-bottom  0.5s;
        }
        .sub-table,#anim{
            animation: transitionIn-Y-bottom 0.5s;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #333;
            color: white;
        }  
    </style>
    
    
</head>
<body style="background-color: rgba(100, 55, 255, 0.705);">
<div class="container">
    <div class="menu">
        <!-- Logo section -->
        <div class="logo-container" style="text-align: center; padding: 20px;">
            <img src="../img/icons/Ju.Logo.png" alt="Logo" width="200px" height="200px" style="border-radius: 50%;">
        </div>

        <table class="menu-container">
            <tr>
                <td style="padding:10px" colspan="2">
                    <table class="profile-container">
                        <tr>
                            <td width="30%" style="padding-left:20px">
                                <img src="../img/icons/guards.png" alt="" width="100%" style="border-radius:50%">
                            </td>
                            <td style="padding:0px;margin:0px;">
                                <p class="profile-title"><?php echo substr($username,0,13)  ?>..</p>
                                <p class="profile-subtitle" style="color:white"><?php echo substr($useremail,0,22)  ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="../logout.php" >
                                    <input type="button" value="Log out" class="logout-btn btn-primary-soft btn">
                                </a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn menu-icon-dashbord menu-active menu-icon-dashbord-active">
                    <a href="index.php" class="non-style-link-menu non-style-link-menu-active">
                        <div><p class="menu-text">DASHBOARD:</p></div>
                    </a>
                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn menu-icon-patient">
                    <a href="visitor.php" class="non-style-link-menu">
                        <div><p class="menu-text">MY VISITORS:</p></div>
                    </a>
                </td>
            </tr>
        </table>
    </div>
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;" >
                        
                        <tr >
                            
                            <td colspan="1" class="nav-bar" style="background-color:#28a745">
                            <p style="font-size: 33px; font-weight: 600; text-align: center;">DASHBOARD</p>

                          
                            </td>
                            <td width="25%">
                            <p style="font-size: 30px; font-weight: 600; text-align: center;">SECURITY GUARDS!</p>
                            </td>
                               <td width="15%">
                                <p style="font-size: 24px;color:white;padding: 0;margin: 0;text-align: right;">
                                    <image width="10%">
                                <!--<button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="90%"></button>
                                   </image> -->
                                Today's Date
                                </p>
                                <p class="heading-sub12" style="padding: 0;margin: 8;">
                                    <?php 
                                 date_default_timezone_set('Africa/Dar_es_Salaam');
        
                                $today = date('Y-m-d');
                                echo $today;


                                $visitorrow = $database->query("select  * from  visitor;");
                                $guardsrow = $database->query("select  * from  guards;");

                                ?>
                                </p>
                    
                        </tr>
                <tr>
                    <td colspan="4" >
                        
                    <center>
                    <table class="filter-container doctor-header" style="border: none; width: 95%; background-image: url('../img/Flag_of_Tanzania-1.svg'); background-size: cover; background-position: center; background-repeat: no-repeat; padding: 20px;">
                    <tr>
                   <td>
                <h3>Welcome!</h3>
                <h1><?php echo $username; ?>.</h1>
                <p style="color: white; font-size: 20px; text-align: left;">
                      -> Thanks for joining with us. We are always trying to get you a complete service<br>
                      -> For Register All Visitors That are coming to the Judiciary Of Dodoma To That Day!<br>
                      -> Make Sure To Provide A Good Service To The Visitors To Your Session For Today<br><br>
                </p>
                         <br><br>
                       </td>
                     </tr>
                     <tr>
                     <td style="text-align: center;">
                <a href="visitor.php" class="non-style-link">
                    <button class="btn-primary btn" style="width:30%">View My Visitors</button>
                </a>
            </td>
        </tr>
                   </table>
                 </center>

                    
                </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table border="0" width="100%"">
                            <tr>
                                <td width="50%">

                                    




                                    <center>
                                        <table class="filter-container" style="border: none;" border="0">
                                            <tr style="background-color:#6c453d ">
                                                <td colspan="4">
                                                    <p style="font-size: 20px;font-weight:600;padding-left: 12px;">Status</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 25%; background-color:#31cab9;">
                                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex">
                                                        <div>
                                                                <div class="h1-dashboard">
                                                                    <?php    echo $guardsrow->num_rows  ?>
                                                                </div><br>
                                                                <div class="h3-dashboard">
                                                                    All Security Guards &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                </div>
                                                        </div>
                                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/doctors-hover.svg');"></div>
                                                    </div>
                                                </td>
                                                <td style="width: 25%; background-color:#923ca7;">
                                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex;">
                                                        <div>
                                                                <div class="h1-dashboard">
                                                                    <?php    echo $visitorrow->num_rows  ?>
                                                                </div><br>
                                                                <div class="h3-dashboard">
                                                                    All Visiors &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                </div>
                                                        </div>
                                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/patients-hover.svg');"></div>
                                                    </div>
                                                </td>
                                                </tr>
                                                <tr>
                                            </tr>
                                        </table>
                                    </center>
                                </td>
                            </tr>
                        </table>
                    </td>
                <tr>
            </table>
        </div>
    </div>


</body>
</html>