<?php
 include "dbconnect.php";
session_start();
// 
//$sql= "SELECT * FROM manufacturer where City='pune'";
//$result = mysqli_query($conn, $sql); 
//if(!$result){
 //   die("Invalid query");
//}
// Check if user is already logged in, redirect to profile page if so
if(isset($_SESSION['user_id'])) {
    header("Location: welcome.php");
    exit;
}

// Handle login form submission
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Retrieve input data
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];

    // SQL query to check user credentials
    $sql = "SELECT ManufacturerId FROM Manufacturer WHERE Email = '$Email' AND Password = '$Password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Set session variables
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['ManufacturerId'];
        // Redirect to profile page
        header("Location: welcome.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label>Username:</label>
            <input type="text" name="Email">
        </div>
        <div>
            <label>Password:</label>
            <input type="Password" name="Password">
        </div>
        <div>
            <input type="submit" value="Login">
        </div>
        <?php if(isset($error)) echo "<p>$error</p>"; ?>
    </form>
</body>
</html>
