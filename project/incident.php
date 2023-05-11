<?php
include 'db_connection.php';
session_start();


if (!isset($_SESSION['email']) || $_SESSION['user_type'] != 'user') {
    header('Location: login.php');
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Incident</title>
    <link href="css/login.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0-beta1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-pzjw8f+ua7Kw1TIq0v8FqFjcJ6pajs/rfdfs3SO+kD4Ck5BdPtF+to8xMp9Q9lm7" crossorigin="anonymous">

    <!-- Google Maps JavaScript API -->
    <script>
        let map;
        let marker;

        function initMap() {
            const defaultCenter = {lat: 6.927079, lng: 79.861244}; // Colombo, Sri Lanka

            map = new google.maps.Map(document.getElementById('map'), {
                center: defaultCenter,
                zoom: 13
            });

            marker = new google.maps.Marker({
                position: defaultCenter,
                map: map,
                draggable: true
            });

            google.maps.event.addListener(marker, 'dragend', function (event) {
                document.getElementById('latitude').value = event.latLng.lat();
                document.getElementById('longitude').value = event.latLng.lng();
            });
        }
    </script>

    <title>Create Incident</title>
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
          <a class="nav-link" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="incident.php">Create Incident</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- Your Navigation Bar here -->

<div class="container mt-5">
    <h2 class="text-center mb-4">Create Incident</h2>
    <form action="incident_process.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="impact" class="form-label">Impact</label>
        <textarea class="form-control" id="impact" name="impact" rows="2" required></textarea>
    </div>
    <div class="mb-3">
                <label for="importance" class="form-label">Importance</label>
                <select class="form-select" id="importance"  name = "importance">
                    <option selected>Choose...</option>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
    <div class="mb-3">
        <label for="map" class="form-label">Location</label>
        <div id="map" style="height: 300px;"></div>
        <input type="hidden" id="latitude" name="latitude">
        <input type="hidden" id="longitude" name="longitude">
    </div>
    <div class="mb-3">
        <label for="photo" class="form-label">Upload Photo(s)</label>
        <input class="form-control" type="file" id="photo" name="photo[]" multiple>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


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
<!-- End Footer -->

</html>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtthSN2Els6pPjf0czvfyOyGbMVe4RnjE&callback=initMap" async defer></script>

