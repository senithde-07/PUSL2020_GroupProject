<?php
include '../db_connection.php';
session_start();


if (!isset($_SESSION['email']) || $_SESSION['user_type'] != 'admin') {
    header('Location: login.php');
    exit();
}

?>



<?php
include '../db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];

    $stmt = $conn->prepare("INSERT INTO articles (title, content, author) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $content, $author);

    if ($stmt->execute()) {
        echo "New article created successfully.";
        header("Location: article.php"); // Redirect to the article list page
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
