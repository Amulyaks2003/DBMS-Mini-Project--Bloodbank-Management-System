<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title>BloodBank & Donor Management</title>

<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="css/modern-business.css" rel="stylesheet">

<style>

.navbar-toggler{
    z-index:1;
}

@media(max-width:576px){
    nav>.container{
        width:100%;
    }
}

body{
    background:#f5f7fa;
}

/* Card */
.page-card{
    background:#ffffff;
    border-radius:15px;
    padding:25px;
    margin-bottom:40px;
    box-shadow:0 8px 25px rgba(0,0,0,0.10);
}

/* Image */
.page-image{
    width:100%;
    height:430px;
    object-fit:cover;
    border-radius:15px;
    transition:0.4s;
    box-shadow:0 8px 20px rgba(0,0,0,.18);
}

.page-image:hover{
    transform:scale(1.03);
}

/* Text */
.page-content{
    font-size:19px;
    line-height:34px;
    text-align:justify;
    color:#444;
}

/* Heading */
.page-heading{
    color:#dc3545;
    font-weight:bold;
    margin-bottom:20px;
}

/* Quote */
.quote-box{
    margin-top:30px;
    background:#fff3f3;
    border-left:6px solid #dc3545;
    padding:20px;
    border-radius:10px;
    text-align:center;
    font-size:22px;
    color:#c82333;
    font-style:italic;
}

.breadcrumb{
    background:#eceff1;
}

.display-title{
    color:#dc3545;
    font-weight:bold;
}

</style>

</head>

<body>

<?php include('includes/header.php'); ?>

<div class="container">

<?php

$pagetype=$_GET['type'];

$sql="SELECT type,detail,PageName FROM tblpages WHERE type=:pagetype";
$query=$dbh->prepare($sql);
$query->bindParam(':pagetype',$pagetype,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount()>0)
{
foreach($results as $result)
{

$image="images/default.jpg";

if($pagetype=="aboutus")
{
    $image="images/mission.jfif";
}
elseif($pagetype=="donor")
{
    $image="images/whydonate.jfif"; 
}

?>

<h1 class="display-4 display-title mt-4 mb-3">
<i class="fa fa-heartbeat"></i>
<?php echo htmlentities($result->PageName);?>
</h1>

<ol class="breadcrumb">

<li class="breadcrumb-item">
<a href="index.php">Home</a>
</li>

<li class="breadcrumb-item active">
<?php echo htmlentities($result->PageName);?>
</li>

</ol>

<div class="page-card">

<div class="row">

<div class="col-md-5">

<img src="<?php echo $image;?>" class="page-image" alt="Blood Bank">

</div>

<div class="col-md-7">

<h3 class="page-heading">
<i class="fa fa-heart text-danger"></i>

<?php
if($pagetype=="aboutus")
echo " Our Mission";
else
echo " Why Donate Blood?";
?>

</h3>

<div class="page-content">

<?php echo $result->detail; ?>

</div>

</div>

</div>

<div class="quote-box">

<i class="fa fa-heart"></i>

Blood isn't just a gift; it's a lifeline. When you share yours, you spark hope and save up to three lives in a single heartbeat.

</div>

</div>

<?php
}
}
?>

</div>

<?php include('includes/footer.php'); ?>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/tether/tether.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>