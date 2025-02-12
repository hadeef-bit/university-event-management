<?php
session_start();

// Sample database connection (replace this with your actual connection code)
$con = mysqli_connect("localhost", "root", "", "eventuser") or die("Cannot connect to server: " . mysqli_error($con));

// Check the connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Assuming you have received the user details from the registration form
$Name = isset($_POST['name']) ? mysqli_real_escape_string($con, $_POST['name']) : '';
$PhoneNum = isset($_POST['number']) ? mysqli_real_escape_string($con, $_POST['number']) : '';
$Email = isset($_POST['email']) ? mysqli_real_escape_string($con, $_POST['email']) : '';
$Password = isset($_POST['password']) ? mysqli_real_escape_string($con, $_POST['password']) : '';
$UserID = isset($_POST['studentid']) ? mysqli_real_escape_string($con, $_POST['studentid']) : '';

// Check if the username already exists
$checkQuery = "SELECT * FROM user WHERE UserID='$UserID'";
$checkResult = mysqli_query($con, $checkQuery);

if (mysqli_num_rows($checkResult) > 0) {
    // Username already exists, display an error message
    $_SESSION['error_message'] = "Student ID already exists. Please enter your correct Student ID.";
    header("Location: studentsignup.html");
    exit();
}

// Perform the registration
$sql = "INSERT INTO User (Name, Email, PhoneNum, UserID, Password) VALUES ('$Name', '$PhoneNum', '$Email', '$UserID', '$Password')";
$result = mysqli_query($con, $sql);

if ($result) {
    // Registration successful
    $_SESSION['success_message'] = "Registration successful. You can now log in.";
    header("Location: studentlogin.html");
    exit();
} else {
    // Registration unsuccessful
    $_SESSION['error_message'] = '<span class="error-message">Registration failed. Please try again.</span>';
    header("Location: studentsignup.html");
    exit();
}

// Close the connection
mysqli_close($con);
?>