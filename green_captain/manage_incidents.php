<?php
include '../db_connection.php';
session_start();


if (!isset($_SESSION['email']) || $_SESSION['user_type'] != 'green_captain') {
    header('Location: login.php');
    exit();
}

?>


<?php
// Include your database connection file here
include "../db_connection.php";

$sql = "SELECT * FROM incidents";
$result = $conn->query($sql);
$incidents = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Incidents</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
          <a class="nav-link" href="index.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="manage_incidents.php">Manage Incidents</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <!-- Your existing navigation code -->

    <div class="container">
        <h1>Manage Incidents</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($incidents as $incident): ?>
                    <tr>
                        <td><?= $incident['id'] ?></td>
                        <td><img src="../<?= $incident['photo_path'] ?>" alt="Incident Image" style="width: 100px;"></td>
                        <td><?= $incident['description'] ?></td>
                        <td>
                            <form action="update_status.php" method="post">
                                <input type="hidden" name="id" value="<?= $incident['id'] ?>">
                                <select name="status" onchange="this.form.submit()">
                                    <option value="reported" <?= $incident['status'] === 'reported' ? 'selected' : '' ?>>Reported</option>
                                    <option value="approved" <?= $incident['status'] === 'approved' ? 'selected' : '' ?>>Approved</option>
                                    <option value="rejected" <?= $incident['status'] === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                                </select>
                            </form>
                        </td>
                        <td><a href="delete_incident.php?id=<?= $incident['id'] ?>" class="btn btn-danger">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <footer class="bg-primary text-white" id = "footer">
  <div class="container py-4">
    <div class="row">
      <div class="col-md-4">
        <h4>About CMC Garbage Collection</h4>
        <p>
          CMC Garbage Collection is a platform dedicated to optimizing garbage collection in the district, by allowing members of the Green Task Force to report incidents and enabling efficient management of the process.
        </p>
      </div>
      <div class="col-md-4">
        <h4>Useful Links</h4>
        <ul class="list-unstyled">
          <li><a href="#" class="text-white">Map</a></li>
          <li><a href="#" class="text-white">Report Incident</a></li>
          <li><a href="#" class="text-white">Incident Management</a></li>
          <li><a href="#" class="text-white">Public Awareness</a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <h4>Contact Us</h4>
        <p>
          <strong>Address:</strong> 123 Main Street, Colombo, Sri Lanka<br>
          <strong>Phone:</strong> +94 11 2345678<br>
          <strong>Email:</strong> info@cmcgarbagecollection.com
        </p>
      </div>
    </div>
  </div>
  <div class="text-center py-3" style="background-color: rgba(0, 0, 0, 0.1);">
    <p class="mb-0">&copy; 2023 CMC Garbage Collection. All rights reserved.</p>
  </div>
</footer>
</body>
</html>
