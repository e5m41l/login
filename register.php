<?php
    include_once("config.php");

    if (isset($_POST['add'])) {
        $uname = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = mysqli_real_escape_string($conn, $_POST['password']);
        $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = "uploaded_imgs/".$image;
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="position-absolute top-50 start-50 translate-middle">
        <div class="wrapper">
            <form action="register.php" enctype="multipart/form-data" method="post" class="shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                <h2>Register Now</h2>
                <div class="mb-3">
                    <input name="username" placeholder="enter username" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <input name="email" placeholder="enter email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <input required name="password" placeholder="enter password" type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <input required name="cpassword" placeholder="confirm password" type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <input name="image" accept="image/jpg, image/jpeg, image/png" type="file" class="form-control" id="inputGroupFile02">
                </div>
                <div class="d-grid gap-2">
                    <button name="add" value="register" type="submit" class="btn btn-primary">Register Now</button>
                </div>
                <p class="lead">
                    Already have an account?<a class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="index.php"> login now</a>
                </p>
            </form>
        </div>
    </div>
    
    <script src="js/bootstrap.min.js"></script>
</body>
</html>