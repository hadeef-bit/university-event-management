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
            color: white;
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

        .nav-item {
            margin: 0 1rem;
        }

        .button {
            background-color: transparent;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            color: white;
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

        .categories {
            margin-bottom: 2rem;
            padding: 1rem;
        }

        .category-header {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .category-list {
            list-style-type: none;
            padding: 0;
        }

        .category-item {
            background-color: #fff;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            color: black;
        }

        #search {
            width: 50%;
            padding: 0.5rem;
            font-size: 1rem;
            border: 2px solid #ccc;
            border-radius: 5px;
            margin: 1rem auto;
            display: block;
            color: black;
        }

        .edit-form-container {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 1rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            z-index: 1000;
            color: black;
        }

        .edit-form-container input[type="text"],
        .edit-form-container input[type="email"],
        .edit-form-container input[type="password"] {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            color: black;
        }

        .edit-form-container button {
            padding: 0.5rem 1rem;
        }

        .edit-form-container .close-button {
            background-color: #ff6357;
            border: none;
            color: white;
            padding: 0.5rem 1rem;
            cursor: pointer;
            float: right;
        }
    </style>
</head>
<body>
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
<input type="text" id="search" placeholder="Search..." oninput="searchUser()" />
<div id="display"></div>
<div class="categories">
    <h2 class="category-header">Student</h2>
    <ul class="category-list" id="studentList">
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

        // Fetch users
        $sql = "SELECT * FROM user";
        $result = $conn->query($sql);
        $studentCount = 0;

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<li class='category-item' data-name='" . strtolower($row["Name"]) . "'>";
                echo "<span>" . $row["Name"] . " - " . $row["Email"] . " - " . $row["PhoneNum"] . "</span>";
                echo "</li>";
                $studentCount++;
            }
        } else {
            echo "<li class='category-item'>No users found</li>";
        }

        $conn->close();
        ?>
    </ul>
    <p>Total Students: <?php echo $studentCount; ?></p>
</div>
<div class="categories">
    <h2 class="category-header">Organizers</h2>
    <ul class="category-list" id="organizerList">
        <?php
        // Reconnect for organizers
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch organizers
        $sql = "SELECT * FROM organizer";
        $result = $conn->query($sql);
        $organizerCount = 0;

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<li class='category-item' data-name='" . strtolower($row["Name"]) . "'>";
                echo "<span>" . $row["Name"] . " - " . $row["Email"] . " - " . $row["PhoneNum"] . "</span>";
                echo "</li>";
                $organizerCount++;
            }
        } else {
            echo "<li class='category-item'>No organizers found</li>";
        }

        $conn->close();
        ?>
    </ul>
    <p>Total Organizers: <?php echo $organizerCount; ?></p>
</div>

    <!-- Edit Form Container -->
    <div class="edit-form-container" id="editFormContainer">
        <form id="editForm" method="post" action="updateUser.php">
            <input type="hidden" name="id" id="editUserId">
            <label for="editName">Name:</label>
            <input type="text" name="name" id="editName" required>
            <label for="editEmail">Email:</label>
            <input type="email" name="email" id="editEmail" required>
            <label for="editPhoneNum">Phone Number:</label>
            <input type="text" name="phoneNum" id="editPhoneNum" required>
            <label for="editPassword">Password:</label>
            <input type="password" name="password" id="editPassword" required>
            <button type="submit">Save</button>
            <button type="button" class="close-button" onclick="closeEditForm()">Close</button>
        </form>
    </div>

    <script>
    function closeEditForm() {
        document.getElementById('editFormContainer').style.display = 'none';
    }


    function editOrganizer(userId) {
    }

    function searchUser() {
        var input = document.getElementById('search').value.toLowerCase();
        var studentList = document.getElementById('studentList').getElementsByTagName('li');
        var organizerList = document.getElementById('organizerList').getElementsByTagName('li');

        filterList(studentList, input);
        filterList(organizerList, input);
    }

    function filterList(list, input) {
        for (var i = 0; i < list.length; i++) {
            var item = list[i];
            var name = item.getAttribute('data-name');
            if (name.includes(input)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        }
    }
    </script>
</body>
</html>
