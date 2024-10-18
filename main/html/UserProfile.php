<?php
session_start();
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: ../html/LoginPage.html");
    exit();
}

$username = $_SESSION['username'];

// Database connection settings
$servername = "localhost"; // Replace with your server name
$db_username = "root"; // Replace with your database username
$db_password = ""; // Replace with your database password
$db_name = "cyber_resource"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user details
$sql = "SELECT name, email FROM users WHERE name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $email = $row['email'];
} else {
    $name = "Not available";
    $email = "Not available";
}

$stmt->close();
$conn->close();
?>

<html>
<head>
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid p-5 bg-primary text-white text-left pd">
        <h1>Cyber <span>Resource</span></h1>
        <p>We make hiring easy</p>
    </div>
    <div class="row col-8 border rounded mx-auto mt-5 p-2 shadow-lg">
        <div class="col-md-4 text-center mt-5">
            <img src="../../Image/default_profile.jpg" class="img-fluid rounded" alt="logo">
            <div>
                <a href="./UserProfileEdit.php"><button class="mx-auto m-1 btn-lg btn btn-primary">Update Profile</button></a>
            </div>
        </div>
        <div class="col-md-8">
            <div class="h2">User Profile</div>
            <table class="container-fluid table table-striped">
                <tr><th colspan="2">User Details:</th></tr>
                <tr><th><i class="fa fa-user-circle"></i> Name</th><td><?php echo htmlspecialchars($name); ?></td></tr>
                <tr><th><i class="fa fa-calendar"></i> Age</th><td>email.@email.com</td></tr>
                <tr><th><i class="fa fa-envelope"></i> Email</th><td><?php echo htmlspecialchars($email); ?></td></tr>
                <tr><th><i class="fa fa-transgender"></i> Gender</th><td>email.@email.com</td></tr>
                <tr><th><i class="fa fa-briefcase"></i> Profession</th><td>email.@email.com</td></tr>
                <tr><th><i class="fa fa-home"></i> Address</th><td>email.@email.com</td></tr>            
            </table>
        </div>
    </div>
    
</body>
</html>