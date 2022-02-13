<?php
session_start();
require 'functions.php';

// cek cookie
if( isset($_COOKIE["id"]) && isset($_COOKIE["key"]) ) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM users WHERE id = $id");

    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if( $key === hash('sha256', $row['username']) ) {
        $_SESSION['signin'] = true;
    }


}

if( isset($_SESSION["signin"]) ) {
    header("Location: index.php");
    exit;
}



if( isset($_POST['signin']) ) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' ");

    // cek username
    if( mysqli_num_rows($result) === 1 ) {

        // cek password
        $row = mysqli_fetch_assoc($result);

        if( password_verify($password, $row["password"]) ) {
            // set session
            $_SESSION["signin"] = true;

            // cek remember me
            if( isset($_POST["remember"]) ) {
                // buat cookie

                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time() + 60);
            }

            header("Location: index.php");
            exit;
        }

    }

    $error = true;

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

    <title>Sign In | CRUD PHP NATIVE</title>
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
                        <a class="nav-link" aria-current="page" href="signup.php">Sign Up</a>
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
            <div class="card shadow-lg mt-5">
                <div class="card border-0 ">
                    <div class="card-header fs-5 fw-light text-uppercase text-center">Sign In
                </div>
                <div class="card-body">
                    <?php if( isset($error) ) { ?>
                        <p style="color : red; font-style: italic">Username / Password Salah!</p>
                    <?php } ?>

                    <form action="" method="POST">
                        <div class="mb-3 text-center">
                            <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username" required>
                        </div>
                        <div class="mb-3 text-center">
                            <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" required>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="remember">
                                <label class="form-check-label" for="flexCheckDefault">Remember Me</label>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary mt-2" type="submit" name="signin">Sign In</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-muted">
                    <p class="text-center">Need an Account? Go to <a href="signup.php">Sign Up!</a></p>
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