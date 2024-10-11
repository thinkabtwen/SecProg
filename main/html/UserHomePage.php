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
<head>
    <title>Home Page</title>
    <link rel="stylesheet" href="../css/UserHomePageStyle.css"> <!-- UserHomePageStyle.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <section class="container">
        <div class="center">
            <h1>Welcome back, <?php echo $username; ?>!</h1>
        </div>

        <div class="container-content">
            <div class="box">
                <a href="./UserCompanySearch.html">
                    <img src="../../Image/officebuildingicons.png">
                </a>
                <h3>Company Profile</h3>
                <h5>View Company Information</h5>
            </div>
            

            <div class="box">
                <a href="./UserCompanyJobs.html">
                    <img src="../../Image/glass.png">
                </a>
                <h3>Search Company</h3>
                <h5>Find your dream jobs</h5>
            </div>
            

            <div class="box">
                <a href="./UserProfile.html">
                    <img src="../../Image/profile.png">
                </a>
                <h3>You Profile</h3>
                <h5>View and edit your personal profile</h5>
            </div>
            
        </div>
    </section>
</body>
</html>