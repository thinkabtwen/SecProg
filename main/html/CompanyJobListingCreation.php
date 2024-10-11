<?php
session_start();
if (!isset($_SESSION['username'])) {
  // Redirect to login page if not logged in
  header("Location: ../html/LoginPage.html");
  exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Company Job Listing Creation</title>
  <link rel="stylesheet" href="../css/CompanyJobListingCreationStyle.css">
</head>
<body>
    <div class="container">
        <header class="header">
          <img src="../../Image/logo.png" alt="Website Logo">
          <h4>CYBER <br> RESOURCE</h4>
        </header>
  <main class="main">
    <h2>Create Job Listing</h2>
    <form action="#">
      <div class="form-group">
        <label for="job-title">Nama Pekerjaan:</label>
        <input type="text" id="job-title" name="jobTitle" required>
      </div>
      <div class="form-group">
        <label for="location">Alamat:</label>
        <input type="text" id="location" name="location">
      </div>
      <div class="form-group">
        <label for="job-description">Short Description:</label>
        <textarea id="job-description" name="jobDescription" rows="10" required></textarea>
      </div>
      <div class="form-group">
        <label for="job-type">Job Type:</label>
        <select name="jobType">
          <option value="">Select Job Type</option>
          <option value="full-time">Full Time</option>
          <option value="part-time">Part Time</option>
          <option value="contract">Contract</option>
          <option value="freelance">Freelance</option>
        </select>
      </div>
      <div class="form-group">
        <label for="salary">Jangkauan Gaji*:</label>
        <input type="text" id="salary" name="salary">
      </div>
      <div class="form-group">
        <label for="benefits">Benefit*:</label>
        <textarea id="benefits" name="benefits" rows="5"></textarea>
      </div>
      <button type="submit">Create Job Listing</button>
    </form>
    <a href="./CompanyJobListing.html">
      <label type="button" class="btn-lg btn-primary">Back</label>
    </a>
  </main>
</body>
</html>
