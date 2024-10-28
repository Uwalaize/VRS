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
    

// Get the current date
$currentDate = date("Y-m-d");

// Get yesterday's date
$yesterdayDate = date("Y-m-d", strtotime("-1 day"));
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
        
    <title>Home Application</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        } 
        body {
            background-color: rgba(100, 55, 255, 0.7);
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
            <img src="../img/icons/Ju.Logo.png" alt="Logo" width="200px" height="200px" style="border-radius: 50%;">
        </div>

            <table class="menu-container">
            <tr>
                    <td style="padding:10px" colspan="2">
                        <table class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px" >
                                    <img src="../img/icons/guards.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr($username,0,13)  ?>..</p>
                                    <p class="profile-subtitle" style="color:white"><?php echo substr($useremail,0,22)  ?></p>
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
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient">
                        <a href="visitor.php" class="non-style-link-menu"><div><p class="menu-text">MY VISITOR:</p></a></div>
                    </td>
                </tr>

            </table>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%">
                        <a href="visitor.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td>
                        
                        <form action="visitor.php" method="post" class="header-search">

                            <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Visitor Name or ID" list="visitor">&nbsp;&nbsp;
                            
                            <?php
                                echo '<datalist id="visitor">';
                                $list11 = $database->query("select  name, id from visitor;");

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
                        <p style="font-size: 24px;color:white;padding: 0;margin: 2;text-align: right;">
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
               
                <tr >
                    <td colspan="2" style="padding-top:30px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Add New Visitor</p>
                    </td>
                    <td colspan="2">
                        <a href="?action=add&id=none&error=0" class="non-style-link"><button  class="login-btn btn-primary btn button-icon"  style="display: flex;justify-content: center;align-items: center;margin-left:75px;background-image: url('../img/icons/add.svg');">Add New</font></button>
                            </a></td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:10px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All Visitors That Are Entered (<?php echo $list11->num_rows; ?>)</p>
                    </td>
                    
                </tr>
                <?php
                    if ($_POST) {
                        $keyword = $_POST["search"];
                        $sql = "SELECT * FROM visitor WHERE (id LIKE '%$keyword%' OR name LIKE '%$keyword%') AND DATE(date) = '$currentDate'";
                    }else{
                        $sqlmain= "select * from visitor order by id desc";

                    }

                ?>

    <table>
        <tr>
            <th>ID</th>
            <th>JINA KAMILI</th>
            <th>UNAPOTOKA</th>
            <th>UNAPOENDA</th>
            <th>KITAMBULISHO</th>
            <th>NO/SIMU</th>
            <th>DATE</th>
            <th>M/KUINGIA</th>
            <th>M/KUTOKA</th>
            <th>ACTIONS</th>
        </tr>
        <?php
        //Initialize the SQL query
        $sql = "SELECT id, name, unapotoka, unapoenda, detail, phone, date, timein, timeout FROM visitor WHERE DATE(date) = '$currentDate'";

         //Check if a search query or date is provided
         if ($_POST) {
            $keyword = $_POST["search"];
            $sql = "SELECT * FROM visitor WHERE (id LIKE '%$keyword%' OR name LIKE '%$keyword%') AND DATE(date) = '$currentDate'";
        }

        $result = $database->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['unapotoka']}</td>
                        <td>{$row['unapoenda']}</td>
                        <td>{$row['detail']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['date']}</td>
                        <td>{$row['timein']}</td>
                        <td>{$row['timeout']}</td>
                        <td>
                            <a class='non-style-link' href='signin.php?id={$row['id']}'>
                            <button class='btn-primary-soft btn button-icon btn-edit' style='padding-left: 40px; padding-top: 12px; padding-bottom: 12px; margin-top: 10px;'>
                            <font class='tn-in-text'>SIGN IN</font></button></a> 
                            <a class='non-style-link' href='signout.php?id={$row['id']}'>
                            <button class='btn-primary-soft btn button-icon btn-edit' style='padding-left: 40px; padding-top: 12px; padding-bottom: 12px; margin-top: 10px;'>
                            <font class='tn-in-text'>SIGN OUT</font></button></a> 
                            <a class='non-style-link' href='delete.php?id={$row['id']}'><button class='btn-primary-soft btn button-icon btn-delete' style='padding-left: 40px; padding-top: 12px; padding-bottom: 12px; margin-top: 10px;'>
                            <font class='tn-in-text'>DELETE</font>
                             </button></a> 
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No records found</td></tr>";
        }
        
        $database->close();
        ?>
    </table>
    <?php 
    if($_GET){
        
        $id=$_GET["id"];
        $action=$_GET["action"];
        if($action=='add'){
            $error_1=$_GET["error"];
            $errorlist= array(
                '1'=>'<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>',
                '2'=>'<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>',
                '3'=>'<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>',
                '4'=>"",
                '0'=>'',

            );
            if($error_1!='4'){
            echo '
        <div id="popup1" class="overlay">
                <div class="popup">
                <center>
                
                    <a class="close" href="visitor.php">&times;</a> 
                    <div style="display: flex;justify-content: center;">
                    <div class="abc">
                    <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                    <tr>
                            <td class="label-td" colspan="2">'.
                                $errorlist[$error_1]
                            .'</td>
                        </tr>
                        <tr>
                            <td>
                                <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Add New Security Guards.</p><br><br>
                            </td>
                        </tr>
                        
                        <tr>
                            <form action="add-new-visitor.php" method="POST" class="add-new-form">
                            <td class="label-td" colspan="2">
                                <label for="name" class="form-label">Name of Visitor: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                <input type="text" name="name" class="input-text" placeholder="visitor Name" required><br>
                            </td>
                            
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                <label for="unapotoka" class="form-label">Anapotoka: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                <input type="text" name="unapotoka" class="input-text" placeholder="Anapotoka" required><br>
                            </td>
                        </tr>

                        <tr>
                            <td class="label-td" colspan="2">
                                <label for="unapoenda" class="form-label">Anapoenda: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                <input type="text" name="unapoenda" class="input-text" placeholder="Anapoenda" required><br>
                            </td>
                        </tr>

                        <tr>
                        <!-- Label for Kitambulisho -->
                        <td class="label-td" colspan="2">
                            <label for="kitambulisho" class="form-label">Kitambulisho: </label>
                        </td>
                    </tr>
                    <tr>
                        <!-- Dropdown for Kitambulisho Selection -->
                        <td class="label-td" colspan="2">
                            <select name="detail" class="input-text" required>
                                <option value="" disabled selected>Select Kitambulisho</option>
                                <option value="NIDA">NIDA</option>
                                <option value="PIGA KULA">PIGA KULA</option>
                                <option value="LESENI">LESENI</option>
                                <option value="PASSPORT">PASSPORT</option>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                         <td class="label-td" colspan="2">
                         <label for="phone" class="form-label">Namba Ya Simu: </label>
                         </td>
                         </tr>
                    <tr>
                      <td class="label-td" colspan="2">
                         <input type="tel" name="phone" class="input-text" placeholder="Namba Ya Simu" required maxlength="10" oninput="validatePhoneNumber(this)" pattern="\d*" title="Only numbers are allowed" />
                         <span id="phoneError" style="color: red; display: none;">Invalid number</span><br>
                       </td>
                    </tr>
                        <tr>
                            <td colspan="2">
                                <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            
                                <input type="submit" value="Add" class="login-btn btn-primary btn">
                            </td>
            
                        </tr>
                       
                        </form>
                        </tr>
                    </table>
                    </div>
                    </div>
                </center>
                <br><br>
        </div>
        </div>
        ';

        }else{
            echo '
                <div id="popup1" class="overlay">
                        <div class="popup">
                        <center>
                        <br><br><br><br>
                            <h2>New Record Added Successfully!</h2>
                            <a class="close" href="visitor.php">&times;</a>
                            <div class="content">
                                
                                
                            </div>
                            <div style="display: flex;justify-content: center;">
                            
                            <a href="visitor.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>

                            </div>
                            <br><br>
                        </center>
                </div>
                </div>
    ';
        }
    };
};
?>

<script>
    function validatePhoneNumber(input) {
        const errorSpan = document.getElementById('phoneError');
        const phoneNumber = input.value;

        // Check if the phone number starts with 0 and has a length of 10
        if (phoneNumber.length > 10 || (phoneNumber.length === 10 && phoneNumber[0] !== '0')) {
            errorSpan.style.display = 'inline'; // Show error message
            input.setCustomValidity("Invalid number"); // Set custom validity message
        } else {
            errorSpan.style.display = 'none'; // Hide error message
            input.setCustomValidity(""); // Clear the custom validity
        }
    }
</script>


</body>
</html>
