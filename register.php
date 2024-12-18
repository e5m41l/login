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
        

        $select = mysqli_query($conn, "SELECT* FROM `users` WHERE email='$email'") or die("query failed");

        if (mysqli_num_rows($select) > 0) {
            $message[] = 'user already exist';
        } else if ($pass != $cpass) {
            $message[] = 'password did not match!';
        } else if ($image_size > 2000000) {
            $message[] = 'image is too large';
        } else {
            $insert = mysqli_query($conn, "INSERT INTO `users` (name, email, password, image) VALUES('$uname', '$email', '$pass', '$image')") or die('query failed');
            if ($insert) {
                move_uploaded_file($image_tmp_name, $image_folder);
                header('location:login.php?m=registered successfully!');
            } else {
                $message[] = 'registeration failed!';
            }
        }
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
    <style>
        body {
            background-color: #3f51b5;
        }
    </style>
</head>
<body>
    <div class="position-absolute top-50 start-50 translate-middle">
        <div class="wrapper">
            <form action="register.php" enctype="multipart/form-data" method="post" class="shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                <h2>Register Now</h2>
                <?php
                    if (isset($message)) {
                        foreach ($message as $message) {
                            echo '<div class="alert alert-danger" role="alert">'.$message.'</div>';
                        }
                    }
                ?>
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
                    Already have an account?<a class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="login.php"> login now</a>
                </p>
            </form>
        </div>
    </div>
    
    <script src="js/bootstrap.min.js"></script>
</body>
</html>