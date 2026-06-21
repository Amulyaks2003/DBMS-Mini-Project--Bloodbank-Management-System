<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['alogin'])==0) {	
    header('location:index.php');
} else {
    // Mark as Read Action
    if(isset($_REQUEST['eid'])) {
        $eid=intval($_GET['eid']);
        $status=1;
        $sql = "UPDATE tblcontactusquery SET status=:status WHERE id=:eid";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':status',$status, PDO::PARAM_STR);
        $query-> bindParam(':eid',$eid, PDO::PARAM_STR);
        $query -> execute();

        $msg="Query marked as read successfully";
    }

    // Delete Action
    if(isset($_REQUEST['del'])) {
        $did=intval($_GET['del']);
        $sql = "delete from tblcontactusquery WHERE id=:did";
        $query = $dbh->prepare($sql);
        $query-> bindParam(':did',$did, PDO::PARAM_STR);
        $query -> execute();

        $msg="Record deleted successfully";
    }
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>BBDMS | Admin Manage Queries</title>

	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/style.css">
    
    <style>
		/* Global typography adjustments for higher text scale */
		body {
			font-family: "Times New Roman", Times, serif !important;
			font-size: 16px !important;
		}
		table, th, td, h2, .panel-heading {
			font-family: "Times New Roman", Times, serif !important;
		}
		h2.page-title {
			font-size: 28px !important;
			font-weight: bold;
		}
		.panel-heading {
			font-size: 20px !important;
			font-weight: 600;
		}
		/* Make table headings and rows visually prominent */
		table.table th {
			font-size: 17px !important;
			padding: 12px !important;
		}
		table.table td {
			font-size: 16px !important;
			vertical-align: middle !important;
			padding: 12px !important;
		}
		.errorWrap {
			padding: 12px;
			margin: 0 0 20px 0;
			background: #fff;
			border-left: 4px solid #dd3d36;
			box-shadow: 0 1px 3px 0 rgba(0,0,0,.1);
			border-radius: 4px;
			font-size: 16px;
		}
		.succWrap{
			padding: 12px;
			margin: 0 0 20px 0;
			background: #fff;
			border-left: 4px solid #5cb85c;
			box-shadow: 0 1px 3px 0 rgba(0,0,0,.1);
			border-radius: 4px;
			font-size: 16px;
		}
		.table-responsive {
			margin-top: 15px;
			overflow-x: auto;
		}
		.badge-status {
			font-size: 13px !important;
			padding: 6px 12px;
			display: inline-block;
			margin-bottom: 6px;
			font-family: inherit;
		}
		.btn-xs {
			font-size: 13px !important;
			padding: 4px 10px !important;
		}
		/* Scaling DataTables Search controls, pagination components, and text items */
		.dataTables_wrapper .dataTables_length, 
		.dataTables_wrapper .dataTables_filter, 
		.dataTables_wrapper .dataTables_info, 
		.dataTables_wrapper .dataTables_paginate {
			font-family: "Times New Roman", Times, serif !important;
			font-size: 15px !important;
			margin-bottom: 10px;
		}
		.dataTables_wrapper .dataTables_filter input,
		.dataTables_wrapper .dataTables_length select {
			font-size: 15px !important;
			padding: 4px;
		}
		.text-muted {
			font-size: 14px !important;
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

						<h2 class="page-title" style="margin-top: 20px;">Manage Contact Us Queries</h2>

						<div class="panel panel-default">
							<div class="panel-heading">User Queries List</div>
							<div class="panel-body">
							    <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?> </div><?php } 
				                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?> </div><?php }?>
								
                                <div class="table-responsive">
                                    <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Contact No</th>
                                                <th>Message</th>
                                                <th>Posting date</th>
                                                <th width="170">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php 
                                        $sql = "SELECT * from tblcontactusquery";
                                        $query = $dbh -> prepare($sql);
                                        $query->execute();
                                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt=1;
                                        if($query->rowCount() > 0) {
                                            foreach($results as $result) { ?>	
                                            <tr>
                                                <td><?php echo htmlentities($cnt);?></td>
                                                <td><strong><?php echo htmlentities($result->name);?></strong></td>
                                                <td><?php echo htmlentities($result->EmailId);?></td>
                                                <td><?php echo htmlentities($result->ContactNumber);?></td>
                                                <td><?php echo htmlentities($result->Message);?></td>
                                                <td><span class="text-muted"><?php echo htmlentities($result->PostingDate);?></span></td>
                                                <td>
                                                    <?php if($result->status==1) { ?>
                                                        <span class="badge badge-status btn-success"><i class="fa fa-check"></i> Read</span>
                                                        <a href="manage-conactusquery.php?del=<?php echo htmlentities($result->id);?>" class="btn btn-danger btn-xs" onclick="return confirm('Do you really want to delete this query?')" title="Delete"><i class="fa fa-trash"></i> Delete</a>
                                                    <?php } else { ?>
                                                        <span class="badge badge-status btn-warning"><i class="fa fa-clock-o"></i> Pending</span>
                                                        <div class="btn-group" style="display: block;">
                                                            <a href="manage-conactusquery.php?eid=<?php echo htmlentities($result->id);?>" class="btn btn-primary btn-xs" onclick="return confirm('Mark this query as read?')" title="Mark Read"><i class="fa fa-envelope-open"></i> Read</a>
                                                            <a href="manage-conactusquery.php?del=<?php echo htmlentities($result->id);?>" class="btn btn-danger btn-xs" onclick="return confirm('Do you really want to delete this query?')" title="Delete"><i class="fa fa-trash"></i></a>
                                                        </div>
                                                    <?php } ?>
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
		</div>
	</div>

	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
<?php } ?>