<?php
session_start();

if( !isset($_SESSION["signin"]) ) {
    header("Location: signin.php");
    exit;
}

require 'functions.php';


// ambil data dari url
$id = $_GET["id"];

// mengambil data dari table siswa dari nim yang tidak sama dengan 0
$siswa = query("SELECT * FROM siswa WHERE id = $id")[0];

// cek apakah button sudah di klik atau belum
if (isset($_POST["ubah"])) {

    if (ubah($_POST) > 0) {
        echo "<script>
                alert('Data siswa berhasil diubah!');
                document.location.href = 'index.php';
            </script>";
    } else {
        // Jika fungsi ubah dibawah dari atau sama dengan 0/data tidak terubah, maka munculkan alert dibawah
        echo "<script>
                alert('Data siswa gagal diubah!');
            </script>";
            echo mysqli_error($conn);
            die();
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

    <title>Ubah Data Siswa | CRUD PHP NATIVE</title>
</head>
<body id="menu">

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
<div class="container" style="margin-top: 80px;">
    <div class="row my-3">
        <div class="col-md">
            <h2><i class="bi bi-pencil-square"></i>&nbsp;Ubah Data Siswa</h2>
            <hr>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $siswa["id"]; ?>">
                <input type="hidden" name="gambarLama" value="<?php echo $siswa["gambar"]; ?>">
                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control w-50" id="nim" value="<?php echo $siswa["nim"]; ?>" name="nim" autocomplete="off" readonly>
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control w-50" id="nama" value="<?php echo $siswa["nama"]; ?>" name="nama"     required>
                </div>
                <div class="mb-3">
                    <label for="tmptLahir" class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-control w-50" id="tmptLahir" value="<?php echo $siswa["tempat_lahir"]; ?>" name="tmptLahir" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="tglLahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control w-50" id="tglLahir" value="<?php echo $siswa["tanggal_lahir"]; ?>" name="tglLahir" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jekel" id="Laki-Laki" value="Laki - Laki"
                        <?php if( $siswa["jenis_kelamin"] == 'Laki - Laki') { ?>
                            checked = ''
                        <?php } ?>>
                        <label class="form-check-label" for="Laki-Laki">Laki - Laki</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jekel" id="Perempuan" value="Perempuan"
                        <?php if( $siswa["jenis_kelamin"] === 'Perempuan') { ?>
                            checked = ''
                        <?php } ?>>
                        <label class="form-check-label" for="Perempuan">Perempuan</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="jurusan" class="form-label">Jurusan</label>
                    <select class="form-select w-50" id="jurusan" name="jurusan">
                        <option disabled selected value>======================= Pilih Jurusan ======================</option>
                        <option value="Teknik Komputer" 
                        <?php if( $siswa["jurusan"] == 'Teknik Komputer') { ?>
                            selected = ''
                        <?php } ?> >Teknik Komputer</option>
                        <option value="Teknik Informatika"
                        <?php if( $siswa["jurusan"] == 'Teknik Informatika') {?>
                            selected = ''
                        <?php } ?> >Teknik Informatika</option>
                        <option value="Teknik Kimia"
                        <?php if( $siswa["jurusan"] == 'Teknik Kimia') {?>
                            selected=''
                        <?php } ?> >Teknik Kimia</option>
                        <option value="Teknik Fisika"
                        <?php if( $siswa["jurusan"] == 'Teknik Fisika') {?>
                            selected=''
                        <?php } ?> >Teknik Fisika</option>
                        <option value="Arsitektur" 
                        <?php if( $siswa["jurusan"] == 'Arsitektur') {?>
                            selected=''
                        <?php } ?> >Arsitektur</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control w-50" id="email" value="<?php echo $siswa["email"]; ?>" name="email"autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar <i>(Saat ini)</i></label><br>
                    <img src="img/<?php echo $siswa["gambar"]; ?>" width="120" class="rounded" style="margin-bottom : 10px; ">
                    <input class="form-control form-control-sm w-50" id="gambar" type="file" name="gambar">
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control w-50" id="alamat" rows="3" name="alamat" placeholder="Alamat"><?php echo $siswa["alamat"]; ?></textarea>
                </div>
                <hr class="w-50">
                <div class="mb-3 w-50 ms-auto" style="margin-right: 143px;">
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" name="ubah" class="btn btn-warning">Edit</button>
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



<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>





</body>
</html>