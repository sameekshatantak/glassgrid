
<?php
 include "dbconnect.php";
session_start();
// Redirect to login page if user is not logged in
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
// Retrieve user information from database
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM Manufacturer WHERE ManufacturerId = $user_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
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
   <!-- body -->
   <style>
  body{
    margin-top:20px;
    color: #1a202c;
    text-align: left;
    background-color: #e2e8f0;    
}
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
                            <a class="nav-link" href="http://localhost/glassgrid/job-finding/login.php"><b>Profile</b></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>
      <!-- Load icon library -->

  <div class="container">

    <div class="main-body">
    
    
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                  
                    <div class="mt-3">
                      <h4><?php echo $user['CompanyName']; ?></h4>
                      <p class="text-secondary mb-1">Manufacturer</p>
                      <p class="text-muted font-size-sm"><?php echo $user['City']; ?></p>
                      <button class="btn btn-outline-primary">Add Product</button>
                      <button class="btn btn-outline-primary">Message</button>
                    </div>
                  </div>
                </div>
              </div>
            
            </div>
            
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Company Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $user['CompanyName']; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $user['Email']; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $user['ContactNo']; ?>
                    </div>
                  </div>
                
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $user['City']; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                    <a class="btn btn-info " target="__blank" href="edit.php">Edit</a>
                      <a class="btn btn-info " target="__blank" href="logout.php">Logout</a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row gutters-sm">
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">assignment</i>Project Status</h6>
                      <small>Web Design</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Website Markup</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>One Page</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Mobile Template</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Backend API</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
     
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">assignment</i>Project Status</h6>
                      <small>Web Design</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Website Markup</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>One Page</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Mobile Template</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small>Backend API</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>



            </div>
          </div>

        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
</body>
</html>