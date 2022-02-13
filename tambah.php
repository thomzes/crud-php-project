<?php
session_start();

if( !isset($_SESSION["signin"]) ) {
    header("Location: signin.php");
    exit;
}

require 'functions.php';

// cek button tambah sudah di klik atau belum
if( isset($_POST['tambah']) ) {

    // cek apakah data berhasil ditambahkan atau tidak
    if( tambah($_POST) > 0 ) {
        echo "<script>alert('data berhasil ditambahkan!');
                document.location.href = 'index.php';
            </script>";
    }else {
        echo "<script>alert('data gagal ditambahkan!');
            </script>";
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
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- Data Tables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap5.min.css">
    <!-- Own CSS -->
    <link rel="stylesheet" href="css/style.css">

    <title>Tambah Data Siswa | CRUD PHP NATIVE</title>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase fixed-top">
  <div class="container">
        <a class="navbar-brand" href="#menu">CRUD | PHP NATIVE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav"    aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
  </div>
</nav>
<!-- Close Navbar -->

<!-- Container -->
<div class="container" style="margin-top: 80px;" id="menu" >
    <div class="row my-3">
        <div class="col-md">
            <h2><i class="bi bi-person-plus-fill"></i>&nbsp;Tambah Data Siswa</h2>
            <hr>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control w-50" id="nim" placeholder="NIM" min="1" name="nim" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control w-50" id="nama" placeholder="Masukan Nama" name="nama" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="tmptLahir" class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-control w-50" id="tmptLahir" placeholder="Masukan Tempat Lahir" name="tmptLahir" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="tglLahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control w-50" id="tglLahir" placeholder="Masukan Tanggal Lahir" max="01-01-2006" name="tglLahir" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jekel" id="Laki-Laki" value="Laki - Laki">
                        <label class="form-check-label" for="Laki-Laki">Laki - Laki</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jekel" id="Perempuan" value="Perempuan">
                        <label class="form-check-label" for="Perempuan">Perempuan</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="jurusan" class="form-label">Jurusan</label>
                    <select class="form-select w-50" id="jurusan" name="jurusan" required>
                        <option disable selected value>======================= Pilih Jurusan ======================</option>
                        <option value="Teknik Komputer">Teknik Komputer</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Teknik Kimia">Teknik Kimia</option>
                        <option value="Teknik Fisika">Teknik Fisika</option>
                        <option value="Arsitektur">Arsitektur</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control w-50" id="email" placeholder="Masukan Email" name="email"autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input class="form-control form-control-sm w-50" id="gambar" type="file" name="gambar">
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control w-50" id="alamat" rows="3" name="alamat" placeholder="Masukan Alamat" required></textarea>
                </div>
                <hr class="w-50">
                <div class="mb-3 w-50 ms-auto" style="margin-right: 150px;">
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<!-- Close Container -->
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#212529" fill-opacity="1" d="M0,288L48,261.3C96,235,192,181,288,186.7C384,192,480,256,576,250.7C672,245,768,171,864,144C960,117,1056,139,1152,154.7C1248,171,1344,181,1392,186.7L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>

<!-- Footer -->
<div class="container-fluid bg-dark text-white">
    <div class="row">
        <div class="col-md-6">
            <h4 class="text-uppercase fw-bold" id="about">About</h4>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Obcaecati commodi autem dolore aut fugit consequuntur, veritatis placeat maiores quis esse neque sed facilis laudantium, corrupti, iure rem aspernatur et! Ipsam.</p>
        </div>
        <div class="col-md-6 text-center">
            <h4 class="text-uppercase fw-bold" >Links Account</h4>
            <a href="https://web.facebook.com/thomas.iis" target="_blank"><i class="bi bi-facebook fs-2" style="display:inline-block; margin-top: 20px; margin-left: 10px; color: #fff;" onmouseover="this.style.color='#3b5998'" onmouseout="this.style.color='#fff';"></i></a>
            <a href="https://twitter.com/nginjeknasi" target="_blank"><i class="bi bi-twitter fs-2" style="display:inline-block; margin-top: 20px; margin-left: 10px; color: #fff;" onmouseover="this.style.color='#1da1f2'" onmouseout="this.style.color='#fff';"></i></a>
            <a href="https://www.instagram.com/thomardian/" target="_blank"><i class="bi bi-instagram fs-2" style="display: inline-block; margin-top: 20px; margin-left: 10px; color: #fff;" onmouseover="this.style.color='#c13584'" onmouseout="this.style.color='#fff';"></i></a>
            <a href="#" target="_blank"><i class="bi bi-github fs-2" style="display: inline-block; margin-top: 20px; margin-left: 10px; color: #fff;" onmouseover="this.style.color='#ccc'" onmouseout="this.style.color='#fff';"></i></a>
        </div>
    </div>
    <footer class="text-center" style="padding: 5px;">
        <p>Created with <i class="bi bi-heart-fill" style="color: red;"></i> by <u class="fw-bold">Thomas Ardiansah</u></p>
    </footer>
</div>
<!-- Close Footer -->









</body>
</html>