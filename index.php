<?php

require_once('config.php');
session_start();

if (!isset($_SESSION['user'])) {
    header('location:login.php');
}

// echo $_SESSION['user'];


?>

<!doctype html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Dashboard</h4>
                    <p class="text-black">Welcome to user Dashboard</p>
                    <hr>
                    <p class="mb-0">Hello,
                        <?php
                        $userData = $connection->prepare("SELECT * FROM login WHERE id=?");
                        $userData->execute(array($_SESSION['user']));
                        $data = $userData->fetch((PDO::FETCH_ASSOC));
                        echo ucwords($data['name']);


                        date_default_timezone_set("Asia/Dhaka");
                        $h = date('G');

                        if ($h >= 5 && $h <= 11) {
                            echo "<br> Good Morning";
                        } else if ($h >= 12 && $h <= 15) {
                            echo "<br> Good Afternoon";
                        } else {
                            echo " Good Evening";
                        }

                        ?>
                    </p>


                    <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
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