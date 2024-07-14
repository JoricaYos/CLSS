<?php session_start(); ?>
<?php include '../../controllers/checker.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../../assets/smcc-logo.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Computer Laboratory Scheduling System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/login-signup.css">
</head>

<body>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="card login-card">
                <div class="row no-gutters">
                    <div class="col-md-5">
                        <img src="../../assets/icon.png" alt="login" class="login-card-img">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <div class="brand-wrapper">
                                <img src="../../assets/smcc-logo.png" alt="logo" class="logo">
                            </div>
                            <p class="login-card-description">Computer Laboratory<br>Scheduling System</p>
                            <b>USER REGISTRATION</b><br><br>
                            <form action="registration.php" method="post">
                                <div class="form-group">
                                    <label for="email" class="sr-only">Complete name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Complete name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="sr-only">Username</label>
                                    <input type="text" name="username" id="username" class="form-control"
                                        placeholder="Username" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="***********">
                                </div>
                                <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit"
                                    value="Sign up">
                                <a href="../../index.php" class="btn btn-secondary btn-block mb-4">Back
                                    to Login</a>
                            </form>
                            <div class="login-card-footer-nav">
                                <span>Saint Michael College of Caraga</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>