<?php
// connection to the database
$conn = mysqli_connect("localhost", "root", "", "crudphp");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data) {

    global $conn;
    $nim = htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $tempatLahir = htmlspecialchars($data["tmptLahir"]);
    $tanggalLahir = $data["tglLahir"];
    $jenisKelamin = $data["jekel"];
    $jurusan = $data["jurusan"];
    $email = htmlspecialchars($data["email"]);
    $gambar = upload();
    $alamat = htmlspecialchars($data["alamat"]);

    // upload gambar
    if ( !$gambar ) {
        return false;
    }

    $query = "INSERT INTO siswa VALUES ('', '$nim', '$nama', '$tempatLahir', '$tanggalLahir', '$jenisKelamin', '$jurusan', '$email', '$gambar', '$alamat')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}


function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang di upload
    if( $error === 4) {
        echo "<script>alert('pilih gambar terlebih dahulu!');</script>";
        return false;
    }

    // format atau ekstensi yang diperbolehkan untuk di upload
    $extValid = ['jpg', 'jpeg', 'png'];
    $ext = explode('.', $namaFile);
    $ext = strtolower(end($ext));

    // jika format atau ekstensi bukan gambar maka akan menampilkan alert dibawah ini, untuk menjaga2 jika web mau dimasukan script lain
    if(!in_array($ext, $extValid)) {
        echo "<script>alert('Yang anda upload bukanlah gambar!');</script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if( $ukuranFile > 1000000 ) {
        echo "<script>alert('Ukuran gambar terlalu besar');</script>";
        return false;
    }


    // lolos semua pengecekan, siap di upload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ext;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}


function ubah($data) {

    global $conn;

    $id = $data["id"];
    $nim = htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $tempat_lahir = htmlspecialchars($data["tmptLahir"]);
    $tanggal_lahir = $data["tglLahir"];
    $jenis_kelamin = $data["jekel"];
    $jurusan = $data["jurusan"];
    $email = htmlspecialchars($data["email"]);
    $alamat = htmlspecialchars($data["alamat"]);

    $gambarLama = $data["gambarLama"];
    
    // cek apakah user pilih gambar baru atau tidak
    if( $_FILES['gambar']['error'] === 4 ) {
        $gambar = $gambarLama;
    }else {
        $gambar = upload();
    }

    $query = "UPDATE siswa SET
            nim = '$nim',
            nama = '$nama',
            tempat_lahir = '$tempat_lahir',
            tanggal_lahir = '$tanggal_lahir',
            jenis_kelamin = '$jenis_kelamin',
            jurusan = '$jurusan',
            email = '$email',
            gambar = '$gambar',
            alamat = '$alamat'
            WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id) {
    global $conn;

    mysqli_query($conn, "DELETE FROM siswa WHERE id = $id");
    return mysqli_affected_rows($conn);
}


function signup($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $email = stripslashes($data["email"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $confirm_password = mysqli_real_escape_string($conn, $data["confirm-password"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    
    if( mysqli_fetch_assoc($result) ) {
        echo "<script>
                alert('Username sudah terdaftar!');
            </script>";
        return false;
    }

    // cek konfirmasi password
    if($password !== $confirm_password) {
        echo "<script>
                alert('Confirm Password tidak sesuai!');
            </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$email', '$password')");

    return mysqli_affected_rows($conn);

}





?>