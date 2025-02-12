<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventuser";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$proposalID = $_POST['proposalID'];
$status = $_POST['status'];

$response = ["success" => false, "message" => ""];

// Update the proposal status
$sql = "UPDATE proposal SET Status='$status' WHERE proposalID='$proposalID'";
if ($conn->query($sql) === TRUE) {
    if ($status == 'approved') {
        // Fetch the proposal details
        $fetchSql = "SELECT proposalID, Date FROM proposal WHERE proposalID='$proposalID'";
        $result = $conn->query($fetchSql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $eventID = $row['proposalID'];
            $eventDate = $row['Date'];

            // Insert into event table
            $insertSql = "INSERT INTO event (eventID, Date) VALUES ('$eventID', '$eventDate')";
            if ($conn->query($insertSql) === TRUE) {
                $response["success"] = true;
                $response["message"] = "Proposal approved and event created successfully.";
            } else {
                $response["message"] = "Error creating event: " . $conn->error;
            }
        } else {
            $response["message"] = "Proposal not found.";
        }
    } else {
        $response["success"] = true;
        $response["message"] = "Proposal status updated successfully.";
    }
} else {
    $response["message"] = "Error updating proposal: " . $conn->error;
}

echo json_encode($response);
$conn->close();
?>
