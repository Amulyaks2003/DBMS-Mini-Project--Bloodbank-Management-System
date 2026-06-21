<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['alogin']) == 0) {   
    header('location:index.php');
    exit();
} else {
    $msg = "";
    $error = "";

    if(isset($_POST['submit'])) {
        $address = $_POST['address'];
        $email = $_POST['email']; 
        $contactno = $_POST['contactno'];
        
        $sql = "UPDATE tblcontactusinfo SET Address=:address, EmailId=:email, ContactNo=:contactno";
        $query = $dbh->prepare($sql);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':contactno', $contactno, PDO::PARAM_STR);
        $query->execute();
        $msg = "Contact information updated successfully";
    }
?>
<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>BBDMS | Admin Update Contact Info</title>

    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <link rel="stylesheet" href="css/fileinput.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="css/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif !important;
            background-color: #f8fafc !important;
            color: #1e293b;
        }
        .content-wrapper {
            background-color: #f8fafc !important;
            padding: 30px 20px !important;
        }
        .page-title {
            font-weight: 700 !important;
            color: #0f172a !important;
            font-size: 28px !important;
            margin-bottom: 25px !important;
            border: none !important;
        }
        
        /* Premium Card Layout */
        .panel.panel-default {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 12px !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03) !important;
            overflow: hidden;
            margin-bottom: 30px;
        }
        .panel-heading {
            background-color: #f1f5f9 !important;
            border-bottom: 1px solid #e2e8f0 !important;
            color: #475569 !important;
            font-weight: 600 !important;
            text-transform: uppercase;
            font-size: 12px !important;
            letter-spacing: 0.05em;
            padding: 14px 20px !important;
        }
        .panel-body {
            padding: 35px 30px !important;
        }

        /* Form Styling Core Modernization */
        .control-label {
            font-weight: 500 !important;
            color: #344054 !important;
            font-size: 14px !important;
            text-align: left !important;
            padding-top: 10px !important;
        }
        .form-control {
            height: 44px !important;
            border-radius: 8px !important;
            border: 1px solid #d0d5dd !important;
            box-shadow: 0 1px 2px rgba(16, 24, 40, 0.05) !important;
            color: #101828 !important;
            font-size: 14px !important;
            transition: all 0.2s ease-in-out;
            padding: 10px 14px !important;
        }
        .form-control:focus {
            border-color: #de2c2c !important;
            box-shadow: 0 0 0 4px rgba(222, 44, 44, 0.12) !important;
            outline: none !important;
        }
        textarea.form-control {
            height: auto !important;
            min-height: 90px;
            resize: vertical;
        }
        .hr-dashed {
            border-top: 1px dashed #e2e8f0 !important;
            margin: 25px 0 !important;
        }

        /* Modernized Interactive Form Actions */
        .btn-primary-modern {
            background-color: #de2c2c !important;
            border: 1px solid #de2c2c !important;
            color: #ffffff !important;
            font-weight: 600 !important;
            font-size: 14px !important;
            padding: 10px 28px !important;
            border-radius: 8px !important;
            box-shadow: 0 1px 2px rgba(16, 24, 40, 0.05) !important;
            transition: all 0.15s ease-in-out !important;
            cursor: pointer;
        }
        .btn-primary-modern:hover {
            background-color: #be1e1e !important;
            border-color: #be1e1e !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(222, 44, 44, 0.2) !important;
        }

        /* System Action Feedback Message Blocks */
        .errorWrap, .succWrap {
            padding: 14px 18px !important;
            margin: 0 0 25px 0 !important;
            border-radius: 8px !important;
            font-size: 14px !important;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05) !important;
        }
        .errorWrap {
            background: #fef2f2 !important;
            border-left: 4px solid #ef4444 !important;
            color: #991b1b !important;
        }
        .succWrap {
            background: #f0fdf4 !important;
            border-left: 4px solid #22c55e !important;
            color: #166534 !important;
        }
    </style>
</head>

<body>
    <?php include('includes/header.php');?>
    <div class="ts-main-content">
        <?php include('includes/leftbar.php');?>
        <div class="content-wrapper">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                    
                        <h2 class="page-title">Update Contact Info</h2>

                        <div class="row">
                            <div class="col-md-11 col-lg-10">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Contact Information Form</div>
                                    <div class="panel-body">
                                        <form method="post" name="chngpwd" class="form-horizontal">
                                        
                                            <?php if(!empty($error)){ ?>
                                                <div class="errorWrap"><i class="fa fa-exclamation-circle"></i> <strong>ERROR</strong>: <?php echo htmlentities($error); ?> </div>
                                            <?php } else if(!empty($msg)){ ?>
                                                <div class="succWrap"><i class="fa fa-check-circle"></i> <strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?> </div>
                                            <?php } ?>

                                            <?php 
                                            $sql = "SELECT * from tblcontactusinfo";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            if($query->rowCount() > 0) {
                                                foreach($results as $result) {               
                                            ?>  

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Physical Address</label>
                                                    <div class="col-sm-9">
                                                        <textarea class="form-control" name="address" id="address" rows="3" required><?php echo htmlentities($result->Address);?></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Email Address</label>
                                                    <div class="col-sm-9">
                                                        <input type="email" class="form-control" name="email" id="email" value="<?php echo htmlentities($result->EmailId);?>" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Contact Number</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="<?php echo htmlentities($result->ContactNo);?>" name="contactno" id="contactno" required>
                                                    </div>
                                                </div>

                                            <?php 
                                                }
                                            } 
                                            ?>
                                            
                                            <div class="hr-dashed"></div>
                                            
                                            <div class="form-group">
                                                <div class="col-sm-9 col-sm-offset-3">
                                                    <button class="btn btn-primary-modern" name="submit" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save Dynamic Changes</button>
                                                </div>
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
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/fileinput.js"></script>
    <script src="js/chartData.js"></script>
    <script src="js/main.js"></script>

</body>
</html>
<?php } ?>