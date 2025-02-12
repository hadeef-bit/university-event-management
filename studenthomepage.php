<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universiti Tenaga Nasional</title>
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
        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-top: 20px;
        }
        .welcome-box {
            background-color: #fff;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 60%;
            margin-top: 20px;
            text-align: center;
        }
        .welcome-box h3 {
            font-size: 2rem; /* Adjust font size for h3 */
            margin-bottom: 10px;
        }
        .welcome-box p {
            font-size: 1.2rem; /* Adjust font size for p */
            margin-bottom: 10px;
        }
        .event-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
            margin-top: 20px;
        }
        .event-box {
            margin-bottom: 20px;
            text-align: left;
            padding: 20px;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .event-image {
            margin-bottom: 10px;
        }
        .event-image img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .event-title {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        .event-description-text {
            line-height: 1.5;
            margin-bottom: 10px;
        }
        .register-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
        }
        .register-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<?php
session_start();

// Assuming user ID is stored in session when the user logs in
$userID = $_SESSION['UserID'];

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

// Fetch the user's name from the user table
$sql = "SELECT Name FROM user WHERE UserID = '$userID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userName = $row['Name'];
} else {
    die("User not found.");
}
?>
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
    <div class="welcome-box">
        <h3>Welcome <?php echo $userName; ?> to Universiti Tenaga Nasional</h3>
        <p>Upcoming Events</p>
    </div>
    <div class="event-container">
        <?php
        // Fetch approved proposals that the user has not registered for
        $sql = "SELECT * FROM proposal WHERE Status='approved' AND proposalID NOT IN (SELECT EventID FROM event WHERE UserID='$userID')";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
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
                echo "<form method='POST' action='register_event.php'>";
                echo "<input type='hidden' name='event_id' value='" . $row["proposalID"] . "'>";
                echo "<input type='hidden' name='user_id' value='" . $userID . "'>";
                echo "<button type='submit' class='register-button'>Register Now</button>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "No approved events found.";
        }

        $conn->close();
        ?>
    </div>
</main>
</body>
</html>