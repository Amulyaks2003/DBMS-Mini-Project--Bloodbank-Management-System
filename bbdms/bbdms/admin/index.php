<?php
session_start();
include('includes/config.php');
if(isset($_POST['login']))
{
    $email=$_POST['username'];
    $password=md5($_POST['password']);
    $sql ="SELECT UserName,Password FROM admin WHERE UserName=:email and Password=:password";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    
    if($query->rowCount() > 0)
    {
        $_SESSION['alogin']=$_POST['username'];
        // Redirecting directly to dashboard for a clean admin landing experience
        echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
    } else {
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>
<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    
    <title>BloodBank & Donor Management System | Admin Portal</title>
    
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
        /* Modernized Layout Foundations */
        body, html {
            height: 100%;
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #0f172a;
        }

        /* Fullscreen Hero Background Setup */
        .login-page-bg {
            background: linear-gradient(rgba(15, 23, 42, 0.82), rgba(15, 23, 42, 0.9)), url('img/banner.png') no-repeat center center;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Glassmorphism Portal Card */
        .glass-login-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            padding: 45px 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.35);
            max-width: 450px;
            width: 100%;
        }

        /* Title Typography */
        .portal-header {
            font-size: 1.75rem;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.5px;
            margin-bottom: 8px;
            text-align: center;
        }

        .portal-subheader {
            color: #94a3b8;
            font-size: 0.95rem;
            text-align: center;
            margin-bottom: 35px;
            font-weight: 400;
        }

        /* Premium Form Controls */
        .custom-form-group {
            margin-bottom: 22px;
        }

        .custom-form-group label {
            color: #cbd5e1;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 8px;
            display: block;
        }

        .input-icon-wrapper {
            position: relative;
        }

        .input-icon-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 1rem;
            transition: color 0.2s ease;
        }

        .custom-input {
            background-color: rgba(15, 23, 42, 0.6) !important;
            border: 1.5px solid #334155 !important;
            border-radius: 12px !important;
            height: auto !important;
            padding: 14px 16px 14px 45px !important;
            color: #ffffff !important;
            font-size: 0.95rem !important;
            transition: all 0.2s ease-in-out !important;
            width: 100%;
        }

        .custom-input:focus {
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.15) !important;
            background-color: rgba(15, 23, 42, 0.8) !important;
        }

        .custom-input:focus ~ i {
            color: #ef4444;
        }

        /* Gradient Crimson Sign-In Button */
        .btn-portal-submit {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            border: none;
            color: #ffffff;
            padding: 15px;
            font-weight: 700;
            font-size: 1rem;
            border-radius: 12px;
            letter-spacing: 0.5px;
            width: 100%;
            margin-top: 10px;
            transition: all 0.25s ease;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.25);
            cursor: pointer;
        }

        .btn-portal-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 22px rgba(239, 68, 68, 0.4);
            color: #ffffff;
        }

        .btn-portal-submit:active {
            transform: translateY(1px);
        }
    </style>
</head>

<body>
    
    <div class="login-page-bg">
        <div class="glass-login-card">
            <h1 class="portal-header"><i class="fa fa-heartbeat text-danger mr-2"></i>BloodBank Hub</h1>
            <p class="portal-subheader">Administrative Secure Sign-In Gateway</p>
            
            <form method="post">
                <div class="custom-form-group">
                    <label>Your Username</label>
                    <div class="input-icon-wrapper">
                        <input type="text" placeholder="Enter username" name="username" class="custom-input" required autocomplete="off">
                        <i class="fa fa-user"></i>
                    </div>
                </div>

                <div class="custom-form-group">
                    <label>Password</label>
                    <div class="input-icon-wrapper">
                        <input type="password" placeholder="Enter security password" name="password" class="custom-input" required>
                        <i class="fa fa-lock"></i>
                    </div>
                </div>

                <button class="btn-portal-submit" name="login" type="submit">
                    LOG IN TO DASHBOARD <i class="fa fa-sign-in ml-2"></i>
                </button>
            </form>
        </div>
    </div>
    
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>