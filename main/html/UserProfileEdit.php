<?php
session_start();
if (!isset($_SESSION['username'])) {
  // Redirect to login page if not logged in
  header("Location: ../html/LoginPage.html");
  exit();
}

$username = htmlspecialchars($_SESSION['username']);
?>

<html>
<head>
    <title>User Edit Profile</title>
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
            <img src="../../Image/default_profile.jpg" class="js-image img-fluid rounded" alt="logo">
            <div class="text-left">
                <label for="formFileLg" class="form-label">Input an image</label>
                <input onchange="display_image(this.files[0])" class="form-control form-control-lg" id="formFileLg" type="file">
              </div>
        </div>
        <div class="col-md-8">
            <div class="h2">Edit Profile</div>
            <form method="post">
                <table class="container-fluid table table-striped">
                    <tr><th colspan="2">User Details:</th></tr>
                    <tr><th><i class="fa fa-user-circle"></i> Name</th>
                        <td><input type="text" class="form-control" name="name" placeholder="name"></td></tr>

                    <tr><th><i class="fa fa-user-circle"></i> passwords</th>
                        <td><input type="text" class="form-control" name="passwords" placeholder="passwords"></td></tr>

                    <tr><th><i class="fa fa-calendar"></i> Age</th>
                        <td><input type="text" class="form-control" name="age" placeholder="age"></td></tr>

                    <tr><th><i class="fa fa-envelope"></i> Email</th>
                        <td><input type="text" class="form-control" name="email" placeholder="email"></td></tr>

                    <tr><th><i class="fa fa-transgender"></i> Gender</th>
                        <td><select class="form-select form-select-lg mb-3" aria-label="Large select example">
                            <option selected>Select Gender</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                        </td></tr>

                    <tr><th><i class="fa fa-briefcase"></i> Profession</th>
                        <td><input type="text" class="form-control" name="profession" placeholder="profession"></td></tr>

                    <tr><th><i class="fa fa-home"></i> Address</th>
                        <td><input type="text" class="form-control" name="address" placeholder="address"></td></tr> 
                </table>
            <div class="p-2">
                <a href="./UserProfile.php">
                    <label type="button" class="btn-lg btn-primary">Back</label>
                </a>
                <button class="btn-lg btn-primary float-end">Save</button>
            </div>
        </form>

        </div>
    </div>
    
</body>
</html>

<script>
    console.log(URL);
    function display_image(file)
    {
        var img = document.querySelector(".js-image");
        img.src = URL.createObjectURL(file);
    }
</script>