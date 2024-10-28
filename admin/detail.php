<?php
session_start();

// Check if user is logged in and is an admin
if (isset($_SESSION["user"])) {
    if ($_SESSION["user"] == "" || $_SESSION['usertype'] != 'a') {
        header("location: ../login.php");
        exit();
    }
} else {
    header("location: ../login.php");
    exit();
}

// Include database connection
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
    <title>Guard Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
        .menu {
            width: 20%;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .content {
            width: 75%;
            padding: 20px;
            margin: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }
        .view-button {
            background-color: yellow;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            color: black;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
        }
        .view-button:hover {
            background-color: #ffeb3b;
        }
        .date-filter-container {
            margin-top: 50px;
        }
        .filter-label {
            padding: 15px 30px;
            font-weight: bold;
        }
        .filter-options {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        .filter-options select {
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Sidebar Menu -->
        <div class="menu" style="background-color:#3893b8;">
            <div class="logo-container" style="text-align: center; padding: 20px;">
                <img src="../img/Coat_of_arms_of_Tanzania-1.svg" alt="Logo" width="200px" height="200px">
            </div>
            <table class="menu-container">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="../img/icons/Ju.Logo.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title">ADMINISTRATOR OF RECEPTION</p>
                                    <p class="profile-subtitle">mahakama2025@gmail.com</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php"><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- Menu Links -->
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-dashbord">
                        <a href="index.php" class="non-style-link-menu"><div><p class="menu-text">DASHBOARD</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor menu-active menu-icon-doctor-active">
                        <a href="guards.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">GUARDS</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="detail.php" class="non-style-link-menu"><div><p class="menu-text">DETAILS</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-patient">
                        <a href="visitor.php" class="non-style-link-menu"><div><p class="menu-text">VISITORS</p></div></a>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Main Content -->
        <div class="content" style="background-color:#3893b8;">
            <h2>Security Guards List</h2>

            <form method="GET" action="">
                <label for="guardSelect" class="filter-label">Select a Guard:</label>
                <select id="guardSelect" name="guemail">
                    <option value="">Select a Guard Email</option>
                    <?php
                    // Query to get all unique guards (assuming their email is in the `visitor` table)
                    $sql = "SELECT DISTINCT guemail FROM visitor";
                    $result = $database->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $guardEmail = htmlspecialchars($row['guemail']);
                            echo "<option value='" . urlencode($guardEmail) . "'>" . $guardEmail . "</option>";
                        }
                    } else {
                        echo "<option value=''>No security guards found.</option>";
                    }
                    ?>
                </select>
                <input type="submit" class="view-button" value="View Visitors">
            </form>

            <?php
            // If a guard is selected, show their visitors
            if (isset($_GET['guemail']) && !empty($_GET['guemail'])) {
                $selectedGuard = urldecode($_GET['guemail']);
                echo "<h3>Visitors Registered by: " . htmlspecialchars($selectedGuard) . "</h3>";

                $sqlVisitors = "SELECT * FROM visitor WHERE guemail = '$selectedGuard'";
                $visitorResult = $database->query($sqlVisitors);

                if ($visitorResult->num_rows > 0) {
                    echo "<table>";
                    echo "<tr><th>Name</th><th>From</th><th>To</th><th>Details</th><th>Phone</th><th>Date</th><th>Time In</th><th>Time Out</th></tr>";
                    while ($visitor = $visitorResult->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($visitor['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($visitor['unapotoka']) . "</td>";
                        echo "<td>" . htmlspecialchars($visitor['unapoenda']) . "</td>";
                        echo "<td>" . htmlspecialchars($visitor['detail']) . "</td>";
                        echo "<td>" . htmlspecialchars($visitor['phone']) . "</td>";
                        echo "<td>" . htmlspecialchars($visitor['date']) . "</td>";
                        echo "<td>" . htmlspecialchars($visitor['timein']) . "</td>";
                        echo "<td>" . htmlspecialchars($visitor['timeout']) . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No visitors found for this guard.</p>";
                }
            }
            ?>
        </div>
    </div>

</body>
</html>
