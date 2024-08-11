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
    $Password = $_POST['Password'];
    $user_id = $_SESSION['user_id']; // Assuming user_id is stored in the session

    // Prepare SQL statement to update user info
    $sql = "UPDATE distributor SET CompanyName='$CompanyName', City='$City', ContactNo='$ContactNo', Password='$Password' WHERE DistributorID = '$user_id'";

    if ($result = $conn->query($sql)) {
        // Redirect to profile page or display success message
        header("Location: Distributorprofile.php");
        exit;
    } else {
        // Display error message
        echo "Oops! Something went wrong. Please try again later.";
    }
}

// Retrieve existing user information
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM distributor WHERE DistributorID = '$user_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $existingCompanyName = $row['CompanyName'];
    $existingCity = $row['City'];
    $existingContactNo = $row['ContactNo'];
    $existingEmail = $row['Email']; // You can also retrieve email if you want to display it
} else {
    echo "Error: User not found.";
    exit;
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>login page</title>
       
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
      <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
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
}

.category_section {
     /* Change this to transparent if you want */
    padding: 50px 0; /* Adjust padding as needed */
}

.category_section_2 {
     /* Change this to transparent if you want */
    padding: 50px 0; /* Adjust padding as needed */
}

.faq-item {
  max-width: 800px;
  margin: auto;
  margin-bottom: 19px;
    border-radius: 10px;
    overflow: hidden;
    /* Remove background-color to avoid covering the background image */
    /* background-color: #92D9D3; */
}
        .faq-question, .faq-answer {
        
            padding: 10px;
            margin: 0;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .faq-question {
            background-color: #92D9D3;
            color: #fff;
            font-weight: bold;
            font-family: Arial, sans-serif;
        }
        .faq-answer {
            display: none;
            background-color: #92D9D3;
            color: #fff;
            font-family: Arial, sans-serif;
        }
        .faq-item.active .faq-question {
            background-color: #48CBC0 ;
        }
        .faq-item.active .faq-answer {
            display: block;
        }
        
    .banner_taital {
      font-size: 3vw; /* Increase the font size */
         font-weight: bold; /* Make the text bold */
         text-align: center; /* Center align the text */
         margin-top: 12%; /* Adjust the margin from the top */
         position: absolute; /* Position absolutely */
         top: 50%; /* Align to the middle vertically */
         left: 50%; /* Align to the middle horizontally */
         transform: translate(-50%, -50%); /* Center the element */
    }
/* CSS for search bar */
.form-group {
    margin-bottom: 20px;
    position: relative;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

#search_query {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

button[type="submit"] {
    position: absolute;
    top: 0;
    right: 0;
    padding: 9px 15px;
    background-color: #48CBC0;
    color: #fff;
    border: none;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #2CA786;
}
.navbar-nav li.nav-item.active a.color {
    color: blue; /* Change the color to blue */
}
.navbar-nav li.nav-item.active a.color {
            color: blue; /* Change the color to blue */
        }
          /* Add CSS for the fixed header */
          .header_section {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            background-color: #fff;
            padding: 10px 0; /* Adjust padding as needed */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Add shadow for visual separation */
        }
        .navbar-nav .nav-item.active a {
            border-bottom: 2px solid blue; /* Add underline to active link */
        }
        .navbar-nav {
    margin-left: auto; /* Align items to the right */
}
.navbar-nav .nav-item {
    margin-left: 10px; /* Adjust margin as needed */
}
        
    </style>
   <!-- body -->
    
    <body>
        <head>
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
                              <a class="nav-link" href="http://localhost/glassgrid/job-finding/index.php"><b>Home</b></a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link"  href="http://localhost/glassgrid/job-finding/index.php#products"><b>Products</b></a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="http://localhost/glassgrid/job-finding/index.php#manufacturers" ><b>Manufacturers</b></a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="http://localhost/glassgrid/job-finding/index.php#distributors"><b>Distributors</b></a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="#"></a>
                            </li>
                            <li class="nav-item ">
                              <a class="color" href="http://localhost/glassgrid/job-finding/signup.php"><span class="icon"><img src="images/register-icon.png" height="20" width="20" ></span><b>Register</b></a>
                            </li>
                            <li class="nav-item ">
                              <a class="color" href="http://localhost/glassgrid/job-finding/login.php"><span class="icon"><img src="images/user-icon.png" height="15" width="15"></span><b>Log in</b></a>
                            </li>
                        </ul>
                    </div>
  
                </div>
            </nav>
			</div>
</div>
</div>
</div>
      <!-- Load icon library -->
</head>
<br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>   
        
   
    
        <div class="row justify-content-center h-100">
            <div class="card w-50 my-auto shadow">
                <div class="card-header text-center bg-primary text-white">
                    <h1> Edit </h1>
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
                            <input type="email" id="Email" class="form-control" name="Email" value="<?php echo $existingEmail; ?>" readonly>
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
                </div>
            </div>
    
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</body>
    </html>
    
