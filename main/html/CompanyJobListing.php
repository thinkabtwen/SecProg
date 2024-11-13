<?php
session_start();
require '../php/config.php';
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Company') {
  // Redirect to login page if not logged in
  header("Location: ../html/LoginPage.html");
  exit();
}

$username = $_SESSION['username'];


// Prepare the SQL query to get job listings for the logged-in user
$sql = "SELECT id, job_title, location, job_description, job_type, salary, benefits FROM job_listings WHERE username = ?";
$stmt = $conn->prepare($sql);

// Check if the statement preparation was successful
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

// Bind the username parameter and execute the query
$stmt->bind_param("s", $username);
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

// Get the result
$result = $stmt->get_result();

// Close the statement and connection after execution
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Company Job Listing</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/CompanyJobListingStyle.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">
      <div class="container-fluid p-5 bg-primary text-white text-left pd">
        <h1>Cyber <span>Resource</span></h1>
        <p>We make hiring easy</p>
      </div>
      <hr>
      <ul class="nav nav-pills nav-stacked">
        <li><a href="./CompanyJobListingCreation.php">Create Listings</a></li>
        <li class="active"><a href="./CompanyJobListing.php">Your Listings</a></li>
        <li><a href="./CompanyApprovedJobListing.php">Approved Listings</a></li>
        <li><a href="./CompanyViewingApplicantPage.php">View Applicant</a></li>
      </ul><br>
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search Your Listings..">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div>
    </div>

    <div class="col-sm-9">
      <h2>Your Job Listings</h2>

      <?php
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo '<h2>' . htmlspecialchars($row["job_title"], ENT_QUOTES, 'UTF-8') . '</h2>';
              echo '<h5><span class="glyphicon glyphicon-time"></span> ' . htmlspecialchars($row["job_type"], ENT_QUOTES, 'UTF-8') . '</h5>';
              echo '<p>Location: ' . htmlspecialchars($row["location"], ENT_QUOTES, 'UTF-8') . '</p>';
              echo '<p>Jangkauan Gaji: ' . htmlspecialchars($row["salary"], ENT_QUOTES, 'UTF-8') . '</p>';
              echo '<p>Benefits: ' . htmlspecialchars($row["benefits"], ENT_QUOTES, 'UTF-8') . '</p>';

             // Delete button form
              echo '<form method="POST" action="../php/config.php" style="display:inline;">';
              echo '<input type="hidden" name="jobs_id" value="' . htmlspecialchars($row["id"], ENT_QUOTES, 'UTF-8') . '">';
              echo '<button type="submit" name="delete-from-company" class="btn btn-danger">Delete</button>';
              echo '</form>';

              echo '<hr><br>';
          }
      } else {
          echo "<p>No job listings found.</p>";
      }
      ?>
      
      <a href="./CompanyHomePage.php">
        <label type="button" class="btn-lg btn-primary">Back</label>
      </a>
    </div>
  </div>
</div>
</body>
</html>
