<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{   
    header('location:index.php');
}
else{
    // Code for change password 
    if(isset($_POST['submit']))
    {
        $bloodgroup=trim($_POST['bloodgroup']);
        $sql="INSERT INTO tblbloodgroup(BloodGroup) VALUES(:bloodgroup)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':bloodgroup',$bloodgroup,PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if($lastInsertId)
        {
            $msg="Blood Group Created successfully";
        }
        else 
        {
            $error="Something went wrong. Please try again";
        }
    }
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>BBDMS | Admin Add Blood Group</title>

    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7f6;
            color: #333;
        }
        .page-title {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 30px;
            font-size: 28px;
            border-bottom: 2px solid #eef2f5;
            padding-bottom: 10px;
        }
        .custom-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid #eef2f5;
            padding: 40px;
            transition: transform 0.2s ease;
        }
        .form-label-custom {
            font-weight: 500;
            color: #4a5568;
            font-size: 15px;
            margin-bottom: 8px;
        }
        .form-control-custom {
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            height: 48px;
            padding: 10px 16px;
            font-size: 15px;
            transition: all 0.3s ease;
        }
        .form-control-custom:focus {
            background-color: #fff;
            border-color: #de1f26;
            box-shadow: 0 0 0 3px rgba(222, 31, 38, 0.15);
            outline: none;
        }
        .btn-submit {
            background-color: #de1f26;
            color: white;
            font-weight: 500;
            padding: 12px 30px;
            border-radius: 8px;
            border: none;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(222, 31, 38, 0.2);
        }
        .btn-submit:hover {
            background-color: #be1319;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(222, 31, 38, 0.3);
        }
        .alert-custom {
            border-radius: 8px;
            padding: 15px 20px;
            margin-bottom: 25px;
            font-weight: 500;
            border: none;
            display: flex;
            align-items: center;
        }
        .alert-custom i {
            margin-right: 12px;
            font-size: 18px;
        }
        .alert-custom-error {
            background-color: #fef2f2;
            color: #991b1b;
        }
        .alert-custom-success {
            background-color: #f0fdf4;
            color: #166534;
        }
    </style>
</head>

<body>
    <?php include('includes/header.php');?>
    <div class="ts-main-content">
        <?php include('includes/leftbar.php');?>
        <div class="content-wrapper" style="padding-top: 30px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-title"><i class="fa fa-tint text-danger" style="margin-right: 10px;"></i>Add Blood Group</h2>
                        
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
                                <div class="custom-card">
                                    
                                    <?php if($error){ ?>
                                        <div class="alert-custom alert-custom-error">
                                            <i class="fa fa-times-circle"></i>
                                            <span><strong>Error:</strong> <?php echo htmlentities($error); ?></span>
                                        </div>
                                    <?php } else if($msg){ ?>
                                        <div class="alert-custom alert-custom-success">
                                            <i class="fa fa-check-circle"></i>
                                            <span><strong>Success:</strong> <?php echo htmlentities($msg); ?></span>
                                        </div>
                                    <?php }?>

                                    <form method="post" name="chngpwd" onSubmit="return valid();">
                                        <div class="form-group" style="margin-bottom: 25px;">
                                            <label class="form-label-custom" for="bloodgroup">Blood Group Name</label>
                                            <input type="text" class="form-control-custom form-control" name="bloodgroup" id="bloodgroup" placeholder="e.g., A+, O-, AB+" required autocomplete="off">
                                        </div>
                                        
                                        <div style="margin-top: 30px; text-align: right;">
                                            <button class="btn btn-submit" name="submit" type="submit">
                                                <i class="fa fa-plus" style="margin-right: 8px;"></i> Create Group
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
<?php } ?>