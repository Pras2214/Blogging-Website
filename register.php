<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to the MySQL database (replace with your database credentials)
    $conn = mysqli_connect("127.0.0.1", "root", "", "user_databse");

    // Check if the connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Extract user input
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Hash the password using Bcrypt
    $salt="JBFG834JBF894TDVKLSDN"; // Adjust the cost factor as needed (higher is slower but more secure)
    $hashed_password = crypt($password, $salt);

    // Check if the user already exists
    $check_query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($result) > 0) {
        // User already exists, redirect to login page
        header('Location: index.html?error=existing_user');
        exit();
    }

    // Insert the user into the database
    $insert_query = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";
    if (mysqli_query($conn, $insert_query)) {
        // Successful registration, start a session
        session_start();
        $_SESSION['username'] = $username;
        header('Location: blogs.php?success=1');
        exit();
    } else {
        // Registration failed, handle the error
        echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Handle invalid request method
    http_response_code(405); // Method Not Allowed
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register for an Account</title>
    <link rel="stylesheet" href="styles.css">
    <style>
      /* Add your custom CSS for styling */
          .invalid-user {
        color: red;
      }
    </style>
</head>
<body>
    <div class="registration-container">
        <h1>Register for an Account</h1>
        <p style="text-align:center" class="invalid-user">Username does not exist, please register.</p>
        <form action="register.php" method="POST">
            <div class="input-field">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button style="margin-inline:auto "type="submit">Register</button>
        </form>
    </div>
</body>
</html>
