<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['alogin'])==0) {   
    header('location:index.php');
} else {
    if(isset($_REQUEST['hidden'])) {
        $eid=intval($_GET['hidden']);
        $status="0";
        $sql = "UPDATE tblblooddonars SET Status=:status WHERE id=:eid";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':status',$status, PDO::PARAM_STR);
        $query-> bindParam(':eid',$eid, PDO::PARAM_STR);
        $query -> execute();

        $msg="Donor status set to Hidden successfully.";
    }

    if(isset($_REQUEST['public'])) {
        $aeid=intval($_GET['public']);
        $status=1;

        $sql = "UPDATE tblblooddonars SET Status=:status WHERE id=:aeid";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':status',$status, PDO::PARAM_STR);
        $query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
        $query -> execute();

        $msg="Donor status set to Public successfully.";
    }

    if(isset($_REQUEST['del'])) {
        $did=intval($_GET['del']);
        $sql = "delete from tblblooddonars WHERE id=:did";
        $query = $dbh->prepare($sql);
        $query-> bindParam(':did',$did, PDO::PARAM_STR);
        $query -> execute();

        $msg="Record deleted successfully.";
    }
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="theme-color" content="#dc3545">
    
    <title>BBDMS | Donor List</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <link rel="stylesheet" href="css/fileinput.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
        body {
            font-family: 'Inter', sans-serif !important;
            background-color: #f4f6f9;
            color: #333;
        }
        .content-wrapper {
            padding: 30px 25px;
        }
        .page-title {
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 25px;
            font-size: 26px;
            letter-spacing: -0.5px;
        }
        /* Custom Alert Wrappers */
        .errorWrap, .succWrap {
            padding: 14px 20px;
            margin-bottom: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,.04);
            font-size: 14px;
            font-weight: 500;
        }
        .errorWrap {
            background: #fff5f5;
            border-left: 5px solid #e53e3e;
            color: #c53030;
        }
        .succWrap {
            background: #f0fff4;
            border-left: 5px solid #38a169;
            color: #22543d;
        }
        /* Modernized Panel */
        .panel-custom {
            background: #ffffff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 30px;
        }
        .panel-custom .panel-heading {
            background: #ffffff;
            color: #2d3748;
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 22px 30px;
            border-bottom: 1px solid #f1f5f9;
        }
        .panel-custom .panel-body {
            padding: 30px;
        }
        /* Download Button Styling */
        .btn-download {
            background-color: #e53e3e;
            color: #fff !important;
            padding: 10px 22px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            display: inline-block;
            transition: all 0.2s ease;
            text-decoration: none !important;
            border: none;
        }
        .btn-download:hover {
            background-color: #c53030;
            transform: translateY(-1px);
        }
        /* Table Enhancements */
        #zctb {
            width: 100% !important;
            margin-top: 20px !important;
            margin-bottom: 20px !important;
        }
        #zctb thead th {
            background-color: #f8fafc;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
            padding: 14px 16px !important;
            border-bottom: 2px solid #e2e8f0 !important;
            border-top: none !important;
        }
        #zctb tbody td {
            padding: 16px 16px !important;
            vertical-align: middle !important;
            color: #475569;
            font-size: 14px;
            border-bottom: 1px solid #f1f5f9;
        }
        #zctb tbody tr:hover {
            background-color: #fafafa;
        }
        /* Truncate long descriptions beautifully */
        .td-truncate {
            max-width: 180px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        /* Custom Badges */
        .age-badge {
            background-color: #f1f5f9 !important;
            color: #475569 !important;
            font-weight: 600;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 12px;
        }
        .blood-badge {
            font-weight: 700;
            font-size: 12px;
            background-color: #fee2e2 !important;
            color: #ef4444 !important;
            padding: 6px 12px;
            border-radius: 6px;
            display: inline-block;
        }
        /* Action Buttons */
        .btn-action {
            padding: 6px 14px;
            font-size: 13px;
            font-weight: 600;
            border-radius: 6px;
            border: none;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none !important;
        }
        .btn-action-hide {
            background-color: #fef3c7;
            color: #d97706;
        }
        .btn-action-hide:hover { background-color: #fde68a; }
        .btn-action-public {
            background-color: #dcfce7;
            color: #15803d;
        }
        .btn-action-public:hover { background-color: #bbf7d0; }
        .btn-action-delete {
            background-color: #fee2e2;
            color: #b91c1c;
        }
        .btn-action-delete:hover { background-color: #fecaca; }

        /* DataTables Elements Polish */
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #cbd5e1 !important;
            border-radius: 8px !important;
            padding: 6px 12px !important;
            outline: none;
        }
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #94a3b8 !important;
        }
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #cbd5e1 !important;
            border-radius: 8px !important;
            padding: 6px 10px !important;
            outline: none;
        }
        /* Pagination Polish */
        .dataTables_wrapper .dataTables_paginate .pagination > .active > a {
            background-color: #e53e3e !important;
            border-color: #e53e3e !important;
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

                        <h2 class="page-title">Donors Management</h2>

                        <div class="panel panel-custom">
                            <div class="panel-heading">Active Donors Registry</div>
                            <div class="panel-body">
                                
                                <?php if($error){ ?>
                                    <div class="errorWrap"><strong><i class="fa fa-times-circle"></i> ERROR</strong>: <?php echo htmlentities($error); ?> </div>
                                <?php } else if($msg){ ?>
                                    <div class="succWrap"><strong><i class="fa fa-check-circle"></i> SUCCESS</strong>: <?php echo htmlentities($msg); ?> </div>
                                <?php } ?>
                                
                                <div style="margin-bottom: 25px;">
                                    <a href="download-records.php" class="btn-download">
                                        <i class="fa fa-download"></i> &nbsp;Export Donor List (Excel)
                                    </a>
                                </div>

                                <div class="table-responsive">
                                    <table id="zctb" class="table table-hover" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Mobile No</th>
                                                <th>Email</th>
                                                <th>Gender</th>
                                                <th>Age</th>
                                                <th>Blood Group</th>
                                                <th>Address</th>
                                                <th>Message</th>
                                                <th style="width: 170px; text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $sql = "SELECT * from tblblooddonars";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt=1;
                                            
                                            if($query->rowCount() > 0) {
                                                foreach($results as $result) { ?>   
                                                    <tr>
                                                        <td><strong><?php echo htmlentities($cnt);?></strong></td>
                                                        <td style="font-weight: 600; color: #1e293b;"><?php echo htmlentities($result->FullName);?></td>
                                                        <td><?php echo htmlentities($result->MobileNumber);?></td>
                                                        <td><?php echo htmlentities($result->EmailId);?></td>
                                                        <td><?php echo htmlentities($result->Gender);?></td>
                                                        <td><span class="age-badge"><?php echo htmlentities($result->Age);?></span></td>
                                                        <td><span class="blood-badge"><?php echo htmlentities($result->BloodGroup);?></span></td>
                                                        <td><div class="td-truncate" title="<?php echo htmlentities($result->Address);?>"><?php echo htmlentities($result->Address);?></div></td>
                                                        <td><div class="td-truncate" title="<?php echo htmlentities($result->Message);?>"><?php echo htmlentities($result->Message);?></div></td>
                                                        <td style="text-align: center; white-space: nowrap;">
                                                            <?php if($result->Status == 1) { ?>
                                                                <a href="donor-list.php?hidden=<?php echo htmlentities($result->id);?>" class="btn-action btn-action-hide" onclick="return confirm('Do you really want to hide this detail?')"><i class="fa fa-eye-slash"></i> Hide</a> 
                                                            <?php } else { ?>
                                                                <a href="donor-list.php?public=<?php echo htmlentities($result->id);?>" class="btn-action btn-action-public" onclick="return confirm('Do you really want to make this detail public?')"><i class="fa fa-eye"></i> Public</a>
                                                            <?php } ?>
                                                            <a href="donor-list.php?del=<?php echo htmlentities($result->id);?>" class="btn-action btn-action-delete" style="margin-left: 4px;" onclick="return confirm('Do you really want to delete this record?')"><i class="fa fa-trash"></i> Delete</a>
                                                        </td>
                                                    </tr>
                                            <?php 
                                                    $cnt=$cnt+1; 
                                                } 
                                            } ?>
                                        </tbody>
                                    </table>
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