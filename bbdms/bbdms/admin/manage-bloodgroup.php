<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{   
    header('location:index.php');
}
else{
    if(isset($_GET['del']))
    {
        $id=$_GET['del'];
        $sql = "delete from tblbloodgroup WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':id',$id, PDO::PARAM_STR);
        $query -> execute();
        $msg="Data Deleted successfully";
    }
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>BBDMS | Admin Manage Blood Groups</title>

    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            color: #334155;
        }
        .page-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 30px;
            font-size: 28px;
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 10px;
        }
        
        /* Clean Container Box */
        .custom-card {
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid #e2e8f0;
            padding: 30px;
            margin-bottom: 30px;
        }
        .custom-card-title {
            font-size: 20px;
            font-weight: 600;
            color: #0f172a;
            margin-top: 0;
            margin-bottom: 25px;
            padding-left: 5px;
        }

        /* Highlighting Top Controls Strip in Subtle Light-Red Tint */
        .dataTables_wrapper .row:first-child {
            background: #fff5f5;
            border: 1px solid #fee2e2;
            border-radius: 10px;
            padding: 16px 10px;
            margin-left: 0 !important;
            margin-right: 0 !important;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
        }
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter label {
            color: #475569 !important;
            font-weight: 500;
        }

        /* Modernized Text Inputs with Vivid Crimson Focus Outlines */
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #cbd5e1 !important;
            border-radius: 8px !important;
            padding: 8px 14px !important;
            background-color: #ffffff !important;
            color: #0f172a !important;
            width: 220px;
            transition: all 0.2s ease;
        }
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #de1f26 !important;
            box-shadow: 0 0 0 3px rgba(222, 31, 38, 0.15) !important;
            outline: none;
        }
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #cbd5e1 !important;
            border-radius: 8px !important;
            padding: 6px 12px !important;
            background-color: #ffffff !important;
            color: #0f172a !important;
        }

        /* Custom Structured Table Layout */
        .table-custom {
            width: 100% !important;
            margin-top: 10px !important;
        }
        .table-custom thead th {
            background-color: #f8fafc !important;
            color: #334155 !important;
            font-weight: 600 !important;
            border-bottom: 2px solid #fca5a5 !important; /* Crimson theme marker */
            padding: 16px 18px !important;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }
        .table-custom tbody td {
            padding: 16px 18px !important;
            border-bottom: 1px solid #f1f5f9 !important;
            vertical-align: middle !important;
            color: #475569;
            font-size: 14px;
        }
        .table-custom tbody tr:hover {
            background-color: #fffafb !important; /* Subtle rosy glow on hover */
        }

        /* Premium Crimson Action Buttons */
        .btn-action-delete {
            display: inline-flex;
            align-items: center;
            background-color: #fef2f2;
            color: #dc2626;
            border: 1px solid #fee2e2;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .btn-action-delete:hover {
            background-color: #dc2626;
            color: #ffffff;
            border-color: #dc2626;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.15);
        }
        .btn-action-delete i {
            margin-right: 6px;
        }

        /* Feedback Status Alerts */
        .alert-custom {
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 25px;
            font-weight: 500;
            border: none;
            display: flex;
            align-items: center;
        }
        .alert-custom i { margin-right: 12px; font-size: 18px; }
        .alert-custom-error { background-color: #fef2f2; color: #991b1b; }
        .alert-custom-success { background-color: #f0fdf4; color: #166534; }
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

                        <h2 class="page-title"><i class="fa fa-list text-danger" style="margin-right: 12px;"></i>Manage Blood Groups</h2>

                        <div class="custom-card">
                            <h3 class="custom-card-title">Listed Blood Groups</h3>
                            
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

                            <table id="zctb" class="display table table-custom table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Blood Group</th>
                                        <th>Creation Date</th>
                                        <th style="text-align: right;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $sql = "SELECT * from tblbloodgroup";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                        foreach($results as $result)
                                        { ?>  
                                            <tr>
                                                <td><?php echo htmlentities($cnt);?></td>
                                                <td><strong style="color: #dc2626; font-size: 15px;"><?php echo htmlentities($result->BloodGroup);?></strong></td>
                                                <td><?php echo htmlentities($result->PostingDate);?></td>
                                                <td style="text-align: right;">
                                                    <a href="manage-bloodgroup.php?del=<?php echo $result->id;?>" onclick="return confirm('Are you sure you want to delete this blood group?');" class="btn-action-delete">
                                                        <i class="fa fa-trash-o"></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php $cnt=$cnt+1; 
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

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
<?php } ?>