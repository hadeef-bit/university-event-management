<?php
//these codes is for login process
//check userid & pwd is matched 
//get form input 
$UserID = $_POST['UserID']; 
$Password = $_POST['Password'];

//declare DB connection variables
$host = "localhost"; //host name
$user = "root"; //database userid 
$pass = ""; //database pwd
$db = "eventuser";// please write your DB name 

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) { 
 //to check if DB connection IS NOT OK
 die("Connection failed: " . $conn->connect_error); 
}
else
{ 
//connection OK - get records for the selected User account

$queryCheck = "select * from organizer where UserID = '".$UserID."'";

$resultCheck = $conn->query($queryCheck); 

	if ($resultCheck->num_rows == 0) { //if no record match
		echo "<p style='color:red;'>User ID does not exist</p>";
		echo "<br>Click <a href='organizerlogin.html'> here </a> to LOGIN again.";
	}
	else{
	// record matched, get the data
	while($row = $resultCheck->fetch_assoc()) {
		
	if( $row["Password"] == $Password ) {
		
		//in order to asign, use or destroy session
		//calling the session_start() is compulsory
		session_start();
	
		//asign userid value to session userid
		$_SESSION["UserID"] = $UserID ;
		//redirect to page menu.php
		header("Location:organizerhomepage.php");
		
		
	}
	else{
		echo "<p style='color:red;'>WRONG PASSWORD!!!</p>";
		echo "<br>Click <a href='organizerlogin.html'> here </a> to LOGIN again.";
	}
	
	}
	$conn->close();
	}
}
?>
