<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Clear session variables for the user and usertype
$_SESSION["user"] = "";
$_SESSION["usertype"] = "";

// Set the new timezone
date_default_timezone_set('Africa/Dar_es_salaam');
$date = date('Y-m-d');
$_SESSION["date"] = $date;

// Import database
include("connection.php");

// Initialize error variable
$error = '';

if ($_POST) {
    $email = $_POST['useremail'];
    $password = $_POST['userpassword'];
    $result = $database->query("SELECT * FROM webuser WHERE email='$email'");

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $utype = $user['usertype'];

        if ($utype == 'gu') {
            $checker = $database->query("SELECT * FROM guards WHERE guemail='$email' AND gupassword='$password'");
            if ($checker->num_rows == 1) {
                $_SESSION['user'] = $email;
                $_SESSION['usertype'] = 'gu';
                header("Location: user/index.php");
                exit();
            } else {
                $error = '<span class="error-message">Wrong credentials: Invalid email or password</span>';
            }
        } elseif ($utype == 'a') {
            $checker = $database->query("SELECT * FROM admin WHERE aemail='$email' AND apassword='$password'");
            if ($checker->num_rows == 1) {
                $_SESSION['user'] = $email;
                $_SESSION['usertype'] = 'a';
                header("Location: admin/index.php");
                exit();
            } else {
                $error = '<span class="error-message">Wrong credentials: Invalid email or password</span>';
            }
        } else {
            $error = '<span class="error-message">Usertype not recognized</span>';
        }
    } else {
        $error = '<span class="error-message">We can’t find any account for this email.</span>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
    <style>
        body {
            background-color: #3893b8;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            color: #333;
        }
        .logo {
            width: 400px;
            height: auto;
            margin-bottom: 40px;
        }
        .container {
            background-color: #3893b8;
            width: 600px;
            padding: 50px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .form-body {
            background: white;
            padding: 20px;
            border-radius: 8px;
            text-align: left;
        }
        .header-text {
            font-size: 24px;
            font-weight: bold;
            color: white;
        }
        .sub-text {
            color: #f0f0f0;
        }
        .form-label {
            font-weight: bold;
            color: #333;
        }
        .input-text {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .login-btn {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        .login-btn:hover {
            background-color: #555;
        }
        .error-message {
            color: rgb(255, 62, 62);
            text-align: center;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <!-- Logo outside the container -->
    <img src="Ju.Logo.png" alt="Logo" class="logo"> <!-- Update the src attribute with the logo path -->

    <div class="container">
        <p class="header-text">Welcome Back!</p>
        <p class="sub-text">Login with your details to continue</p>

        <div class="form-body">
            <form action="login.php" method="POST">
                <label for="useremail" class="form-label">Email:</label>
                <input type="email" name="useremail" class="input-text" placeholder="Email Address" required>

                <label for="userpassword" class="form-label">Password:</label>
                <input type="password" name="userpassword" class="input-text" placeholder="Password" required>

                <?php echo $error; ?>

                <input type="submit" value="Login" class="login-btn">
            </form>
        </div>
    </div>
</body>
</html>
