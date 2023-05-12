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
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    // Check if the email already exists in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error_message = "An account with this email already exists.";
    } else {
        // Insert the new user into the database
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, user_type) VALUES (?, ?, ?, ?)");
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("ssss", $name, $email, $hashed_password, $user_type);

        if ($stmt->execute()) {
            header('Location: index.php');

            $success_message = "User account created successfully.";
        } else {
            $error_message = "Error creating user account: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
}
?>
