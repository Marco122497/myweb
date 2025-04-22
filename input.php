<?php
session_start();

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "myweb"; // 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$error = '';

// On form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Query to check user credentials
    $sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $user;
        header("Location: main.php"); // Redirect to welcome page
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>