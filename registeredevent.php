<?php
// Start the session at the beginning of the script
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventuser";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure UserID is set in session
if (!isset($_SESSION['UserID'])) {
    die("User not logged in.");
}

$UserID = $_SESSION['UserID'];

// SQL query to fetch events the logged-in user has registered for
$sql = "SELECT event.*, proposal.*, proposal.Scorun FROM event 
        JOIN proposal ON event.eventID = proposal.proposalID 
        WHERE event.UserID = '$UserID'";
$result = $conn->query($sql);

// Calculate total Scorun and count events
$totalScorun = 0;
$totalEvents = 0;
$events = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $totalScorun += $row["Scorun"];
        $totalEvents++;
        $events[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The National Energy University</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            background: url('uniten.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .header {
            background-color: #300843;
            color: white;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-content {
            display: flex;
            align-items: center;
        }
        .header img {
            height: 100px;
            margin-right: 20px;
        }
        .nav-items {
            display: flex;
            align-items: center;
            margin-left: auto;
        }
        .nav-item {
            margin-right: 10px;
        }
        .button {
            background-color: transparent;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
        }
        .button a {
            text-decoration: none;
            color: white;
        }
        .button:hover {
            color: #ccc;
        }
        .logout-button {
            background-color: #ff3465;
            color: white;
        }
        .logout-button:hover {
            background-color: #ff3465;
        }
        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            text-align: center;
        }
        .info-boxes {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            gap: 20px;
        }
        .info-box {
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            font-size: 1.5rem;
        }
        .event-box {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px 0;
            max-width: 600px;
            text-align: left;
        }
        .event-image img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .event-title {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        .event-description-text {
            line-height: 1.5;
            margin-bottom: 10px;
        }
        .feedback-button {
            background-color: #ff6357;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        .feedback-button:hover {
            background-color: #ff7b70;
        }
        .popup {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .popup-content {
            background-color: white;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            text-align: left;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
<header class="header">
        <div class="header-content">
            <img src="unitenlogo.png" alt="UNIVERSITI TENAGA NASIONAL logo">
            <h1>University Event Management System</h1>
        </div>
        <div class="nav-items">
            <div class="nav-item">
                <button class="button"><a href="studenthomepage.php">Homepage</a></button>
            </div>
            <div class="nav-item">
                <button class="button"><a href="availableventstudent.php">Available Events</a></button>
            </div>
            <div class="nav-item">
                <button class="button"><a href="registeredevent.php">Registered Event</a></button>
            </div>
            <div class="nav-item">
                <button class="button"><a href="contact.html">Contact Us</a></button>
            </div>
            <div class="nav-item">
                <button class="button"><a href="aboutus.php">Profile</a></button>
            </div>
            <div class="nav-item">
                <button class="button logout-button" onclick="location.href='page1.html'">Logout</button>
            </div>
        </div>
    </header>
<main>
    <div class="info-boxes">
        <div class="info-box">
            Total Scorun: <?php echo $totalScorun; ?>
        </div>
        <div class="info-box">
            Total Events Registered: <?php echo $totalEvents; ?>
        </div>
    </div>
<?php
if (!empty($events)) {
    // Output data of each row
    foreach ($events as $row) {
        echo "<div class='event-box'>";
        echo "<div class='event-image'><img src='" . $row["Image"]. "' alt='Event Image'></div>";
        echo "<h3>Venue: " . $row["Venue"]. "</h3>";
        echo "<p>Date: " . $row["Date"]. "</p>";
        echo "<p>Time: " . $row["Time"]. "</p>";
        echo "<h2 class='event-title'>" . $row["Title"]. "</h2>";
        echo "<p class='event-description-text'>" . $row["Description"]. "</p>";
        echo "<p>Category: " . $row["College"]. "</p>";
        echo "<p>Name: " . $row["Name"]. "</p>";
        echo "<p>Capacity: " . $row["Capacity"]. "</p>";
        echo "<p>Scorun: " . $row["Scorun"]. "</p>"; // Display Scorun from proposal

        // Check if feedback has been submitted for this event by the user
        $eventID = $row["eventID"];
        $feedbackSql = "SELECT * FROM feedback WHERE eventID = '$eventID' AND UserID = '$UserID'";
        $feedbackResult = $conn->query($feedbackSql);

        if ($feedbackResult->num_rows > 0) {
            echo "<p>Thank you for your feedback!</p>";
        } else {
            echo "<button class='feedback-button' onclick='openFeedbackPopup(" . $row["eventID"] . ")'>Leave Feedback</button>";
        }

        echo "</div>";
    }
} else {
    echo "You have not registered for any events yet.";
}
?>
</main>

<div id="feedbackPopup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closeFeedbackPopup()">&times;</span>
        <form id="feedbackForm" method="POST" action="submit_feedback.php">
            <input type="hidden" name="event_id" id="event_id">
            <input type="hidden" name="user_id" value="<?php echo $UserID; ?>">
            <label for="feedback">Your Feedback:</label>
            <textarea name="feedback" id="feedback" rows="4" required></textarea>
            <button type="submit">Submit Feedback</button>
        </form>
    </div>
</div>

<script>
    function openFeedbackPopup(eventId) {
        document.getElementById('event_id').value = eventId;
        document.getElementById('feedbackPopup').style.display = "block";
    }

    function closeFeedbackPopup() {
        document.getElementById('feedbackPopup').style.display = "none";
    }
</script>
</body>
</html>
