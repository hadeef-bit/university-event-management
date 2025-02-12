<?php
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $type = $_POST['type'];

    if ($type == 'user') {
        $sql = "DELETE FROM user WHERE ID = ?";
    } else if ($type == 'organizer') {
        $sql = "DELETE FROM organizer WHERE ID = ?";
    } else {
        echo "Invalid user type.";
        exit();
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user.";
    }

    $stmt->close();
}

$conn->close();
?>
