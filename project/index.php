
<?php
// Include your database connection file here
include "db_connection.php";

$sql = "SELECT * FROM articles";
$result = $conn->query($sql);
$articles = $result->fetch_all(MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="css/login.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-image: linear-gradient(to right, #52c0d1, #222da8);">
  <div class="container">
    <a class="navbar-brand" href="#">CMC Garbage Collection</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navigation -->

<div class="container">
<div class="container">
        <h1>Articles</h1>
        <div class="row">
            <?php foreach ($articles as $article): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><?= $article['title'] ?></h5>
                            <p class="card-text"><?= $article['content'] ?></p>
                            <p class="card-text"><small class="text-muted">By <?= $article['author'] ?></small></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    </div>




</body>
<!-- Footer -->
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
<!-- End Footer -->

</html>