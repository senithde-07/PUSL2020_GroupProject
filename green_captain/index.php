
<?php
include '../db_connection.php';
session_start();


if (!isset($_SESSION['email']) || $_SESSION['user_type'] != 'green_captain') {
    header('Location: login.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtthSN2Els6pPjf0czvfyOyGbMVe4RnjE"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        #map {
            height: 50%;
            width: 50%;
        }
    </style>
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

    <div class = "container">
    <h1>Green Captain Dashboard</h1>
    <div id="map" style="height: 600px; width: 100%;"></div>
    </div>

    <script>
  function getMarkerIcon(importance) {
    if (importance === "low") {
        return "https://maps.google.com/mapfiles/ms/icons/yellow-dot.png";
    } else {
        return "https://maps.google.com/mapfiles/ms/icons/red-dot.png";
    }
}

function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 12,
        center: { lat: 6.9271, lng: 79.8612 }, // Coordinates for Colombo
    });

    fetch("get_data.php")
        .then((response) => response.json())
        .then((incidents) => {
            incidents.forEach((incident) => {
                const position = {
                    lat: parseFloat(incident.latitude),
                    lng: parseFloat(incident.longitude),
                };
                const marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    icon: getMarkerIcon(incident.importance),
                });

                const contentString = `
                    <div>
                        <h4>Incident ${incident.id}</h4>
                        <img src="../${incident.photo_path}" alt="Incident Image" style="width: 200px;">
                        <p><strong>Description:</strong> ${incident.description}</p>
                        <p><strong>Status:</strong> ${incident.status}</p>
                    </div>
                    ${incident.photo_path}
                `;

                const infoWindow = new google.maps.InfoWindow({
                    content: contentString,
                });

                marker.addListener("click", () => {
                    infoWindow.open(map, marker);
                });
            });
        })
        .catch((error) => console.error("Error fetching incidents:", error));
}

initMap();

    </script>
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
