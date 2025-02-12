<?php
session_start();

// Sample database connection (replace this with your actual connection code)
$con = mysqli_connect("localhost", "root", "", "eventuser") or die("Cannot connect to server: " . mysqli_error($con));

// Check the connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get form data and sanitize it
$Venue = isset($_POST['venues']) ? mysqli_real_escape_string($con, $_POST['venues']) : '';
$Date = isset($_POST['date']) ? mysqli_real_escape_string($con, $_POST['date']) : '';
$StartTime = isset($_POST['start-time']) ? mysqli_real_escape_string($con, $_POST['start-time']) : '';
$EndTime = isset($_POST['end-time']) ? mysqli_real_escape_string($con, $_POST['end-time']) : '';
$Title = isset($_POST['title']) ? mysqli_real_escape_string($con, $_POST['title']) : '';
$Description = isset($_POST['description']) ? mysqli_real_escape_string($con, $_POST['description']) : '';
$College = isset($_POST['college']) ? mysqli_real_escape_string($con, $_POST['college']) : '';
$Name = isset($_POST['name']) ? mysqli_real_escape_string($con, $_POST['name']) : '';
$UserID = isset($_POST['userid']) ? mysqli_real_escape_string($con, $_POST['userid']) : '';
$Capacity = isset($_POST['capacity']) ? mysqli_real_escape_string($con, $_POST['capacity']) : '';
$Image = isset($_FILES['image']['name']) ? mysqli_real_escape_string($con, $_FILES['image']['name']) : '';
$Room = isset($_POST['Room']) ? mysqli_real_escape_string($con, $_POST['Room']) : '';

// Check if the combination of date, time, and venue already exists
$checkQuery = "SELECT * FROM proposal WHERE Date='$Date' AND Venue='$Venue' AND (STR_TO_DATE(SUBSTRING_INDEX(Time, ' to ', 1), '%H:%i') BETWEEN '$StartTime' AND '$EndTime' OR STR_TO_DATE(SUBSTRING_INDEX(Time, ' to ', -1), '%H:%i') BETWEEN '$StartTime' AND '$EndTime' OR '$StartTime' BETWEEN STR_TO_DATE(SUBSTRING_INDEX(Time, ' to ', 1), '%H:%i') AND STR_TO_DATE(SUBSTRING_INDEX(Time, ' to ', -1), '%H:%i'))";
$checkResult = mysqli_query($con, $checkQuery);

if (mysqli_num_rows($checkResult) > 0) {
    // Date, time, and venue combination already exists, display an error message
    $_SESSION['error_message'] = "An event is already scheduled at the selected venue on the selected date and time.";
    header("Location: EOproposalform.php");
    exit();
}

// Concatenate start-time and end-time to store in the Time column
$Time = $StartTime . " to " . $EndTime;

// Combine Venue and Room if Room is provided
$FullVenue = $Room ? "$Venue : $Room" : $Venue;

// Perform the proposal insertion
$sql = "INSERT INTO proposal (Venue, Date, Time, Title, Description, Image, College, Name, UserID, Capacity, Status) 
        VALUES ('$FullVenue', '$Date', '$Time', '$Title', '$Description', '$Image', '$College', '$Name', '$UserID', '$Capacity', 'pending')";
$result = mysqli_query($con, $sql);

if ($result) {
    // Proposal submission successful
    $_SESSION['success_message'] = "Proposal submitted successfully.";
    header("Location: organizerhomepage.php");
    exit();
} else {
    // Proposal submission unsuccessful
    $_SESSION['error_message'] = "Proposal submission failed. Please try again.";
    header("Location: EOproposalform.php");
    exit();
}

// Close the connection
mysqli_close($con);
?>