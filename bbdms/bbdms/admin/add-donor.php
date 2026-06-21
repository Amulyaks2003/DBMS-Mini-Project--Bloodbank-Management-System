<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['alogin'])==0) {   
    header('location:index.php');
    exit;
} else { 

    if(isset($_POST['submit'])) {
        $fullname = trim($_POST['fullname']);
        $mobile   = trim($_POST['mobileno']);
        $email    = filter_var(trim($_POST['emailid']), FILTER_SANITIZE_EMAIL);
        $age      = trim($_POST['age']);
        $gender   = trim($_POST['gender']);
        $bloodgroup = trim($_POST['bloodgroup']);
        $address  = trim($_POST['address']);
        $message  = trim($_POST['message']);
        $status   = 1;

        $sql = "INSERT INTO tblblooddonars(FullName, MobileNumber, EmailId, Age, Gender, BloodGroup, Address, Message, status) 
                VALUES(:fullname, :mobile, :email, :age, :gender, :bloodgroup, :address, :message, :status)";
        
        $query = $dbh->prepare($sql);
        $query->bindParam(':fullname', $fullname, PDO::PARAM_STR);
        $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':age', $age, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':bloodgroup', $bloodgroup, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':message', $message, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_INT);
        
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        
        if($lastInsertId) {
            $msg = "Donor profile added successfully!";
        } else {
            $error = "Something went wrong. Please check your data and try again.";
        }
    }
?>
<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>BBDMS | Admin Add Donor</title>

    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    
    <style>
        /* Smooth transitions for form interactive fields */
        input, select, textarea {
            transition: all 0.2s ease-in-out;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #ef4444 !important; 
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15) !important;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans antialiased text-gray-800">
    <?php include('includes/header.php');?>
    
    <div class="ts-main-content">
        <?php include('includes/leftbar.php');?>
        
        <div class="content-wrapper min-h-screen pt-6 pb-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto space-y-6">
                
                <div class="flex items-center justify-between border-b border-gray-200 pb-4">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Add New Donor</h2>
                        <p class="text-sm text-gray-500 mt-1">Register a new donor profile to the system panel manually.</p>
                    </div>
                </div>

                <?php if(isset($error) && $error){ ?>
                    <div class="flex items-center p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-md shadow-sm text-base">
                        <i class="fa fa-exclamation-circle mr-3 text-lg"></i>
                        <span class="font-medium">Error: <?php echo htmlentities($error); ?></span>
                    </div>
                <?php } else if(isset($msg) && $msg){ ?>
                    <div class="flex items-center p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded-r-md shadow-sm text-base">
                        <i class="fa fa-check-circle mr-3 text-lg"></i>
                        <span class="font-medium">Success: <?php echo htmlentities($msg); ?></span>
                    </div>
                <?php } ?>

                <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r r-theme-gradient from-red-600 to-red-500 px-6 py-4">
                        <h3 class="text-xl font-semibold text-white flex items-center">
                            <i class="fa fa-user-plus mr-2.5"></i> Donor Personal Information
                        </h3>
                    </div>

                    <form method="post" class="p-6 sm:p-8 space-y-6" enctype="multipart/form-data">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-base font-bold text-gray-700 mb-2">Full Name <span class="text-red-500">*</span></label>
                                <input type="text" name="fullname" placeholder="John Doe" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg text-md placeholder-gray-400 focus:bg-white" required>
                            </div>
                            
                            <div>
                                <label class="block text-base font-bold text-gray-700 mb-2">Mobile Number <span class="text-red-500">*</span></label>
                                <input type="text" name="mobileno" pattern="\d{10}" title="Please enter a valid 10-digit mobile number" maxlength="10" placeholder="e.g. 9876543210" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg text-md placeholder-gray-400 focus:bg-white" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-base font-bold text-gray-700 mb-2">Email Address</label>
                                <input type="email" name="emailid" placeholder="johndoe@example.com" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg text-md placeholder-gray-400 focus:bg-white">
                            </div>
                            
                            <div>
                                <label class="block text-base font-bold text-gray-700 mb-2">Age <span class="text-red-500">*</span></label>
                                <input type="number" name="age" min="18" max="100" placeholder="Minimum age is 18" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg text-md placeholder-gray-400 focus:bg-white" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-base font-bold text-gray-700 mb-2">Gender <span class="text-red-500">*</span></label>
                                <select name="gender" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg text-md text-gray-700 focus:bg-white appearance-none" required>
                                    <option value="" class="text-gray-400">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-base font-bold text-gray-700 mb-2">Blood Group <span class="text-red-500">*</span></label>
                                <select name="bloodgroup" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg text-md text-gray-700 focus:bg-white appearance-none" required>
                                    <option value="" class="text-gray-400">Select Blood Group</option>
                                    <?php 
                                    $sql = "SELECT * from tblbloodgroup";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    if($query->rowCount() > 0) {
                                        foreach($results as $result) { ?>  
                                            <option value="<?php echo htmlentities($result->BloodGroup);?>"><?php echo htmlentities($result->BloodGroup);?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-base font-bold text-gray-700 mb-2">Residential Address</label>
                            <textarea class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg text-md placeholder-gray-400 h-28 resize-none focus:bg-white" name="address" placeholder="Enter residential street address lines..."></textarea>
                        </div>

                        <div>
                            <label class="block text-base font-bold text-gray-700 mb-2">Message / Note <span class="text-red-500">*</span></label>
                            <textarea class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg text-md placeholder-gray-400 h-28 resize-none focus:bg-white" name="message" placeholder="Add additional conditions, clinical history or administrative notes..." required></textarea>
                        </div>

                        <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100">
                            <button type="reset" class="px-6 py-3 text-base font-medium text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 active:bg-gray-100 transition shadow-sm">
                                Clear Changes
                            </button>
                            <button type="submit" name="submit" class="px-7 py-3 text-base font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 active:bg-red-800 transition shadow-sm flex items-center">
                                <i class="fa fa-save mr-2"></i> Register Donor
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
<?php } ?>