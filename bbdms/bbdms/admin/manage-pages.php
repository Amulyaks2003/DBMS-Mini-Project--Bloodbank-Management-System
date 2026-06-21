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

    if(isset($_POST['submit']) && $_POST['submit'] == "Update") {
        $pagetype = isset($_GET['type']) ? $_GET['type'] : '';
        $pagedetails = $_POST['pgedetails'];
        
        if(!empty($pagetype)) {
            $sql = "UPDATE tblpages SET detail=:pagedetails WHERE type=:pagetype";
            $query = $dbh->prepare($sql);
            $query->bindParam(':pagetype', $pagetype, PDO::PARAM_STR);
            $query->bindParam(':pagedetails', $pagedetails, PDO::PARAM_STR);
            $query->execute();
            $msg = "Page data updated successfully";
        } else {
            $error = "Please select a valid page type first.";
        }
    }
?>
<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>BBDMS | Admin Manage Pages</title>

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

    <script type="text/javascript" src="nicEdit.js"></script>
    <script type="text/javascript">
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
    </script>

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
        
        /* Modernized Card Panel */
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
            padding: 30px 25px !important;
        }

        /* Premium Form Layout Components */
        .control-label {
            font-weight: 500 !important;
            color: #344054 !important;
            font-size: 14px !important;
            text-align: left !important;
            padding-top: 8px !important;
        }
        .form-control {
            height: 42px !important;
            border-radius: 8px !important;
            border: 1px solid #d0d5dd !important;
            box-shadow: 0 1px 2px rgba(16, 24, 40, 0.05) !important;
            color: #101828 !important;
            font-size: 14px !important;
            transition: all 0.2s ease-in-out;
        }
        .form-control:focus {
            border-color: #de2c2c !important;
            box-shadow: 0 0 0 4px rgba(222, 44, 44, 0.12) !important;
        }
        textarea.form-control {
            height: auto !important;
            padding: 12px !important;
        }
        .hr-dashed {
            border-top: 1px dashed #e2e8f0 !important;
            margin: 25px 0 !important;
        }

        /* Badge Selection View */
        .selected-badge {
            display: inline-block;
            background-color: #fef2f2;
            color: #991b1b;
            padding: 6px 14px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 13px;
            border: 1px solid #fca5a5;
        }
        .no-selection-badge {
            display: inline-block;
            background-color: #f8fafc;
            color: #64748b;
            padding: 6px 14px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 13px;
            border: 1px solid #cbd5e1;
        }

        /* Modernized Buttons */
        .btn-primary-modern {
            background-color: #de2c2c !important;
            border: 1px solid #de2c2c !important;
            color: #ffffff !important;
            font-weight: 600 !important;
            font-size: 14px !important;
            padding: 10px 24px !important;
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

        /* Enhanced Feedback Wrappers */
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

        /* NicEdit Layout Cleanup Patch */
        .nicEdit-main {
            background-color: #fff !important;
            padding: 12px !important;
            min-height: 200px !important;
            font-family: 'Inter', sans-serif !important;
            font-size: 14px !important;
            line-height: 1.6 !important;
        }
        .nicEdit-panel {
            background-color: #f8fafc !important;
            border-bottom: 1px solid #e2e8f0 !important;
            padding: 6px !important;
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
                    
                        <h2 class="page-title">Manage Pages</h2>

                        <div class="row">
                            <div class="col-md-11 col-lg-10">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Form Fields</div>
                                    <div class="panel-body">
                                        <form method="post" name="chngpwd" class="form-horizontal">
                                        
                                            <?php if(!empty($error)){ ?>
                                                <div class="errorWrap"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <strong>ERROR</strong>: <?php echo htmlentities($error); ?> </div>
                                            <?php } else if(!empty($msg)){ ?>
                                                <div class="succWrap"><i class="fa fa-check-circle" aria-hidden="true"></i> <strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?> </div>
                                            <?php } ?>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Select Page</label>
                                                <div class="col-sm-9">
                                                    <select name="menu1" class="form-control" onChange="window.location.href=this.value">
                                                        <option value="manage-pages.php">*** Select Target Page ***</option>
                                                        <option value="manage-pages.php?type=aboutus" <?php if(isset($_GET['type']) && $_GET['type']=='aboutus') echo 'selected'; ?>>About Us</option> 
                                                        <option value="manage-pages.php?type=donor" <?php if(isset($_GET['type']) && $_GET['type']=='donor') echo 'selected'; ?>>Why Become Donor</option>
                                                        <option value="manage-pages.php?type=terms" <?php if(isset($_GET['type']) && $_GET['type']=='terms') echo 'selected'; ?>>Terms and Conditions</option>
                                                        <option value="manage-pages.php?type=privacy" <?php if(isset($_GET['type']) && $_GET['type']=='privacy') echo 'selected'; ?>>Privacy & Policy</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="hr-dashed"></div>
                                            
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Selected Page Context</label>
                                                <div class="col-sm-9">
                                                    <?php
                                                    $current_type = isset($_GET['type']) ? $_GET['type'] : '';
                                                    if(!empty($current_type)) {
                                                        echo '<span class="selected-badge"><i class="fa fa-file-text-o" aria-hidden="true"></i> ';
                                                        switch($current_type) {
                                                            case "terms": echo "Terms and Conditions"; break;
                                                            case "privacy": echo "Privacy & Policy"; break;
                                                            case "aboutus": echo "About US"; break;
                                                            case "donor": echo "Why Become Donor"; break;
                                                        }
                                                        echo '</span>';
                                                    } else {
                                                        echo '<span class="no-selection-badge"><i class="fa fa-info-circle" aria-hidden="true"></i> Selection Pending</span>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                 
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Page Details Editor</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" rows="14" cols="50" name="pgedetails" id="pgedetails" placeholder="Enter dynamic page content details here..." required><?php 
                                                        if(isset($_GET['type'])) {
                                                            $pagetype = $_GET['type'];
                                                            $sql = "SELECT detail from tblpages where type=:pagetype";
                                                            $query = $dbh->prepare($sql);
                                                            $query->bindParam(':pagetype', $pagetype, PDO::PARAM_STR);
                                                            $query->execute();
                                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                            if($query->rowCount() > 0) {
                                                                foreach($results as $result) {       
                                                                    echo htmlentities($result->detail);
                                                                }
                                                            }
                                                        }
                                                    ?></textarea> 
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="col-sm-9 col-sm-offset-3">
                                                    <button type="submit" name="submit" value="Update" id="submit" class="btn btn-primary-modern"><i class="fa fa-floppy-o" aria-hidden="true"></i> Update Page Content</button>
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