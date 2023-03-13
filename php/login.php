<?php
// Start session
session_start();

// Set database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$email = $_POST["email"];
$password = $_POST["password"];

// Query to check if user with given credentials exists
$sql = "SELECT * FROM register WHERE email='$email'";
$result = $conn->query($sql);

// If user with given credentials exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row["password"])==true) {
        // Set session variables
        $_SESSION["email"] = $email;
        $_SESSION["loggedIn"] = true;

        // Send success response
        $response = array(
            "success" => true,
            "message" => "Login successful. Redirecting to profile page."
        );
        echo json_encode($response);
    } else {
        // Send error responses
        $response = array(
            "success" => false,
            "message" => "Invalid email or password."
        );
        echo json_encode($response);
    }
} else {
    // Send error response
    $response = array(
        "success" => false,
        "message" => "Invalid email or password."
    );
    echo json_encode($response);
}

// Close database connection
$conn->close();
?>
