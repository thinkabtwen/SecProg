<?php
session_start();
if (!isset($_SESSION['username'])) {
  // Redirect to login page if not logged in
  header("Location: ../html/LoginPage.html");
  exit();
}

$username = htmlspecialchars($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Applicant Page</title>
  <link rel="stylesheet" href="../css/CompanyViewingApplicantPageStyle.css">
</head>
<body>
  <div class="container">
    <header class="header">
      <img src="../../Image/logo.png" alt="Website Logo">
      <h4>CYBER <br> RESOURCE</h4>
    </header>
    <div class="content">
      <div class="sidebar">
        <h2>Search Applicants</h2>
        <input type="text" placeholder="Search Name">
        <select name="category">
          <option value="">Applicant Category</option>
          <option value="developer">Developer</option>
          <option value="designer">Designer</option>
          <option value="manager">Manager</option>
        </select>
        <input type="number" placeholder="Sort Salary (Low to High)">
        <input type="number" placeholder="Min Years of Experience">
      </div>
      <div class="applicant-list">
        <div class="applicant">
          <div class="applicant-info">
            <h3>Applicant #1</h3>
            <a href="./CompanyViewingSpecificApplicantPage.php">
              <img src="../../Image/default_profile.jpg" alt="Applicant Profile">
            </a>
            <p>Applicant Type: Full-Time</p>
            <p>Name: John Doe</p>
            <p>Address:</p>
            <p>Contact Information:</p>
            <p>Area of Expertise:</p>
            <p>Soft Skills:</p>
            <p>Miscellaneous:</p>
            <br>
            <h3>Applicant #2</h3>
            <a href="./CompanyViewingSpecificApplicantPage.php">
              <img src="../../Image/default_profile.jpg" alt="Applicant Profile">
            </a>
            <p>Applicant Type:</p>
            <p>Name:</p>
            <p>Address:</p>
            <p>Contact Information:</p>
            <p>Area of Expertise:</p>
            <p>Soft Skills:</p>
            <p>Miscellaneous:</p>
          </div>
        </div>
        <a href="./CompanyHomePage.php">
          <label type="button" class="btn-lg btn-primary">Back</label>
        </a>
      </div>
    </div>
  </div>
</body>
</html>
