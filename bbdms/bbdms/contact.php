<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(isset($_POST['send'])) {
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];
    $message = $_POST['message'];
    
    $sql = "INSERT INTO tblcontactusquery(name,EmailId,ContactNumber,Message) VALUES(:name,:email,:contactno,:message)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':contactno', $contactno, PDO::PARAM_STR);
    $query->bindParam(':message', $message, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    
    if($lastInsertId) {
        $msg = "Query Sent successfully. We will contact you shortly.";
    } else {
        $error = "Something went wrong. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Contact BloodBank & Donor Hub">
    <title>BloodBank & Donor Management System | Contact Us</title>
    
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/modern-business.css" rel="stylesheet">

    <style>
        body {
            background-color: #f6f8fa;
            color: #2d3748;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        .navbar-toggler {
            z-index: 1;
        }
        
        @media (max-width: 576px) {
            nav > .container {
                width: 100%;
            }
        }

        /* Notifications Formatting */
        .errorWrap {
            padding: 14px 20px;
            margin-bottom: 25px;
            background: #ffffff;
            border-left: 4px solid #e53e3e;
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(229, 62, 62, 0.06);
            font-weight: 500;
        }

        .succWrap {
            padding: 14px 20px;
            margin-bottom: 25px;
            background: #ffffff;
            border-left: 4px solid #38a169;
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(56, 161, 105, 0.06);
            font-weight: 500;
        }

        /* Glassmorphic Contact Card Wrapper */
        .contact-form-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.03);
            padding: 35px;
            border: 1px solid #e2e8f0;
            margin-bottom: 40px;
        }

        .sidebar-info-card {
            background: linear-gradient(145deg, #1a1d20 0%, #2d3238 100%);
            color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            padding: 35px;
            border: none;
            margin-bottom: 40px;
        }

        .form-section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 25px;
            position: relative;
        }

        .sidebar-section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 12px;
        }

        /* Clean Label & Inputs styling */
        .input-attribute-label {
            font-size: 0.85rem;
            font-weight: 700;
            color: #4a5568;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.6px;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #cbd5e0;
            padding: 12px 18px;
            background-color: #f7fafc;
            color: #2d3748;
            transition: all 0.2s ease-in-out;
        }

        .form-control:focus {
            background-color: #ffffff;
            border-color: #e53e3e;
            box-shadow: 0 0 0 4px rgba(229, 62, 62, 0.12);
        }

        .btn-send-message {
            background: linear-gradient(135deg, #e53e3e 0%, #c53030 100%);
            border: none;
            color: #ffffff;
            padding: 14px 30px;
            font-weight: 600;
            border-radius: 10px;
            letter-spacing: 0.5px;
            transition: all 0.25s ease;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(229, 62, 62, 0.15);
        }

        .btn-send-message:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(229, 62, 62, 0.3);
            color: #ffffff;
        }

        /* Sidebar Info Lists Elements */
        .contact-meta-row {
            display: flex;
            align-items: flex-start;
            margin-bottom: 22px;
        }

        .contact-meta-icon {
            font-size: 1.2rem;
            color: #e53e3e;
            width: 35px;
            margin-top: 3px;
        }

        .contact-meta-value {
            flex: 1;
            font-size: 1rem;
            color: #e2e8f0;
            line-height: 1.6;
        }

        .contact-meta-value a {
            color: #e2e8f0;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .contact-meta-value a:hover {
            color: #ffffff;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <?php include('includes/header.php');?>

    <div class="container mt-4">

        <h1 class="mt-4 mb-2 font-weight-bold">Get In Touch <small class="text-muted font-weight-normal">Contact Hub</small></h1>

        <ol class="breadcrumb mb-4 bg-transparent p-0">
            <li class="breadcrumb-item"><a href="index.php" class="text-danger text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active text-muted">Contact</li>
        </ol>

        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="contact-form-card">
                    <h3 class="form-section-title"><i class="fa fa-paper-plane text-danger mr-2"></i>Send us a Message</h3>
                    
                    <?php if($error){ ?>
                        <div class="errorWrap"><i class="fa fa-exclamation-triangle mr-2"></i><strong>Alert:</strong> <?php echo htmlentities($error); ?> </div>
                    <?php } else if($msg){ ?>
                        <div class="succWrap"><i class="fa fa-check-circle mr-2"></i><strong>Success:</strong> <?php echo htmlentities($msg); ?> </div>
                    <?php } ?>

                    <form name="sentMessage" method="post">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="input-attribute-label">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="fullname" required placeholder="John Doe">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="input-attribute-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="contactno" required placeholder="e.g. +1 555-0199">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="input-attribute-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required placeholder="name@example.com">
                        </div>

                        <div class="form-group mb-4">
                            <label class="input-attribute-label">Your Message</label>
                            <textarea rows="6" class="form-control" id="message" name="message" required placeholder="Type your dynamic support query or requirement specifics here..." maxlength="999" style="resize:none"></textarea>
                        </div>

                        <button type="submit" name="send" class="btn btn-send-message">
                            <i class="fa fa-paper-plane mr-2"></i>Submit Request
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="sidebar-info-card">
                    <h3 class="sidebar-section-title"><i class="fa fa-building-o mr-2"></i>Office Details</h3>
                    
                    <?php 
                    $sql = "SELECT Address,EmailId,ContactNo from tblcontactusinfo";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    
                    if($query->rowCount() > 0) {
                        foreach($results as $result) { ?>
                            <div class="contact-meta-row">
                                <div class="contact-meta-icon"><i class="fa fa-map-marker"></i></div>
                                <div class="contact-meta-value">
                                    <strong>HQ Address:</strong><br>
                                    <?php echo htmlentities($result->Address); ?>
                                </div>
                            </div>

                            <div class="contact-meta-row">
                                <div class="contact-meta-icon"><i class="fa fa-phone"></i></div>
                                <div class="contact-meta-value">
                                    <strong>Call Helpline:</strong><br>
                                    <?php echo htmlentities($result->ContactNo); ?>
                                </div>
                            </div>

                            <div class="contact-meta-row">
                                <div class="contact-meta-icon"><i class="fa fa-envelope-o"></i></div>
                                <div class="contact-meta-value">
                                    <strong>Email Support:</strong><br>
                                    <a href="mailto:<?php echo htmlentities($result->EmailId); ?>">
                                        <?php echo htmlentities($result->EmailId); ?>
                                    </a>
                                </div>
                            </div>
                        <?php }
                    } ?>
                </div>
            </div>
        </div>

    </div>

    <?php include('includes/footer.php');?>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>