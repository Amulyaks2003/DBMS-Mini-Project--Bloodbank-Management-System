<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0) {   
    header('location:index.php');
} else {
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
    
    <title>BBDMS | Admin Dashboard</title>

    <!-- Font awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Sandstone Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap Datatables -->
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <!-- Bootstrap social button library -->
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <!-- Bootstrap select -->
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <!-- Bootstrap file input -->
    <link rel="stylesheet" href="css/fileinput.min.css">
    <!-- Awesome Bootstrap checkbox -->
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <!-- Admin Style -->
    <link rel="stylesheet" href="css/style.css">

    <style>
        body {
            background-color: #f4f7f6;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }
        .page-title {
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 30px;
            border-bottom: 2px solid #eef2f5;
            padding-bottom: 15px;
        }
        .dashboard-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 30px;
            overflow: hidden;
            background: #fff;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }
        .card-body-gradient {
            padding: 30px 20px;
            color: #ffffff !important;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .bg-gradient-blood {
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
        }
        .bg-gradient-donor {
            background: linear-gradient(45deg, #11998e, #38ef7d);
        }
        .bg-gradient-query {
            background: linear-gradient(45deg, #00c6ff, #0072ff);
        }
        .stat-number {
            font-size: 42px;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 5px;
        }
        .stat-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.9;
            font-weight: 600;
        }
        .stat-icon {
            font-size: 45px;
            opacity: 0.3;
        }
        .card-footer-action {
            background: #fff;
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #606f7b;
            text-decoration: none !important;
            font-weight: 600;
            font-size: 13px;
            border-top: 1px solid #f1f5f8;
            transition: background 0.2s ease;
        }
        .card-footer-action:hover {
            background: #fafbfa;
            color: #333;
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

                        <h2 class="page-title">Dashboard Overview</h2>
                        
                        <div class="row">
                            <!-- Blood Groups Card -->
                            <div class="col-md-4 col-sm-6">
                                <div class="dashboard-card">
                                    <div class="card-body-gradient bg-gradient-blood">
                                        <div>
                                            <?php 
                                            $sql ="SELECT id from tblbloodgroup ";
                                            $query = $dbh -> prepare($sql);
                                            $query->execute();
                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                            $bg=$query->rowCount();
                                            ?>
                                            <div class="stat-number"><?php echo htmlentities($bg);?></div>
                                            <div class="stat-label">Listed Blood Groups</div>
                                        </div>
                                        <div class="stat-icon">
                                            <i class="fa fa-tint"></i>
                                        </div>
                                    </div>
                                    <a href="manage-bloodgroup.php" class="card-footer-action">
                                        <span>View Details</span> <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- Registered Donors Card -->
                            <div class="col-md-4 col-sm-6">
                                <div class="dashboard-card">
                                    <div class="card-body-gradient bg-gradient-donor">
                                        <div>
                                            <?php 
                                            $sql1 ="SELECT id from tblblooddonars ";
                                            $query1 = $dbh -> prepare($sql1);
                                            $query1->execute();
                                            $results1=$query1->fetchAll(PDO::FETCH_OBJ);
                                            $regbd=$query1->rowCount();
                                            ?>
                                            <div class="stat-number"><?php echo htmlentities($regbd);?></div>
                                            <div class="stat-label">Registered Donors</div>
                                        </div>
                                        <div class="stat-icon">
                                            <i class="fa fa-users"></i>
                                        </div>
                                    </div>
                                    <a href="donor-list.php" class="card-footer-action">
                                        <span>View Details</span> <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- Total Queries Card -->
                            <div class="col-md-4 col-sm-6">
                                <div class="dashboard-card">
                                    <div class="card-body-gradient bg-gradient-query">
                                        <div>
                                            <?php 
                                            $sql6 ="SELECT id from tblcontactusquery ";
                                            $query6 = $dbh -> prepare($sql6);
                                            $query6->execute();
                                            $results6=$query6->fetchAll(PDO::FETCH_OBJ);
                                            $query_count=$query6->rowCount();
                                            ?>
                                            <div class="stat-number"><?php echo htmlentities($query_count);?></div>
                                            <div class="stat-label">Total Queries</div>
                                        </div>
                                        <div class="stat-icon">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                    </div>
                                    <a href="manage-conactusquery.php" class="card-footer-action">
                                        <span>View Details</span> <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Loading Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/fileinput.js"></script>
    <script src="js/chartData.js"></script>
    <script src="js/main.js"></script>
    
    <script>
    window.onload = function(){
        // Check if canvas elements exist before rendering charts to avoid JS errors
        if(document.getElementById("dashReport")){
            var ctx = document.getElementById("dashReport").getContext("2d");
            window.myLine = new Chart(ctx).Line(swirlData, {
                responsive: true,
                scaleShowVerticalLines: false,
                scaleBeginAtZero : true,
                multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
            }); 
        }

        if(document.getElementById("chart-area3")){
            var doctx = document.getElementById("chart-area3").getContext("2d");
            window.myDoughnut = new Chart(doctx).Pie(doughnutData, {responsive : true});
        }

        if(document.getElementById("chart-area4")){
            var doctx = document.getElementById("chart-area4").getContext("2d");
            window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {responsive : true});
        }
    }
    </script>
</body>
</html>
<?php } ?>