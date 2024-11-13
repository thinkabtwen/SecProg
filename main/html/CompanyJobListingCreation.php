<?php
session_start();
require '../php/config.php';
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Company') {
  // Redirect to login page if not logged in
  header("Location: ../html/LoginPage.html");
  exit();
}

$username = htmlspecialchars($_SESSION['username']);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs to prevent XSS
    $jobTitle = filter_input(INPUT_POST, 'jobTitle', FILTER_SANITIZE_STRING);
    $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);
    $jobDescription = filter_input(INPUT_POST, 'jobDescription', FILTER_SANITIZE_STRING);
    $jobType = filter_input(INPUT_POST, 'jobType', FILTER_SANITIZE_STRING);
    $salary = filter_input(INPUT_POST, 'salary', FILTER_SANITIZE_NUMBER_INT);
    $benefits = filter_input(INPUT_POST, 'benefits', FILTER_SANITIZE_STRING);

    // Server-side validation
    if (empty($jobTitle) || empty($jobDescription) || empty($jobType)) {
        echo "Please fill in all required fields.";
    } else if(!preg_match("/^[a-zA-Z ]*$/", $jobTitle)){
      echo "Job title can only contain alphabet characters";
    } else if(!preg_match("/^[a-zA-Z0-9.\/ ]*$/", $location)){
      echo "Location can only contain alphanumeric characters";
    } else if(!preg_match("/^[a-zA-Z0-9 ]*$/", $jobDescription)){
      echo "Job description can only contain alphanumeric characters";
    }else if(!preg_match("/^[a-zA-Z-]*$/", $jobType)){
      echo "Job type can only contain alphabet characters";
    }else if(!preg_match("/^[0-9.,]*$/", $salary)){
      echo "Salary can only contain numeric characters";
    }else if (!preg_match("/^[a-zA-Z0-9. ]*$/", $benefits)){
      echo "Job benefits can only contain alphanumeric characters";
    }else {
        // Prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO job_listings (username, job_title, location, job_description, job_type, salary, benefits) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $username, $jobTitle, $location, $jobDescription, $jobType, $salary, $benefits);

        // Execute the query
        if ($stmt->execute()) {
            echo "Job listing created successfully!";
        } else {
            echo "Error create new job listings";
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
          <input type="number" id="salary" name="salary">
        </div>
        <div class="form-group">
          <label for="benefits">Benefit*:</label>
          <textarea id="benefits" name="benefits" rows="5"></textarea>
        </div>
        <button type="submit">Create Job Listing</button>
      </form>

      <a href="./CompanyJobListing.php">
        <label type="button" class="btn-lg btn-primary">Back</label>
      </a>
    </main>
  </div>
</body>
</html>
