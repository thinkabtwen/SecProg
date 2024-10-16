<?php
session_start();
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: ../html/LoginPage.html");
    exit();
}

$username = $_SESSION['username'];

// Database connection details
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "cyber_resource";

// Create a connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all job listings from the database
$sql = "SELECT username, job_title, location, job_description, job_type, salary, benefits FROM job_listings";
$result = $conn->query($sql);
?>

<html>
<html lang="en">
<head>
  <title>User Company Jobs</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/UserCompanyJobs.css">
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
                <li><a href="./UserCompanySearch.php">Company</a></li>
                <li class="active"><a href="./UserCompanyJobs.php">Jobs</a></li>
            </ul><br>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search Job Listings...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </div>

        <div class="col-sm-9">
            <h4><small>Job Listings from All Companies</small></h4>
            <hr>

            <?php
            if ($result->num_rows > 0) {
                // Output each job listing
                while ($row = $result->fetch_assoc()) {
                  echo '<h2>' . htmlspecialchars($row["job_title"], ENT_QUOTES, 'UTF-8') . '</h2>';
                  echo '<h5><span class="label label-primary">' . htmlspecialchars($row["job_type"], ENT_QUOTES, 'UTF-8') . '</span></h5><br>';
                  echo '<p>Company: ' . htmlspecialchars($row["username"], ENT_QUOTES, 'UTF-8') . '</p>'; 
                  echo '<p>Location: ' . htmlspecialchars($row["location"], ENT_QUOTES, 'UTF-8') . '</p>';
                  echo '<p>Description: ' . htmlspecialchars($row["job_description"], ENT_QUOTES, 'UTF-8') . '</p>';
                  echo '<p>Salary Range: ' . htmlspecialchars($row["salary"], ENT_QUOTES, 'UTF-8') . '</p>';
                  echo '<p>Benefits: ' . htmlspecialchars($row["benefits"], ENT_QUOTES, 'UTF-8') . '</p>';
                  echo '<hr>';
              }
            } else {
                echo '<p>No job listings available at the moment.</p>';
            }

            // Close the connection
            $conn->close();
            ?>
        </div>
    </div>
</div>

<footer class="container-fluid">
    <p>Cyber Resource</p>
</footer>

</body>
</html>
