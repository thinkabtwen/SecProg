<?php
session_start();
require '../php/config.php';
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Customer') {
    header("Location: ../html/LoginPage.php");
    exit();
}

$username = htmlspecialchars($_SESSION['username']);
$sql = "SELECT username, job_title, location, job_description, job_type, salary, benefits FROM approved_job_listings";
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
                echo htmlspecialchars('No job listings available at the moment.');
            }
            
            $conn->close();
            ?>
            <a href="./UserHomePage.php">
            <label type="button" class="btn-lg btn-primary">Back</label>
            </a>
        </div>
    </div>
</div>

<footer class="container-fluid">
    <p>Cyber Resource</p>
</footer>

</body>
</html>
