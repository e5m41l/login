<?php

    session_start();
    $user_id = $_SESSION['user_id'];
    if(!isset($user_id)) {

        header('location:login.php');
    }

    if (isset($_GET['logout'])) {
        unset($user_id);
        session_destroy();
        header('location:login.php');
    }
    include_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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

            <?php 
                $user = mysqli_query($conn, "SELECT* FROM `users` WHERE id = '$user_id'");
                $user = mysqli_fetch_assoc($user);
            ?>
            <div class="card" style="width: 18rem;">
                <?php
                    if ($user['image'] == '') {
                        echo '<img style="border-radius: 50%; padding: 10px;" src="images/profile.webp" class="card-img-top" alt="...">';
                    } else {
                        echo '<img style="border-radius: 50%; padding: 10px;" src="/uploaded_imgs/'.$user['image'].'" class="card-img-top" alt="could not load image">';
                    }
                ?>
                <h3><?php echo $user['name']; ?></h3>
                <div class="card-body">
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <button onclick="window.location.href='edit_profile.php';" value="edit-profile" type="button" class="btn btn-secondary">Edit Profile</button>
                    <button onclick="window.location.href='home.php?logout=<?php echo $user_id ?>';" value="logout" type="button" class="btn btn-danger">Logout</button></a>
                </div>
                    <p class="lead">
                        New <a class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="login.php">login</a> or <a class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="register.php">register?</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <script src="js/bootstrap.min.js"></script>
</body>
</html>