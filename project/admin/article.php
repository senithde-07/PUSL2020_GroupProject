<?php
include '../db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];

    // Insert the new article into the database
    $stmt = $conn->prepare("INSERT INTO articles (title, content, author) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $content, $author);

    if ($stmt->execute()) {
        $success_message = "Article created successfully.";
    } else {
        $error_message = "Error creating article: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Article</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-image: linear-gradient(to right, #52c0d1, #222da8);">
  <div class="container">
    <a class="navbar-brand" href="#">CMC Garbage Collection</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Create account</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="article.php">Create article</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <h1>Create Article</h1>
    <?php if (isset($success_message)) { ?>
        <p style="color: green;"><?php echo $success_message; ?></p>
    <?php } elseif (isset($error_message)) { ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php } ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<form action="create_article.php" method="post" class="container mt-5">
    <div class="mb-3">
        <label for="title" class="form-label">Title:</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Content:</label>
        <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
    </div>
    <div class="mb-3">
        <label for="author" class="form-label">Author:</label>
        <input type="text" class="form-control" id="author" name="author" required>
    </div>
    <button type="submit" class="btn btn-primary">Create Article</button>
</form>

</body>
</html>
