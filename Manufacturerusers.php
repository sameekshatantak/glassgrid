<?php
// Starting the session
session_start();

// Including the file that establishes a connection to the database
include_once "dbconnect.php";

// Checking if the user is logged in as a distributor
if (!isset($_SESSION['user_id'])) {
    // Redirecting to login page if not logged in
    header("Location: login.php");
    exit;
}

// Retrieving DistributorID from session
$manufacturer_id = $_SESSION['user_id'];

// Function to end a session
function endSession()
{
    $_SESSION = array(); // Clearing session data
    session_destroy(); // Destroying session
}

// Checking if a manufacturer is selected for chatting
if (isset($_GET['DistributorID'])) {
    // Starting a new session for chatting
    session_start();

    // Storing the manufacturer ID in the session
    $_SESSION['DistributorID'] = $_GET['DistributorID'];

    // Redirecting to Distributorchat.php with the selected ManufacturerID
    header("Location: Manufacturerchat.php?ManufacturerID=" . $_GET['DistributorID']);
    exit;
}

// Getting the distributor's information based on distributor's ID
$manufacturer_sql = "SELECT * FROM manufacturer WHERE ManufacturerID = $manufacturer_id";
$manufacturer_result = $conn->query($manufacturer_sql);
$manufacturer_row = $manufacturer_result->fetch_assoc();
$manufacturer_company_name = $manufacturer_row['CompanyName'];

// Query to fetch manufacturers from the database
$distributor_sql = "SELECT * FROM Distributor";
$distributor_result = $conn->query($distributor_sql);
$output = ""; // Initializing variable to store HTML output

if ($distributor_result->num_rows > 0) {
    // Looping through each manufacturer
    while ($distributor_row = mysqli_fetch_assoc($distributor_result)) {
        // Constructing HTML markup for each manufacturer
        $output .= '<a href="?DistributorID=' . $distributor_row['DistributorID'] . '">
                        <div class="content">
                            <div class="details">
                                <span>' . $distributor_row['CompanyName'] . '</span>
                            </div>
                        </div>
                    </a>';
    }
} else {
    // If no manufacturers are available, display a message
    $output .= "No manufacturers are available";
}

// If chat is exited, end the session
if (isset($_GET['exit'])) {
   
    header("Location: Manufacturerprofile.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Realtime Chat App</title>
    <!-- Including CSS stylesheets -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>
<body>
<div class="wrapper">
    <section class="users">
        <header>
            <div class="content">
                <div class="details">
                    <!-- Displaying the manufacturers CompanyName -->
                    <span><?php echo $manufacturer_company_name; ?></span>
                </div>
            </div>
        </header>
        <div class="search">
            <!-- Providing instructions for selecting a distributor -->
            <span class="text">Select a distributor to chat</span>
        </div>

        <div class="users-list">
            <?php echo $output; ?>
        </div>
        <div>
            <!-- Button to exit chat -->
            <a href="?exit=true">Exit Chat</a>
        </div>
    </section>
</div>
</body>
</html>
