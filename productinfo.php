<?php 
include "dbconnect.php";
session_start();

$user_id = $_SESSION['user_id'];

$showAlert = false;  
$showError = false;  
$exists = false; 
    
if($_SERVER["REQUEST_METHOD"] == "POST") { 
    // Sanitize user inputs
    $ProductName = mysqli_real_escape_string($conn, $_POST['ProductName']);
    $Price = mysqli_real_escape_string($conn, $_POST['Price']);
    $options = mysqli_real_escape_string($conn, $_POST['options']);
    $Min_Order_Value = mysqli_real_escape_string($conn, $_POST['Min_Order_Value']);

    // Convert option to lowercase for consistency
   

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO `product` (ManufacturerID, ProductName, Category, Price, Min_Order_Value) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $user_id, $ProductName, $options, $Price, $Min_Order_Value);

    // Execute the statement
    if ($stmt->execute()) {
        $showAlert = true;
    } else {
        $showError = true;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>product info page</title>
       
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Job Finding</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- owl stylesheets --> 
      <link rel="stylesheet" href="css/owl.carousel.min.css">
      <link rel="stylesheet" href="css/owl.theme.default.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

      
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   <!-- body -->
    </head>
     <!-- body -->
   <style>
 
 body {
          background-image: url('images/bgposter.jpg'); /* Adjust the path */
    background-repeat: repeat; /* Repeat the background image */
    font-family: Arial, sans-serif;

        }
        .container {
    max-width: 800px;
    margin: auto;
    padding: 20px;
    /* Remove background-color to avoid covering the background image */
    /* background-color: #fff; */
    border-radius: 5px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}
.navbar-nav {
    margin-left: auto; /* Align items to the right */
}
.navbar-nav .nav-item {
    margin-left: 10px; /* Adjust margin as needed */
}
        
    </style>
<script>
    // Function to update active link in navigation
    function updateActiveLink() {
        const sections = document.querySelectorAll('section');
        const navLinks = document.querySelectorAll('.navbar-nav a.nav-link');

        sections.forEach((section, index) => {
            const top = section.offsetTop;
            const height = section.offsetHeight;

            if (window.scrollY >= top && window.scrollY < top + height) {
                // Remove active class from all links
                navLinks.forEach(link => link.classList.remove('active'));
                // Add active class to the corresponding link
                navLinks[index].classList.add('active');
            }
        });
    }

    // Event listener for scrolling
    window.addEventListener('scroll', updateActiveLink);

    // Call the function on page load to set the initial active link
    window.addEventListener('load', updateActiveLink);
</script>
   <!-- body -->
   <body>
    
	<!-- header section start -->
 <!-- Header section start -->
 <div class="header_section">
        <div class="container-fluid">
            <div class="row">
                <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                    <div class="container-fluid">
                        <!-- Brand/logo -->
                        <a class="navbar-brand logo-font" href="#"><img src="images/logo.png" height="90" width="90"></a>
                        <!-- Main navigation links -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item <?php echo ($activePage == 'home') ? 'active' : ''; ?>">
                                <a class="nav-link" href="http://localhost/glassgrid/job-finding/index.php#home"><b>Home</b></a>
                            </li>
                            <li class="nav-item <?php echo ($activePage == 'products') ? 'active' : ''; ?>">
                                <a class="nav-link" href="http://localhost/glassgrid/job-finding/index.php#products"><b>Products</b></a>
                            </li>
                            <li class="nav-item <?php echo ($activePage == 'manufacturers') ? 'active' : ''; ?>">
                                <a class="nav-link" href="http://localhost/glassgrid/job-finding/index.php#manufacturers"><b>Manufacturers</b></a>
                            </li>
                            <li class="nav-item <?php echo ($activePage == 'distributors') ? 'active' : ''; ?>">
                                <a class="nav-link" href="http://localhost/glassgrid/job-finding/index.php#distributors"><b>Distributors</b></a>
                            </li>
                        </ul>
                        <!-- Register link -->
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="http://localhost/glassgrid/job-finding/signup.php"><b>Register</b></a>
                            </li>
                        </ul>
                        <!-- Profile link -->
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="http://localhost/glassgrid/job-finding/login.php"><b>Login</b></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
      <!-- Load icon library -->
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
    
    <body>
        
 
                <div class="row justify-content-center h-100">
    <div class="card w-50 my-auto shadow">
        <div class="card-header text-center bg-primary text-white">
            <h1>Enter Product information:</h1>
        </div>
        <div class="card-body">
            <?php if ($showAlert) : ?>
                <div class="alert alert-success" role="alert">
                    Product added successfully!
                </div>
            <?php endif; ?>
            <form action="productinfo.php" method="post">
                <div class="form-group">
                    <label for="options">Options:</label>
                    <select id="options" name="options">
                        <option value="By Usage">By Usage</option>
                        <option value="By Industrial Application">By Industrial Application</option>
                        <option value="By Material Composition">By Material Composition</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="ProductName">Product Name:</label>
                    <input type="text" id="ProductName" name="ProductName">
                </div>
                <div class="form-group">
                    <label for="Price">Price:</label>
                    <input type="text" id="Price" name="Price" required>
                </div>
                <div class="form-group">
                    <label for="Min_Order_Value">Minimum Order Value:</label>
                    <input type="text" id="Min_Order_Value" name="Min_Order_Value">
                </div>
                <div>
                    <br>
                    <input type="submit" class="btm btm-primary w-100 bg-primary text-black" value="ADD PRODUCT" name="">
                </div>
            </form>
        </div>
    </div>
</div>
                   
      
        

    </body>
 