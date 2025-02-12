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

        /* Style for the table */
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

        .event-box {
            background-color: white; /* Set background color to white */
            border: 1px solid #ddd;
            padding: 1rem;
            margin: 1rem 0;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Optional: Add some shadow for better visibility */
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

    <header>
    <h1 class="white-text">Event Status</h1>
        <?php
        // PHP code to connect to database and retrieve proposal details with status "Rejected"
        $servername = "localhost"; // Change this if your database is hosted elsewhere
        $username = "root"; // Your database username
        $password = ""; // Your database password
        $dbname = "eventuser"; // Your database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query to retrieve proposal details where Status is "Rejected"
        $sql = "SELECT proposalID, UserID, Venue, Date, Time, Title, Description, Image, College, Name, Capacity, Status, Reason FROM proposal WHERE Status = 'Rejected'";
        $result = $conn->query($sql);

        // Display each rejected proposal in a separate box
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='event-box'>";
                echo "<h2>Event Title: " . $row["Title"] . "</h2>";
                echo "<table>";
                echo "<tr><th>Proposal ID</th><td>" . $row["proposalID"] . "</td></tr>";
                echo "<tr><th>Organizer ID</th><td>" . $row["UserID"] . "</td></tr>";
                echo "<tr><th>Venue</th><td>" . $row["Venue"] . "</td></tr>";
                echo "<tr><th>Date</th><td>" . $row["Date"] . "</td></tr>";
                echo "<tr><th>Time</th><td>" . $row["Time"] . "</td></tr>";
                echo "<tr><th>Description</th><td>" . $row["Description"] . "</td></tr>";
                echo "<tr><th>College</th><td>" . $row["College"] . "</td></tr>";
                echo "<tr><th>Organizer Name</th><td>" . $row["Name"] . "</td></tr>";
                echo "<tr><th>Capacity</th><td>" . $row["Capacity"] . "</td></tr>";
                echo "<tr><th>Status</th><td>" . $row["Status"] . "</td></tr>";
                
                // Display reason for rejection
                echo "<tr><th>Reason for Rejection</th><td>" . $row["Reason"] . "</td></tr>";

                echo "</table>";
                echo "</div>";
            }
        } else {
            echo '<p style="color: white;">No proposals have been rejected.</p>';
        }

        $conn->close();
        ?>
    </header>
</body>
</html>