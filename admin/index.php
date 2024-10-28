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
        
    <title>Dashboard</title>
    <style>
        .dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: #f1f1f1;
}

.dropdown:hover .dropdown-content {
    display: block;
}

/* Modal styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    padding-top: 100px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
    background-color: white;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 50%;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
        .dashbord-tables{
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container{
            animation: transitionIn-Y-bottom  0.5s;
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
                                    <p class="profile-title">ADMINISTRATOR OF RECEPTION</p>
                                    <p class="profile-subtitle">mahakama2025@gmail.com</p>
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
                    <td class="menu-btn menu-icon-dashbord menu-active menu-icon-dashbord-active" >
                        <a href="index.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Dashboard</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor ">
                        <a href="guards.php" class="non-style-link-menu "><div><p class="menu-text">GUARDS</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="detail.php" class="non-style-link-menu"><div><p class="menu-text">DETAILS</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient">
                        <a href="visitor.php" class="non-style-link-menu"><div><p class="menu-text">VISITORS</p></a></div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;" >
                        
                        <tr >
                            
                            <td colspan="2" class="nav-bar" >
                                
                                <form action="guards.php" method="post" class="header-search">
        
                                    <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Guards by name or Email" list="guards">&nbsp;&nbsp;
                                    
                                    <?php
                                        echo '<datalist id="guards">';
                                        $list11 = $database->query("select guname,guemail from  guards;");
        
                                        for ($y=0;$y<$list11->num_rows;$y++){
                                            $row00=$list11->fetch_assoc();
                                            $d=$row00["guname"];
                                            $c=$row00["guemail"];
                                            echo "<option value='$d'><br/>";
                                            echo "<option value='$c'><br/>";
                                        };
        
                                    echo ' </datalist>';
                                    ?>
                                    
                               
                                    <input type="Submit" value="Search" class="login-btn btn-primary-soft btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                                
                                </form>
                                
                            </td>
                            <td width="15%">
                                <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                                    Today's Date
                                </p>
                                <p class="heading-sub12" style="padding: 0;margin: 0;">
                                    <?php 
                                date_default_timezone_set('Africa/Dar_es_Salaam');
        
                                $today = date('Y-m-d');
                                echo $today;


                                $visitorrow = $database->query("select  * from  visitor;");
                                $guardsrow = $database->query("select  * from  guards;");
                                
                                ?>
                                </p>
                            </td>
                            <td width="10%">
                                <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                            </td>
        
        
                        </tr>
                <tr>
                    <td colspan="4">
                        
                        <center>
                        <table class="filter-container" style="border: none;" border="0">
                            <tr>
                                <td colspan="4">
                                    <p style="font-size: 20px;font-weight:600;padding-left: 12px;">Status</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex">
                                        <div>
                                                <div class="h1-dashboard">
                                                    <?php    echo $guardsrow->num_rows  ?>
                                                </div><br>
                                                <div class="h3-dashboard">
                                                    SECURITY GUARDS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </div>
                                        </div>
                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/doctors-hover.svg');"></div>
                                    </div>
                                </td>
                                <td style="width: 25%;">
                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex;">
                                        <div>
                                                <div class="h1-dashboard">
                                                    <?php    echo $visitorrow->num_rows  ?>
                                                </div><br>
                                                <div class="h3-dashboard">
                                                    VISITORS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </div>
                                        </div>
                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/patients-hover.svg');"></div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </center>
                    </td>
                </tr>  
                <center>
    <table class="filter-container" style="border: none; margin-top: 30px;" border="0">
        <tr>
            <td colspan="4">
                <p style="font-size: 20px; font-weight: 600; padding-left: 12px;">Print Reports</p>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <div style="display: flex; justify-content: center; align-items: center;">
                    <div class="dropdown">
                        <button class="dropbtn">Print Report</button>
                        <div class="dropdown-content">
                            <a href="#" onclick="openModal('day')">Day</a>
                            <a href="#" onclick="openModal('week')">Week</a>
                            <a href="#" onclick="openModal('month')">Month</a>
                            <a href="#" onclick="openModal('year')">Year</a>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</center>

<!-- Modal for selecting date range -->
<div id="dateModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h3 id="modal-title">Select Date Range</h3>
        <form action="print.php" method="POST" id="date-form">
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" required><br><br>

            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" required><br><br>

            <input type="hidden" id="print_option" name="print_option">
            <button type="submit" class="btn-primary-soft">Print Report</button>
        </form>
    </div>
</div>
    

<script>
// Open the modal and set the title according to the selected option
function openModal(option) {
    document.getElementById("dateModal").style.display = "block";
    let modalTitle = "";
    switch(option) {
        case 'day':
            modalTitle = "Select Day for Report";
            break;
        case 'week':
            modalTitle = "Select Week for Report";
            break;
        case 'month':
            modalTitle = "Select Month for Report";
            break;
        case 'year':
            modalTitle = "Select Year for Report";
            break;
    }
    document.getElementById("modal-title").textContent = modalTitle;
    document.getElementById("print_option").value = option;
}

// Close the modal
function closeModal() {
    document.getElementById("dateModal").style.display = "none";
}

// Close the modal if the user clicks outside of it
window.onclick = function(event) {
    const modal = document.getElementById("dateModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>


</body>
</html>
                                        