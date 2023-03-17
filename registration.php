<?php

require_once('config.php');





if (isset($_POST['formSubmit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Call used input function
    $phoneCount = emailCount('phone', $phone);
    $emailCount = emailCount('email', $email);


    // $emailCount = usedData('email', 'razai.zim1@gmail.com');
    // echo $emailCount;

    if (empty($name)) {
        $error = "Name is required";
    } elseif ($phoneCount != 0) {
        $error = "Phone number already used!";
    } elseif ($emailCount != 0) {
        $error = "Email already used!";
    } elseif (empty($email)) {
        $error =  "Email is required";
    } elseif (empty($password)) {
        $error =  "Password is required";
    } else {
        $created_at = date("Y-m-d H:i:s");
        $password = sha1($password);

        $stm = $connection->prepare("INSERT INTO login (name,email,phone,password,created_at) VALUES(?,?,?,?,?)");
        $result = $stm->execute(array($name, $email, $phone, $password, $created_at));
        print_r($result);

        if ($result == true) {
            $success = "Registration Successful!";
        } else {
            $error = "Registration Failed!";
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
                            <h2 class="text-center">Registration Form</h2>
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
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="name">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" id="phone">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password">
                                </div>
                                <div class="mb-3 text-center">
                                    <input class="btn btn-primary" type="submit" value="Submit" name="formSubmit">
                                </div>
                                Already have an account? Please<a href="login.php"> login</a>
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