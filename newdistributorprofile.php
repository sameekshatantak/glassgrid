<?php
 include "dbconnect.php";
session_start();
// Redirect to login page if user is not logged in
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
     exit;
}
// Retrieve user information from database
$_SESSION["loggedin"]=true;
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM Distributor WHERE Distributor_id = $user_id";
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
   </style>
   <body>
      <!-- header section start -->
      <div class="header_section">
         <div class="container-fluid">
            <div class="row">
               <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
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
            <div class="container">
               <div class="main-body">
                  <div class="row gutters-sm">
                     <div class="col-md-4 mb-3">
                        <div class="card">
                           <div class="card-body">
                              <div class="d-flex flex-column align-items-center text-center">
                                 <div class="mt-3">
                                    <h4><?php echo $user['CompanyName']; ?></h4>
                                    <p class="text-secondary mb-1">Distributor</p>
                                    <p class="text-muted font-size-sm"><?php echo $user['City']; ?></p>
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
                                    <a class="btn btn-info " target="__blank" href="Distributoredit.php">Edit</a>
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
               <br>
               <br>
               <br>
               <br>
               <br>
            </div>
            <!-- add buttons -->
            <div class="container">
               <div class="main-body">
                  <!-- buttons -->
                  <div class="row">
                     <div class="col-sm-12">
                     <a href="order_history.php" class="btn btn-info">Order History</a>
                  <a href="place_order.php" class="btn btn-success">Place Order</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
      </div>
      </div>
      </div>
      </nav>
      </div>
      </div>
      </div>
      </div>
      </div>
   </body>
</html>
