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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>School Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-sm">
    
    <!-- School Logo -->
    <div class="flex justify-center mb-6">
      <img src="img/logo.png" alt="School Logo" class="w-24 h-auto">
    </div>

    <!-- Login Title -->
    <h2 class="text-2xl font-semibold text-center text-gray-700 mb-4">Login to Your Account</h2>

    <!-- Login Form -->
    <form action="#" method="POST" class="space-y-4">
      <div>
        <label for="username" class="block text-sm font-medium text-gray-600">Email</label>
        <input type="text" id="username" name="username" required
               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
        <input type="password" id="password" name="password" required
               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <button type="submit"
              class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300">
        Login
      </button>
    </form>

    <!-- Optional: Forgot password link -->
    <p class="text-sm text-center text-gray-500 mt-4">
      <a href="#" class="text-blue-600 hover:underline">Forgot your password?</a>
    </p>
  </div>
</body>
</html>
