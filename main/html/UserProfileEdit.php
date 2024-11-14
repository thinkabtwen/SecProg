<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Customer') {
    header("Location: ../html/LoginPage.html");
    exit();
}

$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "cyber_resource";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$current_username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $current_username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    echo "User not found!";
    exit();
}

$user = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Edit Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            margin-top: 50px;
        }
        .btn-lg {
            padding: 10px 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid p-5 bg-primary text-white text-left">
        <h1>Cyber <span>Resource</span></h1>
        <p>We make hiring easy</p>
    </div>
    <div class="row col-8 border rounded mx-auto mt-5 p-2 shadow-lg form-container">
        <div class="col-md-4 text-center mt-5">

        
            <?php
            $profile_image = $user['profile_image'];
            $profile_image_path = "../../Image/default_profile.jpg"; 
            if (!empty($profile_image) && file_exists($profile_image)) {
                $profile_image_path = $profile_image; 
            }
            $profile_image = !empty($user['profile_image']) ? htmlspecialchars($profile_image_path) : '../../Image/default_profile.jpg';
            ?>
            <img src="<?php echo $profile_image; ?>" class="js-image img-fluid rounded" alt="Profile Image">
            <form action="../php/config.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="form_type" value="customer_profile">
            <div class="text-left mt-3">
                <label for="formFileLg" class="form-label">Change Profile Image</label>
                <input onchange="display_image(this.files[0])" class="form-control form-control-lg" id="formFileLg" type="file" accept="image/jpg, image/jpeg, image/png" name="profile_image">
            </div>
        </div>
        <div class="col-md-8">
            <div class="h2">Edit Profile</div>
    
                <input type="hidden" name="edit_profile" value="1">
                <table class="container-fluid table table-striped">
                    <tr><th colspan="2">User Details:</th></tr>
                    <tr>
                        <th><i class="fa fa-user-circle"></i> Name</th>
                        <td><input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo htmlspecialchars($user['name']); ?>" required></td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-lock"></i> Password</th>
                        <td><input type="password" class="form-control" name="password" placeholder="New Password (leave blank to keep current)" minlength="8"></td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-lock"></i> Confirm Password</th>
                        <td><input type="password" class="form-control" name="confirm_password" placeholder="Confirm New Password" minlength="8"></td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-calendar"></i> Age</th>
                        <td><input type="number" class="form-control" name="age" placeholder="Age" value="<?php echo htmlspecialchars($user['age']); ?>"></td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-envelope"></i> Email</th>
                        <td><input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo htmlspecialchars($user['email']); ?>" required></td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-transgender"></i> Gender</th>
                        <td>
                            <select class="form-select form-select-lg mb-3" name="gender" aria-label="Gender select" required>
                                <option value="" disabled>Select Gender</option>
                                <option value="Male" <?php if($user['gender'] === 'Male') echo 'selected'; ?>>Male</option>
                                <option value="Female" <?php if($user['gender'] === 'Female') echo 'selected'; ?>>Female</option>
                                <option value="Other" <?php if($user['gender'] === 'Other') echo 'selected'; ?>>Other</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-briefcase"></i> Profession</th>
                        <td><input type="text" class="form-control" name="profession" placeholder="Profession" value="<?php echo htmlspecialchars($user['profession']); ?>"></td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-home"></i> Address</th>
                        <td><input type="text" class="form-control" name="address" placeholder="Address" value="<?php echo htmlspecialchars($user['address']); ?>"></td>
                    </tr> 
                </table>
                <div class="p-2">
                    <a href="./UserProfile.php" class="btn btn-lg btn-secondary">Back</a>
                    <button type="submit" class="btn btn-lg btn-primary float-end">Save</button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        function display_image(file) {
            var img = document.querySelector(".js-image");
            img.src = URL.createObjectURL(file);
        }
    </script>
</body>
</html>