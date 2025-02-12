<?php
// Database connection
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

// Get the form data
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phoneNum = $_POST['phoneNum'];
$password = $_POST['password'];

// Update user details in the database
$sql = "UPDATE user SET Name='$name', Email='$email', PhoneNum='$phoneNum', Password='$password' WHERE UserID='$id'";

if ($conn->query($sql) === TRUE) {
    header("Location: adminhomepage.php?message=User updated successfully");
} else {
    echo "Error updating record: " . $conn->error;
}

// Close connection
$conn->close();
?>