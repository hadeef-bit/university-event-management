<?php
// Include database connection code
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

// Fetch user details based on UserID
$userId = $_GET['id']; // Ensure to sanitize this input in a real scenario
$sql = "SELECT * FROM user WHERE UserID = $userId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
    // Output user data as JSON
    echo json_encode($userData);
} else {
    echo "User not found";
}

$conn->close();
?>
