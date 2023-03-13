<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Check if username is available
$sql = "SELECT * FROM register WHERE username = '$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$response = array(
		"success" => false,
		"message" => "Username is already taken."
	);
	echo json_encode($response);
	exit;
}

// Check if email is available
$sql = "SELECT * FROM register WHERE email = '$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$response = array(
		"success" => false,
		"message" => "Email is already registered."
	);
	echo json_encode($response);
	exit;
}

// Hash the password
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Insert the user into the database
$sql = "INSERT INTO register (username, email, password, confirm_password) VALUES ('$username', '$email', '$password_hash', '$password_hash')";
if ($conn->query($sql) === TRUE) {
	$response = array(
		"success" => true,
		"message" => "Registration successful. You can now login."
	);
	echo json_encode($response);
} else {
	$response = array(
		"success" => false,
		"message" => "An error occurred while processing your request."
	);
	echo json_encode($response);
}

$conn->close();
?>
