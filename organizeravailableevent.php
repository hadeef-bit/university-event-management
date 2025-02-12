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
        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.8);
            width: 100%;
            margin-top: 20px;
        }
        .event-box {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
            max-width: 600px;
            width: 100%;
        }
        .event-image img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .event-title {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        .event-date {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        .event-description-text {
            line-height: 1.5;
            margin-bottom: 10px;
        }
        form {
            margin-bottom: 20px;
        }
        select, input[type="text"] {
            padding: 8px;
            font-size: 16px;
            margin-right: 10px;
        }
        input[type="submit"] {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
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
        <h2 id="available-events">Available Events</h2>
        <p>Uniten's Available events</p>
        <form method="POST">
            <select name="college">
                <option value="Art & Cultural">Art & Cultural</option>
                <option value="Communication & Entrepreneurship">Communication & Entrepreneurship</option>
                <option value="Leadership & Intellectual">Leadership & Intellectual</option>
                <option value="Spiritual Values & Civilizational">Spiritual Values & Civilizational</option>
                <option value="Sports & Recreational">Sports & Recreational</option>
                <option value="Exempted">Exempted</option>
                <option value="Ethics & Humanity">Ethics & Humanity</option>
                <option value="Leadership & Communication">Leadership & Communication</option>
                <option value="Sports & Recreation">Sports & Recreation</option>
                <option value="Arts & Culture">Arts & Culture</option>
                <option value="Intellectuality">Intellectuality</option>
                <option value="Entrepreneurship">Entrepreneurship</option>
            </select>
            <input type="text" name="search" placeholder="Search event title">
            <input type="submit" value="Submit">
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve the selected college and search term from the form
            $selected_college = $_POST["college"];
            $search_term = $_POST["search"];

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

            // SQL query to fetch proposals based on the selected college and search term
            $sql = "SELECT * FROM proposal WHERE College = '$selected_college' AND Title LIKE '%$search_term%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<div class='event-box'>";
                    echo "<div class='event-image'><img src='" . $row["Image"]. "' alt='Event Image'></div>";
                    echo "<h3 class='event-title'>" . $row["Title"] . "</h3>";
                    echo "<p class='event-date'>Date: " . $row["Date"] . " | Time: " . $row["Time"] . "</p>";
                    echo "<p class='event-description-text'>" . $row["Description"] . "</p>";
                    echo "<p>Venue: " . $row["Venue"] . "</p>";
                    echo "<p>Capacity: " . $row["Capacity"] . "</p>";
                    // You can display more details here as needed
                    echo "</div>";
                }
            } else {
                echo "<div class='event-box'>No events found for the selected category or search term.</div>";
            }
            $conn->close();
        }
        ?>
    </main>
</body>
</html>