<?php
// Include your database connection file
include('includes/config.php'); 

// Initialize notification variables
$error = "";
$msg = "";

if(isset($_POST['submit']))
{
    // Collect form data
    $fullname = $_POST['fullname'];
    $mobileno = $_POST['mobileno'];
    $emailid = $_POST['emailid'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $bloodgroup = $_POST['bloodgroup'];
    $address = $_POST['address'];
    $message = $_POST['message'];

    // SQL query for inserting data securely using named placeholders
    $sql = "INSERT INTO tblblooddonars(FullName, MobileNumber, EmailId, Age, Gender, BloodGroup, Address, Message) 
            VALUES(:fullname, :mobileno, :emailid, :age, :gender, :bloodgroup, :address, :message)";
    
    $query = $dbh->prepare($sql);
    
    // Bind the parameters to prevent SQL Injection
    $query->bindParam(':fullname', $fullname, PDO::PARAM_STR);
    $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
    $query->bindParam(':emailid', $emailid, PDO::PARAM_STR);
    $query->bindParam(':age', $age, PDO::PARAM_INT);
    $query->bindParam(':gender', $gender, PDO::PARAM_STR);
    $query->bindParam(':bloodgroup', $bloodgroup, PDO::PARAM_STR);
    $query->bindParam(':address', $address, PDO::PARAM_STR);
    $query->bindParam(':message', $message, PDO::PARAM_STR);
    
    // Execute query and check if insertion was successful
    if($query->execute())
    {
        $msg = "Registration successful! Thank you for becoming a donor.";
    }
    else
    {
        $error = "Something went wrong. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Become a Donor | Blood Bank Management System</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <style>
        body{
            font-family:'Poppins',sans-serif;
            background:#f4f7fc;
        }
        .hero{
            background:linear-gradient(rgba(165,0,0,.75),rgba(220,20,60,.75)), url('images/banner.jpg');
            background-size:cover;
            background-position:center;
            color:#fff;
            padding:120px 0;
            text-align:center;
        }
        .hero h1{ font-size:55px; font-weight:700; }
        .hero p{ font-size:20px; }
        .glass-card{
            background:rgba(255,255,255,.25);
            backdrop-filter:blur(15px);
            border-radius:20px;
            padding:40px;
            box-shadow:0 10px 35px rgba(0,0,0,.2);
            border:1px solid rgba(255,255,255,.4);
        }
        .stats{ margin-top:-70px; }
        .stat-box{
            background:#fff;
            padding:30px;
            border-radius:20px;
            box-shadow:0 10px 30px rgba(0,0,0,.08);
            transition:.4s;
            text-align:center;
        }
        .stat-box:hover{ transform:translateY(-10px); }
        .stat-box i{ font-size:45px; color:#d50000; margin-bottom:15px; }
        .stat-box h3{ font-size:34px; font-weight:700; }
        .stat-box p{ color:#777; }
        .section-title{ font-size:40px; font-weight:700; color:#c4001d; margin-bottom:25px; }
        .form-control{ height:50px; border-radius:12px; }
        textarea.form-control{ height:120px; }
        .form-control:focus{ box-shadow:none; border-color:#d50000; }
        .btn-donor{
            background:#d50000;
            color:#fff;
            padding:15px;
            font-size:18px;
            font-weight:600;
            border-radius:40px;
            transition:.4s;
            width:100%;
            border: none;
        }
        .btn-donor:hover{ background:#9b0000; color:#fff; }
        
        /* New Catchy Side Panel Styling */
        .urgent-card{
            background:#fff;
            padding:35px;
            border-radius:20px;
            box-shadow:0 10px 30px rgba(0,0,0,.08);
            border-top: 5px solid #d50000;
        }
        .urgent-card h3{ font-weight:700; margin-bottom:15px; color:#111; }
        .blood-badge-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-top: 20px;
        }
        .blood-badge {
            background: #fff5f5;
            border: 1px id solid #ffe3e3;
            padding: 12px;
            border-radius: 12px;
            text-align: center;
            font-weight: 700;
            color: #d50000;
        }
        .blood-badge span {
            display: block;
            font-size: 11px;
            color: #888;
            font-weight: 400;
            text-transform: uppercase;
        }
        .pulse-dot {
            width: 8px;
            height: 8px;
            background: #d50000;
            border-radius: 50%;
            display: inline-block;
            margin-right: 6px;
            box-shadow: 0 0 0 0 rgba(213, 0, 0, 0.7);
            animation: pulse 1.6s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(213, 0, 0, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(213, 0, 0, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(213, 0, 0, 0); }
        }

        .errorWrap{ padding:15px; background:#ffe6e6; border-left:5px solid red; margin-bottom:20px; color: red; font-weight: 500; }
        .succWrap{ padding:15px; background:#e6ffe6; border-left:5px solid green; margin-bottom:20px; color: green; font-weight: 500; }
    </style>
</head>

<body>

<?php include('includes/header.php'); ?>

<section class="hero">
    <div class="container">
        <h1>Become A Blood Donor</h1>
        <p>One Donation Can Save Up To Three Lives</p>
        <a href="#register" class="btn btn-light btn-lg mt-4">Register Now</a>
    </div>
</section>

<div class="container stats">
    <div class="row">
        <div class="col-md-4">
            <div class="stat-box">
                <i class="fa fa-heartbeat"></i>
                <h3>
                    <?php 
                    $sql_saved = "SELECT id FROM tblblooddonars";
                    $query_saved = $dbh->prepare($sql_saved);
                    $query_saved->execute();
                    $total_donors = $query_saved->rowCount();
                    $lives_saved = $total_donors > 0 ? ($total_donors * 3) : 0;
                    echo htmlentities($lives_saved);
                    ?>
                </h3>
                <p>Lives Saved (Est.)</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-box">
                <i class="fa fa-users"></i>
                <h3>
                    <?php 
                    $sql_donors = "SELECT id FROM tblblooddonars";
                    $query_donors = $dbh->prepare($sql_donors);
                    $query_donors->execute();
                    echo htmlentities($query_donors->rowCount());
                    ?>
                </h3>
                <p>Active Donors</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-box">
                <i class="fa fa-tint"></i>
                <h3>
                    <?php 
                    $sql_groups = "SELECT id FROM tblbloodgroup";
                    $query_groups = $dbh->prepare($sql_groups);
                    $query_groups->execute();
                    $group_count = $query_groups->rowCount();
                    echo htmlentities($group_count > 0 ? $group_count : 8);
                    ?>
                </h3>
                <p>Blood Groups Available</p>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5" id="register">
    <div class="row">
        
        <div class="col-lg-4 mb-4">
            <div class="urgent-card">
                <h3><span class="pulse-dot"></span> Live Requirements</h3>
                <p class="text-muted small">Hospitals in our network currently have critical shortages for the following blood groups:</p>
                
                <div class="blood-badge-grid">
                    <div class="blood-badge">O- <span>Critical</span></div>
                    <div class="blood-badge">A+ <span>High Demand</span></div>
                    <div class="blood-badge">B- <span>Critical</span></div>
                    <div class="blood-badge">AB- <span>Needed</span></div>
                </div>
                
                <hr class="mt-4">
                <h5 class="text-danger font-weight-bold mt-3"><i class="fa fa-clock-o"></i> Timing is Everything</h5>
                <p class="small text-muted mb-0">Blood processing takes up to 48 hours. Registering today ensures supply is verified and ready when unexpected emergencies strike.</p>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="glass-card">
                <h2 class="section-title">Donor Registration Form</h2>

                <?php if(!empty($error)){ ?>
                    <div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?> </div>
                <?php } else if(!empty($msg)){ ?>
                    <div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?> </div>
                <?php } ?>

                <form method="post">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label><i class="fa fa-user text-danger"></i> Full Name</label>
                            <input type="text" name="fullname" class="form-control" placeholder="Enter your full name" required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label><i class="fa fa-phone text-danger"></i> Mobile Number</label>
                            <input type="text" name="mobileno" class="form-control" placeholder="Enter mobile number" required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label><i class="fa fa-envelope text-danger"></i> Email Address</label>
                            <input type="email" name="emailid" class="form-control" placeholder="Enter email address">
                        </div>

                        <div class="col-md-6 mb-4">
                            <label><i class="fa fa-calendar text-danger"></i> Age</label>
                            <input type="number" name="age" class="form-control" placeholder="Enter your age" required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label><i class="fa fa-venus-mars text-danger"></i> Gender</label>
                            <select name="gender" class="form-control" required>
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label><i class="fa fa-tint text-danger"></i> Blood Group</label>
                            <select name="bloodgroup" class="form-control" required>
                                <option value="">Select Blood Group</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                        </div>

                        <div class="col-md-12 mb-4">
                            <label><i class="fa fa-map-marker text-danger"></i> Address</label>
                            <textarea name="address" class="form-control" rows="3" placeholder="Enter your complete address"></textarea>
                        </div>

                        <div class="col-md-12 mb-4">
                            <label><i class="fa fa-comment text-danger"></i> Why do you want to become a donor?</label>
                            <textarea name="message" class="form-control" rows="5" placeholder="Write a short message..." required></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" name="submit" class="btn btn-donor">
                                <i class="fa fa-heart"></i> Become a Donor
                            </button>
                        </div>
                        <div class="col-md-6 text-center mt-3">
                            <h5 class="text-danger"><i class="fa fa-heartbeat"></i> Donate Blood, Save Lives ❤️</h5>
                            <p class="text-muted">A single blood donation can save up to three lives.</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<section class="mt-5 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="stat-box">
                    <i class="fa fa-ambulance"></i>
                    <h4>Emergency Support</h4>
                    <p>We help hospitals maintain adequate blood supplies for emergency situations.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-box">
                    <i class="fa fa-medkit"></i>
                    <h4>Health Check</h4>
                    <p>Every donor receives a free health screening before blood donation.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-box">
                    <i class="fa fa-smile-o"></i>
                    <h4>Join Our Family</h4>
                    <p>Become part of our growing community of life-saving heroes.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section style="background:linear-gradient(135deg,#b30000,#ff4d4d);padding:70px 0;color:#fff;">
    <div class="container text-center">
        <h2 style="font-size:42px;font-weight:700;">Be Someone's Hero Today ❤️</h2>
        <p style="font-size:20px;margin-top:20px;">Every blood donation has the power to save lives. Join thousands of generous donors making a difference every day.</p>
        <a href="#register" class="btn btn-light btn-lg mt-3 px-5">Register Now</a>
    </div>
</section>

<a href="#register" class="floating-btn" style="position:fixed;bottom:30px;right:30px;width:65px;height:65px;background:#d50000;color:white;border-radius:50%;display:flex;justify-content:center;align-items:center;font-size:28px;box-shadow:0 8px 25px rgba(0,0,0,.3);z-index:999;text-decoration:none;transition:.4s;">
    <i class="fa fa-heart"></i>
</a>

<?php include('includes/footer.php'); ?>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/tether/tether.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<script>
    // Smooth Scroll Configurations
    $('a[href*="#"]').on('click', function(e){
        e.preventDefault();
        $('html, body').animate({
            scrollTop: $($(this).attr('href')).offset().top-70
        },700);
    });

    // Viewport Intersection Scroll Animation Tracking
    function checkScrollAnimation() {
        $('.stat-box').each(function(){
            var top=$(this).offset().top;
            var scroll=$(window).scrollTop();
            var height=$(window).height();

            if(scroll>top-height+100){
                $(this).css({
                    'opacity':'1',
                    'transform':'translateY(0px)'
                });
            }
        });
    }

    $(window).scroll(checkScrollAnimation);

    // Initial Styles Injector Definition
    $('.stat-box').css({
        'opacity':'0',
        'transform':'translateY(50px)',
        'transition':'all .8s'
    });

    checkScrollAnimation();

    // Isolated Hover Animations Setup Rules
    $('.floating-btn').hover(function(){
        $(this).css({ 'transform':'scale(1.1)', 'background':'#a30000' });
    }, function(){
        $(this).css({ 'transform':'scale(1)', 'background':'#d50000' });
    });
</script>

</body>
</html>