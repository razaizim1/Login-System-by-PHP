<?php

require_once('config.php');
session_start();



if (isset($_POST['loginForm'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
        $error =  "Email is required";
    } elseif (empty($password)) {
        $error =  "Password is required";
    } else {
        $password = sha1($password);
        $stm = $connection->prepare("SELECT id,email,password FROM login WHERE email=? AND password=?");
        $stm->execute(array($email, $password));
        $result = $stm->rowCount();



        if ($result == 1) {
            $success = "Login Successful!";
            header("location:index.php");

            $userData = $stm->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user'] = $userData['id'];
        } else {
            $error = "Email or password wrong!";
        }
    }
}



?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>

    <div class="registration-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-3 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="text-center">
                                <?php
                                date_default_timezone_set("Asia/Dhaka");
                                $h = date('G');

                                if ($h >= 5 && $h <= 11) {
                                    echo "Good Morning,";
                                } else if ($h >= 12 && $h <= 15) {
                                    echo "Good Afternoon,";
                                } else {
                                    echo "Good Evening,";
                                }
                                ?>
                                Please Login</h2>
                            <?php if (isset($error)) : ?>
                                <div class="alert alert-danger">
                                    <?php echo $error; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($success)) : ?>
                                <div class="alert alert-success">
                                    <?php echo $success; ?>
                                </div>
                            <?php endif; ?>
                            <form action="" method="POST">

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email">
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password">
                                </div>
                                <div class="mb-3 text-center">
                                    <input class="btn btn-primary" type="submit" value="Login" name="loginForm">
                                </div>
                                Create an account? <a href="registration.php">Registration</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>