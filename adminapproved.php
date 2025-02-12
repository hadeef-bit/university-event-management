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
            background-color: #2c3670;
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
        .nav-item {
            margin: 0 1rem;
        }
        .event-description {
            padding: 2rem;
        }
        .event-title {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        .event-date {
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }
        .event-description-text {
            line-height: 1.5;
        }
        .nav-button {
            background-color: transparent;
            border: none;
            padding: 0;
            margin: 0;
            cursor: pointer;
            display: flex;
            align-items: center;
        }
        .nav-button a {
            text-decoration: none;
            color: #333;
            padding: 0 1rem;
        }
        .nav-button:hover a {
            color: #e6f5d0;
        }
        .nav-button:hover {
            background-color: #ddd;
        }
        .approved {
            background-color: #3e973b;
            color: white;
        }
        .proposal {
            background-color: white;
            padding: 1rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .proposal .event-title {
            color: #335500;
        }
    </style>
</head>
<header class="header">
    <div class="header-content">
        <img src="unitenlogo.png" alt="UNIVERSITI TENAGA NASIONAL logo">
        <h1>University Event Management System</h1>
    </div>
    <div class="nav-item">
        <button class="button"><a href="adminhomepage.php">Homepage</a></button>
    </div>
    <div class="nav-item">
        <button class="button"><a href="adminpendingproposal.php">Pending Proposal</a></button>
    </div>
    <div class="nav-item">
        <button class="button"><a href="adminapproved.php">Approved Proposal</a></button>
    </div>
    <div class="nav-item">
        <button class="button"><a href="adminrejected.php">Rejected Proposal</a></button>
    </div>
    <div class="nav-item">
        <button class="button"><a href="admincontactus.html">Contact Us</a></button>
    </div>
    <div class="nav-item">
        <button class="button"><a href="users.php">Users</a></button>
    </div>
    <div class="nav-item">
            <button class="button logout-button" onclick="location.href='page1.html'">Logout</button>
        </div>
    </header>
    <div class="event-description">
        <!-- Assuming you fetch and display pending proposals from the database -->
        <?php
        // Sample database connection (replace this with your actual connection code)
        $con = mysqli_connect("localhost", "root", "", "eventuser") or die("Cannot connect to server: " . mysqli_error($con));
    
        // Check the connection
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
    
        // Fetch approved proposals
        $query = "SELECT * FROM proposal WHERE Status='approved'";
        $result = mysqli_query($con, $query);
    
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='proposal'>";
                echo "<div class='Name'><strong>Organizer Name:</strong> " . htmlspecialchars($row['Name']) . "</div>";
                echo "<div class='UserID'><strong>Organizer ID:</strong> " . htmlspecialchars($row['UserID']) . "</div>";
                echo "<div class='event-title'><strong>Title:</strong> " . htmlspecialchars($row['Title']) . "</div>";
                echo "<div class='event-date'><strong>Date:</strong> " . htmlspecialchars($row['Date']) . "</div>";
                echo "<div class='event-description-text'><strong>Description:</strong> " . htmlspecialchars($row['Description']) . "</div>";
                echo "<div id='status-" . $row['UserID'] . "' class='event-status'><strong>Status:</strong> " . htmlspecialchars($row['Status']) . "</div>";
                echo "</div>";
            }
        } else {
            echo "<div>No approved proposals found.</div>";
        }
    
        // Close the connection
        mysqli_close($con);
        ?>
    </div>
</body>
</html>
