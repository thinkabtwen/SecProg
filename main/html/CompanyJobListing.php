<?php
session_start();
if (!isset($_SESSION['username'])) {
  // Redirect to login page if not logged in
  header("Location: ../html/LoginPage.html");
  exit();
}

$username = $_SESSION['username'];
?>

<html>
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
        <li><a href="./CompanyJobListingCreation.html">Create Listings</a></li>
        <li class="active"><a href="./CompanyJobListing.html">Your Listings</a></li>
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
      <h2>Security Analyst</h2>
      <h5><span class="glyphicon glyphicon-time"></span> Created on Sep 27, 2015.</h5>
      <h5><span class="glyphicon glyphicon-time"></span> Full Time</h5>
      <p>Jangkauan Gaji:</p>
      <p>Benefits:</p>
      <h5><span class="label label-success">Tier 2</span></h5><br>
      <p></p>
      <br><br>
      <h2>Security Specialist</h2>
      <h5><span class="glyphicon glyphicon-time"></span> Created on Sep 27, 2015.</h5>
      <h5><span class="glyphicon glyphicon-time"></span> Full Time</h5>
      <p>Jangkauan Gaji:</p>
      <p>Benefits:</p>
      <h5><span class="label label-success">Tier 2</span></h5><br>
      <p></p>
      <br><br>
      <h2>Security Architect</h2>
      <h5><span class="glyphicon glyphicon-time"></span> Created on Sep 27, 2015.</h5>
      <h5><span class="glyphicon glyphicon-time"></span> Full Time</h5>
      <p>Jangkauan Gaji:</p>
      <p>Benefits:</p>
      <h5><span class="label label-success">Tier 4</span></h5><br>
      <p></p>
      <br><br>
      <h2>Cloud Security Specialist</h2>
      <h5><span class="glyphicon glyphicon-time"></span> Created on Sep 27, 2015.</h5>
      <h5><span class="glyphicon glyphicon-time"></span> Full Time</h5>
      <p>Jangkauan Gaji:</p>
      <p>Benefits:</p>
      <h5><span class="label label-success">Tier 2</span></h5><br>
      <p></p>
      <br><br>
      <h2>Chief Information Security Officer</h2>
      <h5><span class="glyphicon glyphicon-time"></span> Created on Sep 24, 2015.</h5>
      <h5><span class="glyphicon glyphicon-time"></span> Full Time</h5>
      <p>Jangkauan Gaji:</p>
      <p>Benefits:</p>
      <h5><span class="label label-success">Tier 3</span></h5><br>
      <p></p>
      <hr>
      <a href="./CompanyHomePage.php">
        <label type="button" class="btn-lg btn-primary">Back</label>
      </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
