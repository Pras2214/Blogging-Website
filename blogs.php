<!-- <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blogs</title>
    <link rel="stylesheet" href="styles2.css" />
  </head>
  <body>
    <header>
      <h1>Blog Page</h1>
    </header>

    <main>
      <section id="blog-form">
        <h2>Create a New Blog</h2>
        <form action="save_blogs.php" method="POST">
          <label for="title">Title:</label>
          <input type="text" id="title" name="title" required />

          <label for="content">Content:</label>
          <textarea id="content" name="content" rows="5" required></textarea>

          <button type="submit">Submit Blog</button>
        </form>
      </section>

      <section id="blog-list">
        <?php include('display_blogs.php'); ?>
      </section>
    </main>
  </body>
</html> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs</title>
    <link rel="stylesheet" href="styles2.css">
</head>
<body>
    <header>
        <div>
            <h1>Blog Page</h1>
        </div>
        <div>
            <?php
            session_start();
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
                echo '<p>Welcome, ' . $username . '</p>';
                echo '<a href="logout.php">Logout</a>';
            }
            ?>
        </div>
    </header>

    <main>
        <section id="blog-form">
            <h2>Create a New Blog</h2>
            <form action="save_blogs.php" method="POST">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required />

                <label for="content">Content:</label>
                <textarea id="content" name="content" rows="5" required></textarea>

                <button type="submit">Submit Blog</button>
            </form>
        </section>

        <section id="blog-list">
            <?php include('display_blogs.php'); ?>
        </section>
    </main>
</body>
</html>
