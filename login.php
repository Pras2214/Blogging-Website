<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to the MySQL database
    $servername = "127.0.0.1"; // Replace with your database server
    $username = "root"; // Replace with your database username
    $password = ""; // Replace with your database password
    $dbname = "user_databse"; // Replace with your database name

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check if the connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Extract user input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to retrieve the hashed password for the specified user
    $check_query = "SELECT password FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['password'];

        if (password_verify($password, $hashed_password)) {
            // Password is correct, start a session
            session_start();
            $_SESSION['username'] = $username;
            header('Location: blogs.php'); // Redirect to the main page after successful login
            exit();
        } else {
            // Incorrect password, show error message and redirect to login page
            $error_message = "Incorrect password. Please try again.";
            header("Location: login.php?error=" . urlencode($error_message));
            exit();
        }
    } else {
        // User does not exist, redirect to login page with an error message
        $error_message = "User not found. Please register or try a different username.";
        header("Location: register.php");
        exit();
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Add your meta tags, title, and stylesheet links here -->
    <link rel="stylesheet" href="styles.css">
    <style>
      /* Add your custom CSS for styling */
          .error-message {
        color: red;
      }
    </style>
  </head>
  <body>
  <div class="login-container">
        <h1>Login to Your Account</h1>
        <p id="error-message" class="error-message">Incorrect Password. Please Try Again</p>
        <form action="login.php" method="POST">
            <div class="input-field">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.html">Sign up</a></p>
    </div>
    <!-- Your login form and other content here -->
  </body>
</html>
