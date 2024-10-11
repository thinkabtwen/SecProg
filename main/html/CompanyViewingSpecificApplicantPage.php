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
  <title>View Specific Applicant Profile</title>
  <link rel="stylesheet" href="../css/CompanyViewingSpecificApplicantPageStyle.css"> </head>
<body>
  <header class="header">
    <img src="../../Image/logo.png" alt="Website Logo">
    <h1>CYBER <br> RESOURCE</h1>
  </header>
  <div class="profile">
    <img src="../../Image/default_profile.jpg" alt="Profile Picture">
    <div>
      <h2>nama</h2>
      <p>current/previous occupation (years in it)</p>
    </div>
  </div>
  <nav class="nav">
    <button class="active">Skills</button>
    <button>Attachments</button>
    <button>Certifications</button>
    <button>Personal Data</button>
  </nav>
  <div class="content">
    <h2>Skills</h2>
    <h3>Soft Skills:</h3>
    <li>Communication</li>
    <li>Teamwork</li>
    <li>Problem-Solving</li>
    <h3>Hard Skills:</h3>
    <li>JavaScript</li>
    <li>Python</li>
    <li>Java</li>
  </div>
  <a href="./CompanyViewingApplicantPage.php">
    <label type="button" class="btn-lg btn-primary">Back</label>
  </a>
  <script>
    const navButtons = document.querySelectorAll('.nav button');
    const contentDiv = document.querySelector('.content');
    navButtons.forEach(button => {
      button.addEventListener('click', () => {
        navButtons.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');
        if (button.textContent === 'Skills') {
          contentDiv.innerHTML = `
            <h2>Skills</h2>
            <h3>Soft Skills:</h3>
            <li>Communication</li>
            <li>Teamwork</li>
            <li>Problem-Solving</li>
            <h3>Hard Skills:</h3>
            <li>JavaScript</li>
            <li>Python</li>
            <li>Java</li>
          `;
        } else if (button.textContent === 'Attachments') {
          contentDiv.innerHTML = `
            <h2>Attachments</h2>
            <p>contoh</p>
          `;
        } else if (button.textContent === 'Certifications') {
          contentDiv.innerHTML = `
            <h2>Certifications</h2>
            <p>contoh</p>
          `;
        } else if (button.textContent === 'Personal Data') {
          contentDiv.innerHTML = `
            <h2>Personal Data</h2>
            <p>contoh</p>
          `;
        }
      });
    });
  </script>
</body>
</html>
