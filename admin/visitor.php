 <?php
    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    

    //import database
    include("../connection.php");

    
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
        .sub-table{
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
<body>
<div class="container">
        <div class="menu">
        <div class="logo-container" style="text-align: center; padding: 20px;">
            <img src="../img/Coat_of_arms_of_Tanzania-1.svg" alt="Logo" width="200px" height="200px" style="border-radius: 50%;">
        </div>
            <table class="menu-container">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px" >
                                    <img src="../img/icons/Ju.Logo.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title">Administrator</p>
                                    <p class="profile-subtitle">admin@edoc.com</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                <a href="../logout.php" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                    </table>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord" >
                        <a href="index.php" class="non-style-link-menu"><div><p class="menu-text">DASHBOARD:</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor ">
                        <a href="guards.php" class="non-style-link-menu "><div><p class="menu-text">GUARDS:</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="detail.php" class="non-style-link-menu"><div><p class="menu-text">DETAILS:</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient  menu-active menu-icon-patient-active">
                        <a href="visitor.php" class="non-style-link-menu  non-style-link-menu-active"><div><p class="menu-text">VISITORS:</p></a></div>
                    </td>
                </tr>

            </table>
        </div>

        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%">

                    <a href="patient.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                        
                    </td>
                    <td>
                        
                        <form action="visitor.php" method="post" class="header-search">

                            <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Visitor Name or ID" list="visitor">&nbsp;&nbsp;
                            
                            <?php
                                echo '<datalist id="visitor">';
                                $list11 = $database->query("select  name,id from visitor;");

                                for ($y=0;$y<$list11->num_rows;$y++){
                                    $row00=$list11->fetch_assoc();
                                    $d=$row00["name"];
                                    $c=$row00["id"];
                                    echo "<option value='$d'><br/>";
                                    echo "<option value='$c'><br/>";
                                };

                            echo ' </datalist>';
                            ?>
                            
                       
                            <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                        
                        </form>
                        
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 
                        date_default_timezone_set('Africa/Dar_es_Salaam');

                        $date = date('Y-m-d');
                        echo $date;
                        ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>


                </tr>
               
                
                <tr>
                    <td colspan="4" style="padding-top:10px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All Visitors (<?php echo $list11->num_rows; ?>)</p>
                    </td>
                    
                </tr>
                <?php
                    if($_POST){
                        $keyword=$_POST["search"];
                        
                        $sqlmain= "select * from visitor where id='$keyword' or name='$keyword' or name like '$keyword%' or name like '%$keyword' or name like '%$keyword%' ";
                    }else{
                        $sqlmain= "select * from visitor order by id desc";

                    }



                ?>
                  
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown"  style="border-spacing:0;">
                        <thead>
                        <tr>
                                <th class="table-headin">
                                ID:
                                </th>
                                <th class="table-headin">
                                VISITORS NAME:
                                </th>
                                <th class="table-headin">
                                UNAPOTOKA:
                                </th>
                                <th class="table-headin">
                                UNAPOENDA:
                                </th>
                                <th class="table-headin">
                                KITAMBULISHO:
                                </th>
                                <th class="table-headin">
                                NAMBA YA SIMU:
                                </th>
                                <th class="table-headin">
                                TAREHE:
                                </th>
                                <th class="table-headin">
                                M/KUINGIA:
                                </th>
                                <th class="table-headin">
                                M/UTOKA  
                                </tr>
                        </thead>
                        <tbody>
                        
                            <?php

                                
                                $result= $database->query($sqlmain);

                                if($result->num_rows==0){
                                    echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="visitor.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Visitors &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    
                                }
                                else{
                                for ( $x=0; $x<$result->num_rows;$x++){
                                    $row=$result->fetch_assoc();
                                    $vid=$row["id"];
                                    $name=$row["name"];
                                    $unapotoka=$row["unapotoka"];
                                    $unapoenda=$row["unapoenda"];
                                    $detail=$row["detail"];
                                    $phone=$row["phone"];
                                    $date=$row["date"];
                                    $timein=$row["timein"];
                                    $timeout=$row["timeout"];
                                    
                                    echo '<tr>
                                        <td> &nbsp;'.
                                        substr($vid,0,40)
                                        .'</td>
                                        <td>
                                            '.substr($name,0,50).'
                                        </td>
                                        <td>
                                        '.substr($unapotoka,0,50).'
                                         </td>
                                        <td>
                                        '.substr($unapoenda,0,50).'
                                        </td>
                                        <td>
                                        '.substr($detail,0,50).'
                                        </td>
                                        <td>
                                        '.substr($phone,0,16).'
                                        </td>
                                        <td>
                                        '.substr($date,0,10).'
                                        </td>
                                        <td>
                                        '.substr($timein,0,20).'
                                        </td>
                                        <td>
                                        '.substr($timeout,0,20).'
                                        </td>
                                       
                                    </tr>';
                                    
                                }
                            }    
                            ?>
 
                            </tbody>

                        </table>
                        </div>
                        </center>
                   </td> 
                </tr>       
            </table>
        </div>
    </div>
</div>

</body>
</html>