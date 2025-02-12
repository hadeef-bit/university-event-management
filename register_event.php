<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventuser";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventID = $_POST['event_id'];
    $userID = $_POST['user_id'];

    $sql = "INSERT INTO event (eventID, UserID) VALUES ('$eventID', '$userID')";

    if ($conn->query($sql) === TRUE) {
        header("Location: registeredevent.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>