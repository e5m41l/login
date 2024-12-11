<?php

    include_once("config.php");

    session_start();
    if (isset($_POST['login'])) {

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $log = mysqli_query($conn, "SELECT* FROM `users` WHERE email='$email' AND password='$password'");
        
        if (mysqli_num_rows($log) > 0) {
            $user = mysqli_fetch_assoc($log);
            $_SESSION['user_id'] = $user['id'];
            header('location:home.php');
        } else {
            $message[] = "Incorrect email or password.";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            <form action="login.php" method="post" class="shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                <h2>LOGIN NOW</h2>
                <?php
                    if (isset($message)) {
                        foreach ($message as $message) {
                            echo '<div class="alert alert-danger" role="alert">'.$message.'</div>';
                        }
                    }
                ?>
                <div class="mb-3">
                    <input name="email" placeholder="enter email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <input name="password" placeholder="enter password" type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="d-grid gap-2">
                    <button value="log" name="login" type="submit" class="btn btn-primary">Login Now</button>
                </div>
                <p class="lead">
                    don't have an account?<a class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="register.php"> register now</a>
                </p>
            </form>
        </div>
    </div>
    
    <script src="js/bootstrap.min.js"></script>
</body>
</html>