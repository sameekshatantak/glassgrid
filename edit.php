<?php
session_start();

// Include database connection
require_once "dbconnect.php"; // Make sure to define $mysqli variable for database connection

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $CompanyName = $_POST['CompanyName'];
    $City = $_POST['City'];
    $ContactNo = $_POST['ContactNo'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $user_id = $_SESSION['user_id']; // Assuming user_id is stored in the session

    // Prepare SQL statement to update user info
    $sql = "UPDATE manufacturer SET CompanyName='$CompanyName', City='$City', ContactNo='$ContactNo', Password='$Password' WHERE ManufacturerID = '$user_id'";


    if ($result = $conn->query($sql)) {
      // Set success message
      $_SESSION['success_message'] = "Details updated successfully.";
      // Redirect to profile page
      header("Location: profile.php");
      exit;
  } else {
      // Set error message
      $_SESSION['error_message'] = "Oops! Something went wrong. Please try again later.";
      // Redirect back to edit page
      header("Location: edit.php");
      exit;
  }}

// Retrieve existing user information
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM manufacturer WHERE ManufacturerID = '$user_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $existingCompanyName = $row['CompanyName'];
    $existingCity = $row['City'];
    $existingContactNo = $row['ContactNo'];
    $existingEmail = $row['Email'];
} else {
    echo "Error: User not found.";
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit</title>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

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
    <body>
        <!-- header section start -->
	<div class="header_section">
		<div class="container-fluid">
			<div class="row">
			    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
                    <div class="container-fluid">
                        <a class="navbar-brand logo-font" href="#"><img src="images/logo.png" height="90" width="90"></a>
    <!-- links toggle -->
                        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#links" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fa fa-bars"></i>
                        </button>
    <!-- account toggle --> 
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#account" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fa fa-user"></i>
                        </button>
                    <div class="collapse navbar-collapse" id="links">
                        <ul class="navbar-nav mr-auto">
                        	<li class="nav-item ">
                              <a class="nav-link" href="http://localhost/job-finding/index.php"><b>Home</b></a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link"  href="http://localhost/glassgrid/job-finding/view.php"><b>Products</b></a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="http://localhost/glassgrid/job-finding/manu.php" ><b>Manufacturers</b></a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="http://localhost/glassgrid/job-finding/dist.php"><b>Distributors</b></a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="#"></a>
                            </li>
                            <li class="nav-item active">
                              <a class="color" href="http://localhost/glassgrid/job-finding/signup.php"><span class="icon"><img src="images/register-icon.png" height="20" width="20" ></span><b>Register</b></a>
                            </li>
                            <li class="nav-item">
                              <a class="color" href="http://localhost/glassgrid/job-finding/login.php"><span class="icon"><img src="images/user-icon.png" height="15" width="15"></span><b>Log in</b></a>
                            </li>
                        </ul>
                    </div>
                    <div class="collapse navbar-collapse" id="account">
                        <ul class="navbar-nav ml-auto social_icon">
                          <li class="nav-item">
                            <a class="nav-link" href="#"><img src="images/fb-icon.png"></a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#"><img src="images/twitter-icon.png"></a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#"><img src="images/instagram-icon.png"></a>
                          </li>
                        </ul>
                    </div>
                </div>
            </nav>
			</div>
      <!-- Load icon library -->


    
    <div class="container vh-100">
        <div class="row justify-content-center h-100">
            <div class="card w-50 my-auto shadow">
                <div class="card-header text-center bg-primary text-white">
                    <h1> Edit    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br></h1>
                </div>
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label for="CompanyName">Company Name:</label>
                            <input type="text" id="CompanyName" name="CompanyName" value="<?php echo $existingCompanyName; ?>">
                        </div>
                        <div class="form-group">
                            <label for="City">City:</label>
                            <input type="text" id="City" name="City" required value="<?php echo $existingCity; ?>">
                        </div>
                        <div class="form-group">
                            <label for="ContactNo">Contact Number:</label>
                            <input type="text" id="ContactNo" name="ContactNo" value="<?php echo $existingContactNo; ?>">
                        </div>
                        <div class="form-group">
                            <label for="Email">Email Address:</label>
                            <input type="email" id="Email" class="form-control" name="Email" value="<?php echo $existingEmail; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="Password">Password:</label>
                            <input type="password" id="Password" class="form-control" name="Password" required>
                        </div>
                        <div>
                            <br>
                            <input type="submit" class="btm btm-primary w-100 bg-primary text-black" value="Update" name="">
                        </div>
                    </form>
                    <br>
 
                </div>
            </div>
        </div>
      
    </div>
 
</body>
</html>
 
 