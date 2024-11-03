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
  die("Connection failed: " . $conn->connect_error);
}

// Register user
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
  $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $password = ($_POST["password"]);
  $cpassword = ($_POST["cpassword"]);
  $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);

  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $emailErr = "Invalid email format";
  }

  // Check if the username is already taken
  $sql = "SELECT * FROM users WHERE name=? OR email=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $name, $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    // Username is already taken
    echo "Username or email is already taken!";
  } else {
    if (strlen($password) >= 8) { // Check password length
      if ($password == $cpassword) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password, role) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);
        $stmt->execute();
        
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
}

// User Login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $password = ($_POST["password"]);

  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $emailErr = "Invalid email format";
  }

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
      echo "Invalid email or password!";
  }
}

$conn->close();
?>