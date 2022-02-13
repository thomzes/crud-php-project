<?php
session_start();

if( !isset($_SESSION["signin"]) ) {
    header("Location: signin.php");
    exit;
}

require 'functions.php';

// menampilkan semua data dari siswa berdasarkan id secara descending
$siswa = query("SELECT * FROM siswa ORDER BY id DESC");




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

    <title>Data Siswa | CRUD PHP NATIVE</title>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase fixed-top">
  <div class="container">
        <a class="navbar-brand" href="index.php">CRUD | PHP NATIVE</a>
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
<div class="container" style="margin-top: 80px;">
    <div class="row my-3">
        <div class="col-md">
            <h2 class="text-uppercase text-center fw-bold">Data Siswa</h2>
        </div>
        <hr>
    </div>
    <div class="row">
        <div class="col-md">
            <a href="tambah.php" class="btn btn-primary"><i class="bi bi-person-plus-fill"></i>&nbsp;Tambah Data Siswa</a>
            <a href="#" class="btn btn-success ms-1" target="_blank"><i class="bi bi-file-earmark-excel-fill"></i>&nbsp;Export ke Excel</a>
            <a href="pdf.php" class="btn btn-danger ms-1" target="_blank"><i class="bi bi-file-earmark-pdf-fill"></i>&nbsp;Export ke pdf</a>
        </div>
    </div>
    <div class="row my-5">
        <div class="col-md">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Gambar</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Jurusan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1;?>
                <?php foreach( $siswa as $row) { ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row["nim"]; ?></td>
                        <td><?php echo $row["nama"]; ?></td>
                        <td><img src="img/<?php echo $row["gambar"] ?>" width="50" height="50" class="rounded"></td>
                        <td><?php echo $row["tanggal_lahir"]; ?></td>
                        <td><?php echo $row["jenis_kelamin"]; ?></td>
                        <td><?php echo $row["jurusan"]; ?></td>
                        <td>
                            <a href="ubah.php?id=<?php echo $row["id"]; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i>&nbsp;Edit</a> |
                            <a href="hapus.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data <?php echo $row['nama'] ?> ?')"><i class="bi bi-trash-fill"></i>&nbsp;Delete</a>
                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Close Container -->

<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#212529" fill-opacity="1" d="M0,288L48,261.3C96,235,192,181,288,186.7C384,192,480,256,576,250.7C672,245,768,171,864,144C960,117,1056,139,1152,154.7C1248,171,1344,181,1392,186.7L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>

<!-- Footer -->
<div class="container-fluid bg-dark text-white">
    <div class="row pt-5">
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






<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

<!-- Data Tables -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap5.min.js"></script>   

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>


</body>
</html>