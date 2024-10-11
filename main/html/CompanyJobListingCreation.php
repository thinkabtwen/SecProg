<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: ../html/LoginPage.html");
  exit();
}

$username = $_SESSION['username'];

// Initialize variables for error/success messages
$success_message = $error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs to prevent XSS
    $jobTitle = htmlspecialchars(trim($_POST['jobTitle']), ENT_QUOTES, 'UTF-8');
    $location = htmlspecialchars(trim($_POST['location']), ENT_QUOTES, 'UTF-8');
    $jobDescription = htmlspecialchars(trim($_POST['jobDescription']), ENT_QUOTES, 'UTF-8');
    $jobType = htmlspecialchars(trim($_POST['jobType']), ENT_QUOTES, 'UTF-8');
    $salary = htmlspecialchars(trim($_POST['salary']), ENT_QUOTES, 'UTF-8');
    $benefits = htmlspecialchars(trim($_POST['benefits']), ENT_QUOTES, 'UTF-8');

    // Server-side validation
    if (empty($jobTitle) || empty($jobDescription) || empty($jobType)) {
        $error_message = "Please fill in all required fields.";
    } else {
        // Database connection details
        $servername = "localhost";   
        $db_username = "root";       
        $db_password = "";           
        $dbname = "cyber_resource";  

        // Create connection
        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO job_listings (username, job_title, location, job_description, job_type, salary, benefits) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $username, $jobTitle, $location, $jobDescription, $jobType, $salary, $benefits);

        // Execute the query
        if ($stmt->execute()) {
            $success_message = "Job listing created successfully!";
        } else {
            $error_message = "Error: " . htmlspecialchars($stmt->error, ENT_QUOTES, 'UTF-8');
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
}
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

      <!-- Display success or error message with proper escaping -->
      <?php if (!empty($success_message)): ?>
        <p style="color:green;"><?php echo htmlspecialchars($success_message, ENT_QUOTES, 'UTF-8'); ?></p>
      <?php elseif (!empty($error_message)): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8'); ?></p>
      <?php endif; ?>

      <form action="" method="POST">
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
          <select name="jobType" required>
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
  </div>
</body>
</html>
