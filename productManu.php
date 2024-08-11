
<?php
 include "dbconnect.php";
session_start();

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM Manufacturer WHERE ManufacturerId = $user_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
$conn->close();
?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Arsha Bootstrap Template - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Arsha
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

 	
  <section id="team" class="team section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Your Products:</h2>
        </div>

        

  <?php
  include "dbconnect.php";
  $sql= "SELECT * FROM Product where ManufacturerId=$user_id";
  $result = mysqli_query($conn, $sql); 
  if(!$result){
      die("Invalid query");
  }
  while($row = $result-> fetch_assoc())
{
  ?>
  <div class="row justify-content-center" >
    <div class="col-lg-6 mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="200">
    <div class="member d-flex align-items-start">
    
      <div class="member-info">
        <h4>Product:<?php echo $row["ProductName"]; ?></h4>
        <p>Price:<?php echo $row["Price"]; ?></p>
        <p>Min_Order Value:<?php echo $row["Min_Order_Value"]; ?></p>
        <p>Address and review</p>
        <div class="social">
          <a href=""><i class="ri-twitter-fill"></i></a>
          <a href=""><i class="ri-facebook-fill"></i></a>
          <a href=""><i class="ri-instagram-fill"></i></a>
          <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
        </div>
      </div>
      <button class="btn btn-primary" style="color: #fff;"><a href="delete.php?ProductID=<?php echo $row['ProductID']; ?>">Delete Product</a></button>
  </div>
  </div>
<?php    
}
?>


  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>