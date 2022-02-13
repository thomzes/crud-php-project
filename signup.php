<?php

require 'functions.php';

if( isset($_POST['signin']) ) {

    if( signup($_POST) > 0 ) {
        echo "<script>
                alert('User baru berhasil ditambahkan!');
            </script>";
    }else {
        echo mysqli_error($conn);
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!-- Own CSS -->
    <link rel="stylesheet" href="css/login.css">

    <title>Sign Up | CRUD PHP NATIVE</title>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
        <a class="navbar-brand" href="#">CRUD | PHP NATIVE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav"    aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="signin.php">Sign In</a>
                    </li>
                </ul>
            </div>
  </div>
</nav>
<!-- Close Navbar -->

<!-- Container -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg mt-5 mb-5" >
                <div class="card text-center">
                    <div class="card-header fs-5 fw-light tetx-uppercase">Sign Up
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter Email Address" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm-password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm-password" placeholder="Enter Password" name="confirm-password" required>
                        </div>
                        <div>
                            <button class="btn btn-primary" type="submit" name="signin">Create Account</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-muted">
                    <p>Have an Account? Go to <a href="signin.php">Sign In!</a></p>
                </div>
            </div>

        </div>
    </div>
</div>

</div>
<!-- Close Container -->






<!-- Bootsrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>
</html>