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
        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.8);
            width: 100%;
            padding: 2rem;
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
    <main>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "eventuser";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM proposal WHERE Status='approved'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='event-container'>";
                echo "<img src='" . $row["Image"]. "' alt='Event Image'>";
                echo "<section id='home'>";
                echo "<h3>Venue: " . $row["Venue"]. "</h3>";
                echo "<p>Date: " . $row["Date"]. "</p>";
                echo "<p>Time: " . $row["Time"]. "</p>";
                echo "<h2>" . $row["Title"]. "</h2>";
                echo "<p>" . $row["Description"]. "</p>";
                echo "<p>Category: " . $row["College"]. "</p>";
                echo "<p>Name: " . $row["Name"]. "</p>";
                echo "<p>Capacity: " . $row["Capacity"]. "</p>";
                echo "</section>";
                echo "</div>";
            }
        } else {
            echo "0 results";
        }

        $conn->close();
    ?>
    </main>
</html>