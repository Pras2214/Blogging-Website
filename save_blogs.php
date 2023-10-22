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

// Your code to save blogs should come after the database connection is established

// Your database connection code

// ... your code ...

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the username of the currently logged-in user
    session_start();

    // Check if the user is authenticated
    if (!isset($_SESSION['username'])) {
        // Redirect to the login page or display an error message
        header('Location: login.html');
        exit();
    }
    else if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    }

    // Your database connection code (already set up)

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the username of the currently logged-in user
        $username = $_SESSION['username'];

        // Extract blog input
        $title = $_POST['title'];
        $content = $_POST['content'];

        // Your database connection code (already set up)

        // Insert the blog data into the "blog_data" table
        $insert_query = "INSERT INTO blogs (username, title, content) VALUES ('$username', '$title', '$content')";

        if ($conn->query($insert_query) === TRUE) {
            // Blog data inserted successfully
            header('Location: blogs.php');
            exit();
        } else {
            // Handle the error
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    }
    
    // Close the database connection
    session_destroy(); 
    $conn->close();
}

?>
