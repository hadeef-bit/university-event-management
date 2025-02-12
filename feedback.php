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
    opacity: 0.5; /* Adjust this value for lighter/darker overlay */
    z-index: -2;
}

body::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* Adjust this value for lighter/darker overlay */
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
            margin-left: auto; /* This shifts the navigation items to the right */
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
            background-color: #d2f2ff;
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
        .event-feedback {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }
        .feedback-box {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .feedback-item {
            margin-bottom: 15px;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .feedback-item:last-child {
            border-bottom: none;
        }
        .feedback-header {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .feedback-content {
            margin-bottom: 5px;
        }
        .white-text {
    color: white;
        }
    </style>
</head>
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
    <section id="home">
        <h3 class="white-text">Student's Feedback</h3>
    </section>

    <?php
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

    // SQL query to fetch feedback grouped by event
    $sql = "SELECT feedback.eventID, feedback.UserID, feedback.feedback, proposal.Title 
            FROM feedback 
            JOIN proposal ON feedback.eventID = proposal.proposalID
            ORDER BY feedback.eventID"; // Order by eventID to group feedback by event
    $result = $conn->query($sql);

    $current_event = ""; // Variable to keep track of current event

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            // Check if the event has changed
            if ($row["eventID"] !== $current_event) {
                // If it's a new event, close the previous feedback box (if exists) and open a new one
                if ($current_event !== "") {
                    echo "</div>"; // Close previous feedback box
                }
                echo "<div class='event-feedback'>";
                echo "<h2>" . $row["Title"] . "</h2>"; // Display event title
                $current_event = $row["eventID"]; // Update current event
            }
            // Display feedback for the current event
            echo "<div class='feedback-box'>";
            echo "<div class='feedback-item'>";
            echo "<div class='feedback-content'>User ID: " . $row["UserID"] . "</div>";
            echo "<div class='feedback-content'>" . $row["feedback"] . "</div>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>"; // Close the last feedback box
    } else {
        echo '<p style="color: white;">No Feedback Found.</p>';
    }

    $conn->close();
    ?>
</html>