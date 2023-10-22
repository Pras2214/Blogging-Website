<?php
// Establish a database connection (replace with your actual database credentials)
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "user_databse";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user data from the form
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
$email = $_POST['email'];

// SQL query to insert user data into the database
$sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "User data inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
