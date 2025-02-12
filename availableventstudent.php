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
            font-size: 2rem;
            margin-bottom: 10px;
        }
        .welcome-box p {
            font-size: 1.2rem;
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
        .search-bar {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px 0;
        }
        .search-bar select,
        .search-bar input[type="text"],
        .search-bar input[type="submit"] {
            padding: 10px;
            margin-right: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        .search-bar select {
            background-color: #fff;
        }
        .search-bar input[type="text"] {
            flex-grow: 1;
        }
        .search-bar input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            border: none;
        }
        .search-bar input[type="submit"]:hover {
            background-color: #45a049;
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
        <h2 id="available-events">Available Events</h2>
        <p>Uniten's Available events</p>
        <form method="POST" class="search-bar">
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
            $selected_college = $_POST["college"];
            $search_term = $_POST["search"];

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "eventuser";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM proposal WHERE College = '$selected_college' AND Title LIKE '%$search_term%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='event-box'>";
                    echo "<div class='event-image'><img src='" . $row["Image"]. "' alt='Event Image'></div>";
                    echo "<h3 class='event-title'>" . $row["Title"] . "</h3>";
                    echo "<p class='event-date'>Date: " . $row["Date"] . " | Time: " . $row["Time"] . "</p>";
                    echo "<p class='event-description-text'>" . $row["Description"] . "</p>";
                    echo "<p>Venue: " . $row["Venue"] . "</p>";
                    echo "<p>Capacity: " . $row["Capacity"] . "</p>";
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