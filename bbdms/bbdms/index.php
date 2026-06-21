<?php
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BloodBank & Donor Management</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/modern-business.css" rel="stylesheet">
    
    <!-- Clean Google Font for a high-end web feel -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            color: #334155;
        }
        
        .navbar-toggler {
            z-index: 1;
        }
        
        @media (max-width: 576px) {
            nav > .container {
                width: 100%;
            }
        }
        
        .carousel-item.active,
        .carousel-item-next,
        .carousel-item-prev {
            display: block;
        }

        /* Modernized Header Line Indicator */
        .section-heading {
            font-weight: 700;
            color: #0f172a;
            position: relative;
            padding-bottom: 14px;
            margin-bottom: 35px;
            letter-spacing: -0.5px;
        }
        .section-heading::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            height: 4px;
            width: 60px;
            background-color: #e11d48;
            border-radius: 2px;
        }

        /* Sleek Info Cards with Subtle Floating Animations */
        .info-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s ease;
            background: #ffffff;
            height: 100%;
            border: 1px solid #e2e8f0;
        }
        .info-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06);
            border-color: #cbd5e1;
        }
        .info-card .card-header {
            background-color: transparent;
            border-bottom: 1px solid #f1f5f9;
            font-weight: 600;
            color: #e11d48;
            font-size: 1.25rem;
            padding: 24px 24px 16px 24px;
        }
        .info-card .card-body {
            padding: 0 24px 24px 24px;
            color: #64748b;
            line-height: 1.7;
            font-size: 0.95rem;
        }

        /* Elegant Icon Badges */
        .card-header i {
            background: #fff1f2;
            padding: 10px;
            border-radius: 10px;
            margin-right: 8px;
            display: inline-block;
        }

        /* Redesigned Checkbox Lists */
        .blood-groups-list {
            list-style: none;
            padding-left: 0;
        }
        .blood-groups-list li {
            position: relative;
            padding-left: 32px;
            margin-bottom: 14px;
            font-weight: 500;
            color: #475569;
            font-size: 1.05rem;
        }
        .blood-groups-list li::before {
            content: "\f058";
            font-family: FontAwesome;
            position: absolute;
            left: 0;
            top: 1px;
            color: #10b981;
            font-size: 1.15rem;
        }

        /* Striking Call To Action Banner */
        .cta-banner {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            color: #ffffff;
            padding: 45px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.04);
            border: none;
        }
        .btn-cta {
            background-color: #e11d48;
            color: #ffffff !important;
            border: none;
            padding: 16px 35px;
            font-weight: 600;
            font-size: 1.05rem;
            border-radius: 12px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(225, 29, 72, 0.3);
        }
        .btn-cta:hover {
            background-color: #be123c;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(225, 29, 72, 0.4);
        }
    </style>

</head>

<body>

    <!-- Navigation (Untouched structure) -->
    <?php include('includes/header.php');?>
    <?php include('includes/slider.php');?>
   
    <!-- Page Content Container -->
    <div class="container my-5 pt-3">

        <h1 class="text-center font-weight-bold mb-5" style="color: #0f172a; font-size: 2.5rem; letter-spacing: -0.5px;">Welcome to BloodBank & Donor Management</h1>

        <!-- Marketing Cards Row -->
        <div class="row mb-5">
            <div class="col-lg-4 mb-4">
                <div class="card info-card">
                    <h4 class="card-header"><i class="fa fa-heartbeat"></i> The need for blood</h4>
                    <div class="card-body">
                        <p class="card-text">Blood is your body's vital transport and defense system, delivering essential oxygen and nutrients to cells while carrying away waste. It also deploys white blood cells to fight infections and utilizes platelets to clot wounds and prevent bleeding.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card info-card">
                    <h4 class="card-header"><i class="fa fa-lightbulb-o"></i> Blood Tips</h4>
                    <div class="card-body">
                        <p class="card-text">Keep your blood healthy by staying well-hydrated to improve circulation and eating iron-rich foods like meats, broccoli, or peas to boost oxygen delivery. For maximum benefit, pair those iron sources with Vitamin C and avoid drinking coffee or tea during your meals.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card info-card">
                    <h4 class="card-header"><i class="fa fa-users"></i> Who you could Help</h4>
                    <div class="card-body">
                        <p class="card-text">Your single donation can save up to three lives. Every day, blood transfusions help trauma patients, individuals undergoing complex surgeries, mothers facing childbirth complications, and patients battling cancer or chronic blood disorders.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Two-Column Features Block Section -->
        <div class="row align-items-center my-5 py-4">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="section-heading">Blood Groups</h2>
                <p class="text-muted mb-4">Blood group of any human being will mainly fall in any one of the following groups.</p>
                <ul class="blood-groups-list mb-4">
                    <li>A positive or A negative</li>
                    <li>B positive or B negative</li>
                    <li>O positive or O negative</li>
                    <li>AB positive or AB negative.</li>
                </ul>
                <p class="text-muted" style="font-size: 0.95rem;">A healthy diet helps ensure a successful blood donation, and also makes you feel better! Check out the following recommended foods to eat prior to your donation.</p>
            </div>
            <div class="col-lg-6 text-center">
                <img class="img-fluid rounded shadow" src="images/blood-donor (1).jpg" alt="Blood Groups Info" style="max-height: 380px; width: 100%; object-fit: cover; border-radius: 20px !important;">
            </div>
        </div>

        <!-- Call to Action Footer Section Banner -->
        <div class="cta-banner row align-items-center my-5 mx-0">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <h4 class="font-weight-bold text-white mb-2" style="font-size: 1.4rem; letter-spacing: 0.5px;">UNIVERSAL DONORS AND RECIPIENTS</h4>
                <p class="text-light mb-0" style="opacity: 0.9; font-size: 1rem; line-height: 1.6;">
                    The most common blood type is O, followed by type A. Type O individuals are often called "universal donors" since their blood can be transfused into persons with any blood type. Those with type AB blood are called "universal recipients" because they can receive blood of any type.
                </p>
            </div>
            <div class="col-lg-4 text-lg-right">
                <a class="btn btn-cta btn-lg" href="become-donar.php"><i class="fa fa-heart mr-2"></i>Become a Donor</a>
            </div>
        </div>

    </div>

    <!-- Footer Includes -->
    <?php include('includes/footer.php');?>

    <!-- Bootstrap Core JS dependencies -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>