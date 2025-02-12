<?php
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

// Validate inputs
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_id = $_POST['event_id'];
    $user_id = $_POST['user_id'];
    $feedback = $conn->real_escape_string($_POST['feedback']);

    // Check if feedback already exists for this event and user
    $check_sql = "SELECT * FROM feedback WHERE eventID = '$event_id' AND UserID = '$user_id'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // Feedback already submitted
        echo "You have already submitted feedback for this event.";
    } else {
        // Insert feedback into the database
        $insert_sql = "INSERT INTO feedback (eventID, UserID, feedback) VALUES ('$event_id', '$user_id', '$feedback')";

        if ($conn->query($insert_sql) === TRUE) {
            // Redirect to studenthomepage.php after successful submission
            header("Location: studenthomepage.php");
            exit();
        } else {
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>