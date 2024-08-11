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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
   
    <p>Email: <?php echo $user['Email']; ?></p>
    <!-- Display other user information as needed -->
    <a href="logout.php">Logout</a>
</body>
</html>
