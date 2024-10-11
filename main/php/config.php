<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cyber_resource";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: ". $conn->connect_error);
}

// Register user
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $cpassword = $_POST["cpassword"];
  $role = $_POST["role"];

  if (strlen($password) >= 8) { // Check password length
    if ($password == $cpassword) {
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      $sql = "INSERT INTO users (name, email, password, role) VALUES (?,?,?,?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);
      $stmt->execute();

      echo "User registered successfully!";
      // Redirect to LoginPage.html
      header("Location: ../html/LoginPage.html");
      exit();
    } else {
      echo "Passwords do not match!";
    }
  } else {
    echo "Password must be at least 8 characters long!";
  }
}

// User Login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];

  $sql = "SELECT * FROM users WHERE email=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
      // Password is correct, login successful
      // Store user name in session
      $_SESSION['username'] = $user['name'];
      $_SESSION['role'] = $user['role'];

      // Password is correct, login successful
      // Check user role and redirect accordingly
      if ($user['role'] == 'Company') {
        // Redirect to CompanyHomePage.html
        header("Location: ../html/CompanyHomePage.php");
        exit();
      } elseif ($user['role'] == 'Customer') {
        // Redirect to UserHomePage.html
        header("Location: ../html/UserHomePage.php");
        exit();
      }
    } else {
      // Password is incorrect
      echo "Invalid email or password!";
    }
  } else {
    // User with provided email not found
    echo "Invalid email or password!";
  }
}

$conn->close();
?>
