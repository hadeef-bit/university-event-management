<?php
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

// SQL query to retrieve event details for the logged-in user
$sql = "SELECT event.eventID, event.UserID, proposal.Title AS EventTitle 
        FROM event 
        INNER JOIN proposal ON event.eventID = proposal.proposalID 
        WHERE proposal.status = 'approved' AND event.UserID = '$UserID'";
$result = $conn->query($sql);

// Initialize an empty array to store events based on event ID
$events_by_id = array();

// Fetch each row and store events based on event ID
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $event_id = $row["eventID"];
        // Check if the event ID exists in the array
        if (!isset($events_by_id[$event_id])) {
            $events_by_id[$event_id] = array();
        }
        // Push the current row into the corresponding event ID array
        array_push($events_by_id[$event_id], $row);
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Event Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            position: relative;
            min-height: 100vh;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('uniten.jpg') no-repeat center center fixed;
            background-size: cover;
            opacity: 0.5;
            z-index: -2;
        }

        body::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        .header, .main-nav, .form-box {
            position: relative;
            z-index: 1;
        }

        .header {
            background-color: #7f3a5f;
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
            height: 70px;
            margin-right: 20px;
        }

        .nav-bar {
            background-color: #c9a4db;
            color: white;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        .main-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background-color: rgba(210, 242, 255, 0.9);
        }

        .main-nav a {
            color: #333;
            text-decoration: none;
            padding: 0 1rem;
        }

        .home-link {
            background-color: #858585;
            color: white;
            padding: 0.5rem 1rem;
            text-decoration: none;
            border-radius: 5px;
        }

        .nav-button:hover {
            background-color: #ddd;
        }

        .home-button {
            background-color: #8aedff;
            color: white;
        }

        .event-box {
            background-color: #e1e1e1;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 2rem;
            padding: 1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .white-text {
            color: white;
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
                <button class="button"><a href="organizerhomepage.php">Homepage</a></button>
            </div>
            <div class="nav-item">
                <button class="button"><a href="organizeravailableevent.php">Available Events</a></button>
            </div>
            <div class="nav-item">
                <button class="button"><a href="EOproposalform.php">Event Management</a></button>
            </div>
            <div class="nav-item">
                <button class="button"><a href="myevent.php">My Event</a></button>
            </div>
            <div class="nav-item">
                <button class="button"><a href="feedback.php">Student's Feedback</a></button>
            </div>
            <div class="nav-item">
                <button class="button"><a href="eventstatus.php">Event Status</a></button>
            </div>
            <div class="nav-item">
                <button class="button"><a href="organizercontactus.html">Contact Us</a></button>
            </div>
            <div class="nav-item">
                <button class="button logout-button" onclick="location.href='page1.html'">Logout</button>
            </div>
        </div>
    </header>

    <main>
        <header>
            <h1 class="white-text">My Upcoming Events</h1>
            <?php
            // Display each event in a separate box
            if (!empty($events_by_id)) {
                foreach ($events_by_id as $event_id => $event_details) {
                    // Get the event title for the current event ID
                    $event_title = $event_details[0]["EventTitle"];
                    echo "<div class='event-box'>";
                    echo "<h2>Event Title: $event_title</h2>";
                    echo "<table>";
                    echo "<tr><th>Event ID</th><th>Student ID</th></tr>";
                    // Output data of each row
                    foreach ($event_details as $event) {
                        echo "<tr><td>" . $event["eventID"] . "</td><td>" . $event["UserID"] . "</td></tr>";
                    }
                    echo "</table>";
                    // Count total users for this event
                    $total_users = count($event_details);
                    echo "<p>Total Students Registered: $total_users</p>";
                    echo "</div>";
                }
            } else {
                echo "<p class='white-text'>No upcoming events found.</p>";
            }
            ?>
        </header>
    </main>
</body>
</html>
