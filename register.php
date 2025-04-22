<!-- filepath: c:\xampp\htdocs\MYWEB\register.php -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myweb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$success = '';
$error = '';

// On form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Check if username already exists
    $sql = "SELECT * FROM users WHERE username='$user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $error = "Username already exists!";
    } else {
        // Insert new user into the database
        $sql = "INSERT INTO users (username, password) VALUES ('$user', '$pass')";
        if ($conn->query($sql) === TRUE) {
            $success = "Registration successful! You can now <a href='login.php'>login</a>.";
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" href="icon/logo.ico" type="image/x-icon">
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-sm">
    
    <!-- School Logo -->
    <div class="flex justify-center mb-6">
      <img src="img/logo.png" alt="School Logo" class="w-24 h-auto">
    </div>
    <!-- Page Title -->
    <h2 class="text-2xl font-semibold text-center text-gray-700 mb-4">Register</h2>

<!-- Error Message -->
    <?php if ($error): ?>
      <p class="text-red-500 text-sm text-center"><?php echo $error; ?></p>
    <?php endif; ?>

<!-- Success Message -->
    <?php if ($success): ?>
      <p class="text-green-500 text-sm text-center"><?php echo $success; ?></p>
    <?php endif; ?>

<!-- Registration Form -->
    <form action="#" method="POST" class="space-y-4">
<!-- Username Field -->
      <div>
        <label for="username" class="block text-sm font-medium text-gray-800">Username</label>
        <input type="text" id="username" name="username" required
               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

<!-- Password Field -->
      <div>
        <label for="password" class="block text-sm font-medium text-gray-800">Password</label>
        <input type="password" id="password" name="password" required
               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

<!-- Submit Button -->
      <button type="submit"
              class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300">
        Register
      </button>
    </form>

<!-- Login Link -->
    <p class="text-sm text-center text-gray-500 mt-4">
      Already have an account? 
      <a href="login.php" class="text-blue-600 hover:underline">Login here</a>
    </p>
  </div>
</body>
</html>