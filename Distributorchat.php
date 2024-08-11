<?php
// Start session
session_start();

// Include database connection
include_once "dbconnect.php";

// Check if ManufacturerID is set in session
if (!isset($_SESSION['ManufacturerID'])) {
    // Redirect to Distributoruser.php if ManufacturerID is not set
    header("Location: Distributoruser.php");
    exit;
}

// Fetch ManufacturerID from session
$manufacturer_id = $_SESSION['ManufacturerID'];

// Fetch manufacturer details from database
$sql = "SELECT * FROM manufacturer WHERE ManufacturerID = $manufacturer_id";
$result = $conn->query($sql);

// Check if manufacturer details are found
if ($result->num_rows > 0) {
    $manufacturer = $result->fetch_assoc();
} else {
    // Redirect to Distributoruser.php if manufacturer details are not found
    header("Location: Distributoruser.php");
    exit;
}

// Fetch all manufacturers for display on top of the chat box
$sql_all_manufacturers = "SELECT * FROM manufacturer";
$result_all_manufacturers = $conn->query($sql_all_manufacturers);
$manufacturers_list = "";
if ($result_all_manufacturers->num_rows > 0) {
    while ($row = $result_all_manufacturers->fetch_assoc()) {
        // Display manufacturer names
        $manufacturers_list .= '<span>' . $row['CompanyName'] . '</span>';
    }
} else {
    $manufacturers_list = "No manufacturers found.";
}

// Fetch messages for the current user (both sent and received)
$sql_fetch_messages = "SELECT * FROM messages WHERE (sender_id = $manufacturer_id OR receiver_id = $manufacturer_id) ORDER BY time ASC";
$result_messages = $conn->query($sql_fetch_messages);
$chat_messages = "";
if ($result_messages->num_rows > 0) {
    while ($row = $result_messages->fetch_assoc()) {
        // Construct message HTML
        $message_content = htmlspecialchars($row['message']);
        $sender_id = $row['sender_id'];
        $receiver_id = $row['receiver_id'];
        $message_class = ($sender_id == $manufacturer_id) ? 'outgoing' : 'incoming';
        $chat_messages .= "<div class='message $message_class'>$message_content</div>";
    }
}

// Handle message submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])) {
    // Get incoming message ID (Manufacturer ID)
    $incoming_id = $manufacturer_id;
    // Get outgoing message ID (Distributor ID)
    $outgoing_id = $_SESSION['user_id']; // Distributor ID from session

    // Get message from POST data
    $message = $_POST['message'];

    // Insert message into messages table
    $timestamp = date("Y-m-d H:i:s");
    $status = "sent";
    $sql_insert_message = "INSERT INTO messages (sender_id, receiver_id, message, time) VALUES ($outgoing_id, $incoming_id, '$message', '$timestamp')";
    if ($conn->query($sql_insert_message) === TRUE) {
        // Message inserted successfully, redirect to avoid form resubmission
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    } else {
        // Error inserting message
        echo "Error: " . $sql_insert_message . "<br>" . $conn->error;
    }
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
    <style>
        .message-container {
            display: flex;
            flex-direction: column;
        }

        .message {
            padding: 5px 10px;
            margin-bottom: 10px;
            border-radius: 10px;
            max-width: 70%;
            word-wrap: break-word;
        }

        .incoming {
            align-self: flex-end;
           
            background-color: #DCF8C6;
        }

        .outgoing {
            align-self: flex-start;
            background-color: #E3E3E3;
            
        }
    </style>
</head>
<body>
<div class="wrapper">
    <section class="chat-area">
        <header>
            <!-- Display the selected manufacturer's details -->
            <div class="details">
                <span><?php echo $manufacturer['CompanyName']; ?></span>
            </div>
        </header>
        <div class="chat-box">
            <!-- Display messages here -->
            <div id="messageContainer" class="message-container">
                <?php echo $chat_messages; ?>
            </div>
        </div>
        <!-- Form for typing and sending messages -->
        <form id="messageForm" method="post" class="typing-area">
            <!-- Hidden input field to store the selected manufacturer's ID -->
            <input type="hidden" name="incoming_id" value="<?php echo $manufacturer_id; ?>">
            <!-- Input field for typing messages -->
            <input id="messageInput" type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
            <!-- Button to send messages -->
            <button id="sendMessageButton" type="button"><i class="fab fa-telegram-plane"></i></button>
        </form>
    </section>
</div>

<!-- Including JavaScript file for chat functionality -->
<script src="javascript/chat.js"></script>

<!-- JavaScript to handle message submission and real-time update -->
<script>
    // Function to fetch new messages from the server
    function fetchMessages() {
        // Send AJAX request to fetch new messages
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "fetch_messages.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Append new messages to the chat box
                document.getElementById("messageContainer").innerHTML += xhr.responseText;
            }
        };
        xhr.send();
    }

    // Fetch new messages every 5 seconds
    setInterval(fetchMessages, 5000);

    // Submit message when send button is clicked
    document.getElementById("sendMessageButton").addEventListener("click", function() {
        document.getElementById("messageForm").submit();
    });
</script>

</body>
</html>
