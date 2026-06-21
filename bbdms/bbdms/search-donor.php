<?php
error_reporting(0);
include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Search Active Blood Donors">
    <title>BloodBank & Donor Management System | Find Donors</title>
    
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/modern-business.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f6f8fa;
            color: #2d3748;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        .navbar-toggler {
            z-index: 1;
        }
        
        @media (max-width: 576px) {
            nav > .container {
                width: 100%;
            }
        }

        /* System Messages Styling */
        .errorWrap {
            padding: 15px 20px;
            margin-bottom: 25px;
            background: #ffffff;
            border-left: 4px solid #e53e3e;
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(229, 62, 62, 0.06);
            font-weight: 500;
        }

        .succWrap {
            padding: 15px 20px;
            margin-bottom: 25px;
            background: #ffffff;
            border-left: 4px solid #38a169;
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(56, 161, 105, 0.06);
            font-weight: 500;
        }

        /* Glassmorphism Filter Board */
        .search-card-panel {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.03);
            padding: 35px;
            margin-bottom: 45px;
            border: 1px solid #e2e8f0;
        }

        .control-label {
            font-size: 0.85rem;
            font-weight: 700;
            color: #4a5568;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #cbd5e0;
            /* Reduced vertical padding and added a uniform line-height to prevent clipping */
            padding: 10px 18px; 
            line-height: 1.5;
            height: auto;
            background-color: #f7fafc;
            color: #2d3748;
            transition: all 0.2s ease-in-out;
        }

        .form-control:focus {
            background-color: #ffffff;
            border-color: #e53e3e;
            box-shadow: 0 0 0 4px rgba(229, 62, 62, 0.12);
        }

        .btn-action-trigger {
            background: linear-gradient(135deg, #e53e3e 0%, #c53030 100%);
            border: none;
            color: #ffffff;
            padding: 14px 28px;
            font-weight: 600;
            border-radius: 10px;
            letter-spacing: 0.5px;
            transition: all 0.25s ease;
            cursor: pointer;
        }

        .btn-action-trigger:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(229, 62, 62, 0.3);
            color: #ffffff;
        }

        /* Live Identity Profile Cards */
        .donor-badge-card {
            background: #ffffff;
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.02);
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s ease;
            margin-bottom: 30px;
            overflow: hidden;
            border: 1px solid #edf2f7;
        }

        .donor-badge-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 35px rgba(0,0,0,0.07);
        }

        .card-header-accent {
            background: #fff5f5;
            padding: 24px;
            border-bottom: 1px solid #fed7d7;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .donor-title-group {
            display: flex;
            align-items: center;
        }

        /* Pulse state icon indicators */
        .status-pulse-dot {
            width: 8px;
            height: 8px;
            background-color: #38a169;
            border-radius: 50%;
            margin-right: 10px;
            display: inline-block;
            box-shadow: 0 0 0 rgba(56, 161, 105, 0.4);
            animation: pulse-glow 2s infinite;
        }

        @keyframes pulse-glow {
            0% { box-shadow: 0 0 0 0 rgba(56, 161, 105, 0.7); }
            70% { box-shadow: 0 0 0 6px rgba(56, 161, 105, 0); }
            100% { box-shadow: 0 0 0 0 rgba(56, 161, 105, 0); }
        }

        .donor-display-name {
            font-size: 1.15rem;
            font-weight: 700;
            color: #1a202c;
            margin: 0;
        }

        .blood-type-pill {
            background-color: #e53e3e;
            color: #ffffff;
            font-weight: 800;
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 0.85rem;
            box-shadow: 0 4px 10px rgba(229, 62, 62, 0.2);
        }

        .card-body-content {
            padding: 24px;
        }

        .data-attribute-row {
            display: flex;
            align-items: flex-start;
            margin-bottom: 16px;
            font-size: 0.95rem;
        }

        .data-attribute-row:last-of-type {
            margin-bottom: 0;
        }

        .attribute-icon-frame {
            width: 32px;
            color: #a0aec0;
            font-size: 0.95rem;
        }

        .attribute-label {
            font-weight: 600;
            color: #4a5568;
            margin-right: 10px;
            white-space: nowrap;
        }

        .attribute-value {
            color: #4a5568;
            flex: 1;
            word-break: break-word;
        }

        .custom-donor-statement {
            background-color: #f7fafc;
            border-left: 4px solid #cbd5e0;
            padding: 14px;
            margin-top: 20px;
            font-style: italic;
            font-size: 0.9rem;
            border-radius: 0 8px 8px 0;
            color: #4a5568;
            line-height: 1.5;
        }

        .empty-results-fallback {
            width: 100%;
            text-align: center;
            padding: 60px 20px;
            background: #ffffff;
            border-radius: 16px;
            border: 2px dashed #e2e8f0;
            color: #718096;
        }
    </style>
</head>

<body>

<?php include('includes/header.php');?>

    <div class="container mt-4">

        <h1 class="mt-4 mb-2 font-weight-bold">Search <small class="text-muted font-weight-normal">Donors Database</small></h1>

        <ol class="breadcrumb mb-4 bg-transparent p-0">
            <li class="breadcrumb-item"><a href="index.php" class="text-danger text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active text-muted">Search Donor</li>
        </ol>

        <?php if($error){ ?>
            <div class="errorWrap"><i class="fa fa-exclamation-triangle text-danger mr-2"></i><strong>System Alert:</strong> <?php echo htmlentities($error); ?></div>
        <?php } else if($msg){ ?>
            <div class="succWrap"><i class="fa fa-check-circle text-success mr-2"></i><strong>System Success:</strong> <?php echo htmlentities($msg); ?></div>
        <?php } ?>

        <div class="search-card-panel">
            <form name="donar" method="post">
                <div class="row align-items-end">
                    <div class="col-lg-5 col-md-6 mb-3 mb-md-0">
                        <div class="control-label">Blood Type Needed <span class="text-danger">*</span></div>
                        <select name="bloodgroup" class="form-control" required>
                            <option value="" disabled selected>Choose blood group...</option>
                            <?php 
                            $sql = "SELECT * from tblbloodgroup";
                            $query = $dbh -> prepare($sql);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            if($query->rowCount() > 0) {
                                foreach($results as $result) { ?>  
                                    <option value="<?php echo htmlentities($result->BloodGroup);?>">
                                        <?php echo htmlentities($result->BloodGroup);?>
                                    </option>
                                <?php }
                            } ?>
                        </select>
                    </div>

                    <div class="col-lg-5 col-md-6 mb-3 mb-md-0">
                        <div class="control-label">Location / City Area</div>
                        <input type="text" class="form-control" name="location" placeholder="e.g. Chicago, IL...">
                    </div>

                    <div class="col-lg-2 col-md-12">
                        <button type="submit" name="submit" class="btn btn-action-trigger w-100">
                            <i class="fa fa-search mr-2"></i>Find Matches
                        </button>
                    </div>
                </div>
            </form> 
        </div>  

        <div class="row">
        <?php 
        if(isset($_POST['submit'])) {
            $status=1;
            $bloodgroup=$_POST['bloodgroup'];
            $location=$_POST['location'];
            
            $sql = "SELECT * from tblblooddonars where (status=:status and BloodGroup=:bloodgroup) || (Address=:location)";
            $query = $dbh -> prepare($sql);
            $query->bindParam(':status',$status,PDO::PARAM_STR);
            $query->bindParam(':bloodgroup',$bloodgroup,PDO::PARAM_STR);
            $query->bindParam(':location',$location,PDO::PARAM_STR);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            
            if($query->rowCount() > 0) {
                foreach($results as $result) { ?>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="donor-badge-card">
                            <div class="card-header-accent">
                                <div class="donor-title-group">
                                    <span class="status-pulse-dot"></span>
                                    <h4 class="donor-display-name"><?php echo htmlentities($result->FullName);?></h4>
                                </div>
                                <span class="blood-type-pill"><?php echo htmlentities($result->BloodGroup);?></span>
                            </div>
                            <div class="card-body-content">
                                <div class="data-attribute-row">
                                    <div class="attribute-icon-frame"><i class="fa fa-phone-square text-muted"></i></div>
                                    <span class="attribute-label">Mobile:</span>
                                    <span class="attribute-value text-dark font-weight-bold"><?php echo htmlentities($result->MobileNumber);?></span>
                                </div>
                                
                                <div class="data-attribute-row">
                                    <div class="attribute-icon-frame"><i class="fa fa-envelope-o"></i></div>
                                    <span class="attribute-label">Email Address:</span>
                                    <span class="attribute-value">
                                        <?php echo ($result->EmailId=="") ? 'Not Available' : htmlentities($result->EmailId); ?>
                                    </span>
                                </div>

                                <div class="data-attribute-row">
                                    <div class="attribute-icon-frame"><i class="fa fa-vcard-o"></i></div>
                                    <span class="attribute-label">Demographics:</span>
                                    <span class="attribute-value text-capitalize"><?php echo htmlentities($result->Gender);?>, <?php echo htmlentities($result->Age);?> Years Old</span>
                                </div>

                                <div class="data-attribute-row">
                                    <div class="attribute-icon-frame"><i class="fa fa-map-marker"></i></div>
                                    <span class="attribute-label">Location:</span>
                                    <span class="attribute-value">
                                        <?php echo ($result->Address=="") ? 'Not Available' : htmlentities($result->Address); ?>
                                    </span>
                                </div>

                                <?php if($result->Message != ""){ ?>
                                    <div class="custom-donor-statement">
                                        <strong>Donor Note:</strong> "<?php echo htmlentities($result->Message);?>"
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <div class="col-12">
                    <div class="empty-results-fallback">
                        <i class="fa fa-folder-open-o mb-3 text-muted" style="font-size: 3rem;"></i>
                        <h5 class="text-dark font-weight-bold">No Match Discovered</h5>
                        <p class="mb-0">There are no available matching profiles registered with those specific attributes right now.</p>
                    </div>
                </div>
            <?php }
        } ?>
        </div>

    </div>

    <?php include('includes/footer.php');?>
    
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>