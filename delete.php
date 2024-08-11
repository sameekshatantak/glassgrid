<?php
 include "dbconnect.php";
 if(isset($_GET['ProductID'])) {
    $ProductID = $_GET['ProductID'];
 }
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}// Check if the trigger already exists
$check_trigger_sql = "SELECT * FROM information_schema.triggers WHERE trigger_schema = '$database' AND trigger_name = 'delete_product_trigger'";
$result = $conn->query($check_trigger_sql);

if ($result && $result->num_rows > 0) {
 /*   echo "Trigger already exists.<br>";*/
} else {
    // SQL to create the trigger
    $create_trigger_sql = "
        CREATE TRIGGER delete_product_trigger
        AFTER DELETE ON product
        FOR EACH ROW
        BEGIN
            -- Insert the deleted row into another table
            INSERT INTO deleted_products (ProductID, ManufacturerID, ProductName, Category, Price, Min_Order_Value)
            VALUES (OLD.ProductID, OLD.ManufacturerID, OLD.ProductName, OLD.Category, OLD.Price, OLD.Min_Order_Value);
        END
    ";

    // Execute the trigger creation SQL
   /* if ($conn->query($create_trigger_sql) === TRUE) {
        echo "Trigger created successfully.<br>";
    } else {
        echo "Error creating trigger: " . $conn->error . "<br>";
    }*/
}



// SQL to delete the product
$delete_product_sql = "DELETE FROM product WHERE ProductID = $ProductID";

// Execute the delete query
if ($conn->query($delete_product_sql) === TRUE) {
   /* echo "Product deleted successfully.<br>";*/
} else {
    echo "Error deleting product: " . $conn->error . "<br>";
}

// Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
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
   </head>
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
                                <a class="nav-link" href="http://localhost/glassgrid/job-finding/login.php"><b>Profile</b></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- header section end -->
   <!-- body -->
   <body>
	<!-- header section start -->
	
	<!-- banner section start -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Industrial Application</title>
    <style>
       body {
          background-image: url('images/bgposter.jpg'); /* Adjust the path */
    background-repeat: repeat; /* Repeat the background image */
    font-family: Arial, sans-serif;

        }
      </style>

<body>
<br><br><br>
<br><br><br>
<br><br><br>
<section id="team" class="team section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Product Deleted Successfully</h2>
        </div>
  <div class="row justify-content-center" >
    <div class="col-lg-6 mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="200">
    
   
      
     
      <button class="btn btn-primary" style="color: #fff;"><a href="http://localhost/glassgrid/job-finding/Manufacturerprofile.php">Close</a></button>
        
</div>
  </div>
  </div>
        
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
            <!--.row-->
 
    <!-- job category section end -->
    <!--<div class="container">
        <div class="box" style="background-image: url('https://th.bing.com/th/id/OIP.1KGqqH3F7le9RbHQpKgWGAHaEK?w=312&h=180&c=7&r=0&o=5&dpr=1.1&pid=1.7')"><a href="http://localhost/glassgrid/job-finding/productbyusage.php"><b>By Usage</b></a></div>
        <div class="box" style="background-image: url('https://images.app.goo.gl/xCnEY4m1uwjjQv3t9')"><a href="http://localhost/glassgrid/job-finding/productbyindustrialapp.php"><b>By Industrial Application</b></a></div>
        <div class="box" style="background-image: url('https://images.app.goo.gl/1TQwR8XJikPEFCKL7')"><a href="http://localhost/glassgrid/job-finding/productbymaterialcomp.php"><b>By Material Composition</b></a></div>
    </div>-->

   

</body>
</html>