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

// SQL query to fetch user information
$userSql = "SELECT * FROM user WHERE UserID = '$UserID'";
$userResult = $conn->query($userSql);
$user = $userResult->fetch_assoc();

// Handle form submission to update user information
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phoneNum = $_POST['phoneNum'];

    // Handle file upload
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
        $targetDir = "uploads/";
        
        // Check if the uploads directory exists
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $targetFile = $targetDir . basename($_FILES["picture"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $validExtensions = ["jpg", "jpeg", "png", "gif"];

        // Check file type
        if (in_array($imageFileType, $validExtensions)) {
            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFile)) {
                $picture = $targetFile;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
    } else {
        $picture = $user['Picture'];
    }

    $updateSql = "UPDATE user SET Name='$name', Email='$email', PhoneNum='$phoneNum', Picture='$picture' WHERE UserID='$UserID'";

    if ($conn->query($updateSql) === TRUE) {
        echo "Record updated successfully";
        // Refresh user data
        $userSql = "SELECT * FROM user WHERE UserID = '$UserID'";
        $userResult = $conn->query($userSql);
        $user = $userResult->fetch_assoc();
    } else {
        echo "Error updating record: " . $conn->error;
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
            height: 100vh;
            justify-content: center;
            align-items: center;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Shadow */
            padding: 40px; /* Padding inside the box */
            width: 80%; /* Set the width of the container */
            max-width: 800px; /* Maximum width of the content */
            text-align: center; /* Center text inside the box */
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
        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 100%;
            height: 100%;
            justify-content: center;
        }
        .content-box {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px auto;
            max-width: 800px;
            text-align: left;
        }
        .content-box h2 {
            font-size: 2rem;
            margin-bottom: 10px;
        }
        .content-box p {
            font-size: 1.2rem;
            line-height: 1.6;
        }
        .logout-button {
            background-color: #ff3465;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
        }
        .logout-button:hover {
            background-color: #ff3465;
        }
        .profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 20px;
            cursor: pointer;
        }
        .edit-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .edit-form label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        .edit-form input {
            margin-bottom: 10px;
            padding: 8px;
            width: 100%;
            max-width: 300px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .edit-form button {
            background-color: #300843;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }
        .edit-form button:hover {
            background-color: #432c63;
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
                <button class="button"><a href="aboutus.html">Profile</a></button>
            </div>
            <div class="nav-item">
                <button class="button logout-button" onclick="location.href='page1.html'">Logout</button>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <h2>User Profile</h2>
            <form class="edit-form" method="POST" action="" enctype="multipart/form-data">
                <label for="picture">
                    <img src="<?php echo $user['Picture']; ?>" alt="Profile Picture" class="profile-pic" onclick="document.getElementById('picture').click();">
                </label>
                <input type="file" id="picture" name="picture" style="display: none;">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $user['Name']; ?>" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $user['Email']; ?>" required>
                <label for="phoneNum">Phone Number:</label>
                <input type="text" id="phoneNum" name="phoneNum" value="<?php echo $user['PhoneNum']; ?>" required>
                <button type="submit">Update Profile</button>
            </form>
        </div>
    </main>
</body>
</html>