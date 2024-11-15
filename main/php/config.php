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
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (preg_match("/^[a-zA-Z0-9]*$/", $name)) {
            if (strlen($password) >= 8) {
                if ($password == $cpassword) {
                    // Check if the username or email is already taken
                    $sql = "SELECT * FROM users WHERE name=? OR email=?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ss", $name, $email);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows == 1) {
                        echo "Username or email is already taken!";
                    } else {
                        // Insert new user
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        $sql = "INSERT INTO users (name, email, password, role) VALUES (?,?,?,?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);
                        $stmt->execute();

                        //  Profile Picture
                        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
                            $file_tmp_path = $_FILES['profile_image']['tmp_name'];
                            $fileName = basename($_FILES['profile_image']['name']);
                            $file_size = $_FILES['profile_image']['size'];
                            $file_type = mime_content_type($file_tmp_path);
                        
                            $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png'];
                        
                            if (!in_array($file_type, $allowedTypes)) {
                                $errors[] = "Only JPG, PNG, and JPEG files are allowed for profile images.";
                            }
                        
                            if ($file_size > 2 * 1024 * 1024) {
                                $errors[] = "Profile image size must be less than 2MB.";
                            }
                        
                            if (empty($errors)) {
                                $upload_dir = '../uploads/';
                                $new_file_name = uniqid('profile_', true) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
                                $dest_path = $upload_dir . $new_file_name;
                        
                                if (!is_dir($upload_dir)) {
                                    mkdir($upload_dir, 0755, true);
                                }
                        
                                if (move_uploaded_file($file_tmp_path, $dest_path)) {
                                    $uploaded_image_url = $upload_dir . $new_file_name;
                                    $sql = "UPDATE users SET profile_image = ? WHERE email = ?";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("ss", $uploaded_image_url, $email);  // Assuming $email is available
                                    $stmt->execute();
                                    
                                } else {
                                    $errors[] = "There was an error uploading the profile image.";
                                }
                            }
                        
                            if (!empty($errors)) {
                                foreach ($errors as $error) {
                                    echo $error . "<br>";
                                }
                            }
                        } else {
                            echo "No file uploaded or there was an error with the upload.";
                        }                        
                        //  End of Profile Picture

                        // Redirect to LoginPage.html
                        header("Location: ../html/LoginPage.html");
                        exit();
                    }
                } else {
                    echo "Passwords do not match!";
                }
            } else {
                echo "Password must be at least 8 characters long!";
            }
        } else {
            echo "Username can only contain alphanumeric characters.";
        }
    } else {
        echo "Invalid email format.";
    }
}

// User Login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
                    header("Location: ../html/CompanyHomePage.php");
                    exit();
                } else if ($user['role'] == 'Customer') {
                    header("Location: ../html/UserHomePage.php");
                    exit();
                } else if($user['role'] == 'admin'){
                    header("Location: ../html/adminpanel.php");
                }
            } else {
                echo "Invalid email or password!";
            }
        } else {
            echo "Invalid email or password!";
        }
    } else {
        echo "Invalid email format.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])){
    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    session_destroy();
    header("Location: ../html/LoginPage.html");
}
function deleteJobListing($conn, $job_id) {
    $sql = "DELETE FROM job_listings WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $job_id);
        $stmt->execute();
        $stmt->close();
        return true;
    }
    return false;
}

function companyDeleteJobListing($conn, $jobs_id) {
    $sql = "DELETE FROM job_listings WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $jobs_id);
        $stmt->execute();
        $stmt->close();
        return true;
    }
    return false;
}

function deleteUsers($conn, $user_id){
    $sql = "DELETE FROM users WHERE id = ? AND role = 'Customer'";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->close();
        return true;
    }
    return false;
}

function deleteCompany($conn, $company_id){
    $sql = "DELETE FROM users WHERE id = ? AND role = 'Company'";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $company_id);
        $stmt->execute();
        $stmt->close();
        return true;
    }
    return false;
}

function approveJobListing($conn, $job_id) {
    $sql = "SELECT * FROM job_listings WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $job_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $job = $result->fetch_assoc();

            // Insert the job into `approved_job_listings` table
            $sql_insert = "INSERT INTO approved_job_listings (id, username, job_title, location, job_description, job_type, salary, benefits) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            if ($stmt_insert) {
                $stmt_insert->bind_param("isssssss", $job['id'], $job['username'], $job['job_title'], $job['location'], 
                                          $job['job_description'], $job['job_type'], $job['salary'], $job['benefits']);
                $stmt_insert->execute();
                $stmt_insert->close();
                
                $sql_delete = "DELETE FROM job_listings WHERE id = ?";
                $stmt_delete = $conn->prepare($sql_delete);
                if ($stmt_delete) {
                    $stmt_delete->bind_param("i", $job_id);
                    $stmt_delete->execute();
                    $stmt_delete->close();

                    return true; 
                }
            }
        }
    }
    return false; 
}

// Delete logic
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['job_id']) && isset($_POST['delete']) && isset($_SESSION['username']) && $_SESSION['role'] === 'admin') {
    $job_id = htmlspecialchars($_POST['job_id']);
    if (deleteJobListing($conn, $job_id)) {
        $conn->close();
        header("Location: ../html/admin-reviewlistings.php"); 
        exit();
    } else {
        echo "Error deleting listing.";
    }
}

// Company delete own job listing
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['jobs_id']) && isset($_POST['delete-from-company']) && isset($_SESSION['username']) && $_SESSION['role'] === 'Company') {
    $jobs_id = htmlspecialchars($_POST['jobs_id']);
    if (companyDeleteJobListing($conn, $jobs_id)) {
        $conn->close();
        header("Location: ../html/CompanyJobListing.php"); 
        exit();
    } else {
        echo "Error deleting listing.";
    }
}



if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['user_id']) && isset($_SESSION['username']) && $_SESSION['role'] === 'admin') {
    $user_id = htmlspecialchars($_POST['user_id']);

    if (deleteUsers($conn, $user_id)) {
        $conn->close();
        header("Location: ../html/admin-reviewusers.php"); 
        exit();
    } else {
        echo "Error deleting listing.";
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['company_id']) && isset($_SESSION['username']) && $_SESSION['role'] === 'admin') {
    $company_id = htmlspecialchars($_POST['company_id']);

    if (deleteCompany($conn, $company_id)) {
        $conn->close();
        header("Location: ../html/admin-reviewcompany.php"); 
        exit();
    } else {
        echo "Error deleting listing.";
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['job_id']) && isset($_POST['approve']) && isset($_SESSION['username']) && $_SESSION['role'] === 'admin') {
    $job_id = htmlspecialchars($_POST['job_id']);
    if (approveJobListing($conn, $job_id)) {
        $conn->close();
        header("Location: ../html/admin-approvedlistings.php");
        exit();
    } else {
        echo "Error approving listing.";
    }
}

// User edit profile
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_profile"])) {
    if (isset($_POST['form_type'])) {
        if ($_POST['form_type'] === 'customer_profile') {
            if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Customer') {
                echo "Unauthorized access!";
                exit();
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

            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
            $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
            $profession = filter_input(INPUT_POST, 'profession', FILTER_SANITIZE_STRING);
            $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            $errors = [];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format.";
            }

            if (!preg_match("/^[a-zA-Z0-9 ]*$/", $name)) {
                $errors[] = "Name can only contain alphanumeric characters and spaces.";
            }

            $allowed_genders = ['Male', 'Female'];
            if (!in_array($gender, $allowed_genders)) {
                $errors[] = "Invalid gender selected.";
            }

            $hashed_password = null;
            if (!empty($password)) {
                if (strlen($password) < 8) {
                    $errors[] = "Password must be at least 8 characters long.";
                }
                if ($password !== $confirm_password) {
                    $errors[] = "Passwords do not match.";
                }
                if (empty($errors)) {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                }
            }

            $profile_image = $user['profile_image'];
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
                $file_tmp_path = $_FILES['profile_image']['tmp_name'];
                $fileName = basename($_FILES['profile_image']['name']);
                $file_size = $_FILES['profile_image']['size'];
                $file_type = mime_content_type($file_tmp_path);

                $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];

                if (!in_array($file_type, $allowed_types)) {
                    $errors[] = "Only JPG, PNG, and JPEG files are allowed for profile images.";
                }

                if ($file_size > 2 * 1024 * 1024) {
                    $errors[] = "Profile image size must be less than 2MB.";
                }

                if (empty($errors)) {
                    $upload_dir = '../uploads/';
                    $new_file_name = uniqid('profile_', true) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
                    $dest_path = $upload_dir . $new_file_name;

                    if (move_uploaded_file($file_tmp_path, $dest_path)) {
                        if (!empty($profile_image) && $profile_image !== 'default_profile.jpg') {
                            $old_image_path = $upload_dir . $profile_image;
                            if (file_exists($old_image_path)) {
                                unlink($old_image_path);
                            }
                        }
                        $uploaded_image_url = $upload_dir . $new_file_name;
                        $profile_image = $uploaded_image_url;
                    } else {
                        $errors[] = "There was an error uploading the profile image.";
                    }
                }
            }

            if (empty($errors)) {
                if ($hashed_password) {
                    $sql = "UPDATE users SET name = ?, email = ?, age = ?, gender = ?, profession = ?, address = ?, password = ?, profile_image = ? WHERE name = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssissssss", $name, $email, $age, $gender, $profession, $address, $hashed_password, $profile_image, $current_username);
                } else {
                    $sql = "UPDATE users SET name = ?, email = ?, age = ?, gender = ?, profession = ?, address = ?, profile_image = ? WHERE name = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssisssss", $name, $email, $age, $gender, $profession, $address, $profile_image, $current_username);
                }

                if ($stmt->execute()) {
                    if ($name !== $current_username) {
                        $_SESSION['username'] = $name;
                    }
                    $stmt->close();
                    $conn->close();
                    header("Location: ../html/UserProfile.php?update=success");
                    exit();
                } else {
                    $errors[] = "Error updating profile: " . $stmt->error;
                    $stmt->close();
                    $conn->close();
                }
                session_start();
            }

            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo "<p>" . htmlspecialchars($error) . "</p>";
                }
            }
            
        } 
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_profile"])) {

        // Company update profile
    if ($_POST['form_type'] === 'company_profile') {
        if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Company') {
            echo "Unauthorized access!";
            exit();
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

        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $CompanySpecialization = filter_input(INPUT_POST, 'CompanySpecialization', FILTER_SANITIZE_STRING);
        $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        $errors = [];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }

        if (!preg_match("/^[a-zA-Z0-9 ]*$/", $name)) {
            $errors[] = "Name can only contain alphanumeric characters and spaces.";
        }

        if (!preg_match("/^[a-zA-Z0-9.\/ ]*$/", $address)) {
            $errors[] = "Address can only contain alphanumeric characters, spaces and backslashes.";
        }

        if (!preg_match("/^[a-zA-Z0-9. ]*$/", $CompanySpecialization)) {
            $errors[] = "Company Specialization can only contain alphanumeric characters and spaces.";
        }

        $hashed_password = null;
        if (!empty($password)) {
            if (strlen($password) < 8) {
                $errors[] = "Password must be at least 8 characters long.";
            }
            if ($password !== $confirm_password) {
                $errors[] = "Passwords do not match.";
            }
            if (empty($errors)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            }
        }

        $profile_image = $user['profile_image'];
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
            $file_tmp_path = $_FILES['profile_image']['tmp_name'];
            $fileName = basename($_FILES['profile_image']['name']);
            $file_size = $_FILES['profile_image']['size'];
            $file_type = mime_content_type($file_tmp_path);

            $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];

            if (!in_array($file_type, $allowed_types)) {
                $errors[] = "Only JPG, PNG, and JPEG files are allowed for profile images.";
            }

            if ($file_size > 2 * 1024 * 1024) {
                $errors[] = "Profile image size must be less than 2MB.";
            }

            if (empty($errors)) {
                $upload_dir = '../uploads/';
                $new_file_name = uniqid('profile_', true) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
                $dest_path = $upload_dir . $new_file_name;

                if (move_uploaded_file($file_tmp_path, $dest_path)) {
                    if (!empty($profile_image) && $profile_image !== 'default_profile.jpg') {
                        $old_image_path = $upload_dir . $profile_image;
                        if (file_exists($old_image_path)) {
                            unlink($old_image_path);
                        }
                    }
                    $uploaded_image_url = $upload_dir . $new_file_name;
                    $profile_image = $uploaded_image_url;
                } else {
                    $errors[] = "There was an error uploading the profile image.";
                }
            }
        }

        if (empty($errors)) {
            if ($hashed_password) {
                $sql = "UPDATE users SET name = ?, email = ?, CompanySpecialization = ?, address = ?, password = ?, profile_image = ? WHERE name = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssssss", $name, $email, $CompanySpecialization, $address, $hashed_password, $profile_image, $current_username);
            } else {
                $sql = "UPDATE users SET name = ?, email = ?, CompanySpecialization = ?, address = ?, profile_image = ? WHERE name = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssss", $name, $email, $CompanySpecialization, $address, $profile_image, $current_username);
            }

            if ($stmt->execute()) {
                if ($name !== $current_username) {
                    $_SESSION['username'] = $name;
                }
                $stmt->close();
                $conn->close();
                header("Location: ../html/CompanyProfile.php?update=success");
                exit();
            } else {
                $errors[] = "Error updating profile: " . $stmt->error;
                $stmt->close();
                $conn->close();
            }
            session_start();
        }

        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<p>" . htmlspecialchars($error) . "</p>";
            }
        }
    }
    }

