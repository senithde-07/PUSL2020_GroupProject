<?php
include 'db_connection.php';
session_start();


if (!isset($_SESSION['email']) || $_SESSION['user_type'] != 'user') {
    header('Location: login.php');
    exit();
}
$uid = "";
if (isset($_SESSION['email'])) {
    $uid = $_SESSION['member_id']; // You had $id here, but it should be $uid to store the member ID

} else {
    echo "You are not logged in. Please log in first.";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = rand(99999, 999999);

    $title = $_POST['title'];
    $description = $_POST['description'];
    $impact = $_POST['impact'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $importance = $_POST['importance'];

    $photo_paths = [];
    for ($i = 0; $i < count($_FILES['photo']['name']); $i++) {
        $tmp_name = $_FILES['photo']['tmp_name'][$i];
        $file_extension = pathinfo($_FILES['photo']['name'][$i], PATHINFO_EXTENSION);
        $target_dir = "images/";
        $new_file_name = $id . '_' . $i . '.' . $file_extension;
        $target_file = $target_dir . basename($new_file_name);

        if (move_uploaded_file($tmp_name, $target_file)) {
            $photo_paths[] = $target_file;
        }
    }
    $photo_path_string = implode(',', $photo_paths); // You had an empty string here, but it should be a comma to separate the file paths

    // You had an extra comma in the INSERT statement, and it should be 'member_id' instead of 'uid'
    $sql = "INSERT INTO Incidents (id, uid, title, description, impact, latitude, longitude, photo_path, importance)
    VALUES ('$id', '$uid', '$title', '$description', '$impact', '$latitude', '$longitude', '$photo_path_string', '$importance')";

    if (mysqli_query($conn, $sql)) {
        echo "New incident created successfully";
        header("Location: incident.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
