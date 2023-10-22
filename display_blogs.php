<?php
// Your database connection code
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "user_databse";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the 10 most recent blogs from the "blog_data" table
$select_query = "SELECT username, title, content FROM blogs ORDER BY id DESC LIMIT 10";

$result = mysqli_query($conn, $select_query);

if ($result) {
    echo "<h2>Recent Blogs</h2>";

    while ($row = mysqli_fetch_assoc($result)) {
        // Display each blog entry dynamically in HTML
        echo "<div class='blog-entry'>";
        echo "<h3 class='blog-title'>" . $row['title'] . "</h3>";
        echo "<p class='blog-content'>" . $row['content'] . "</p>";
        echo "<p class='blog-author'>Author: " . $row['username'] . "</p>"; // Display the author's name
        echo "</div>";
    }
}
?>

