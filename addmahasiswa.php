<?php
include 'php/config.php'; // Include the database connection file

if (isset($_POST['add'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $jurusan = $_POST['jurusan'];
    $fakultas = $_POST['fakultas'];
    $angkatan = $_POST['angkatan'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    // Insert data into the database
    $query = "INSERT INTO students (nim, nama, email, jurusan, fakultas, angkatan, jenis_kelamin, alamat, no_hp)
              VALUES ('$nim', '$nama', '$email', '$jurusan', '$fakultas', '$angkatan', '$jenis_kelamin', '$alamat', '$no_hp')";

    if (mysqli_query($con, $query)) {
        echo "Data berhasil ditambahkan.";
        header("Location: databasemahasiswa.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/adddata.css">
    <title>Tambah Data Mahasiswa</title>
</head>
<body>
<div class="nav">
    <div class="logo">
        <p><a href="homeadmin.php"> SIKULI</a></p>
    </div>
    <div class="right-links">
        <a href="php/logout.php"> <button class="btn">Log Out</button> </a>
    </div>
</div>

<div class="datamahasiswa">
    <h3>Tambah Data Mahasiswa</h3>
    <form method="POST" action="">
        <label>NIM Mahasiswa:</label>
        <input type="text" name="nim" required><br>
        <label>Nama Mahasiswa:</label>
        <input type="text" name="nama" required><br>
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Jurusan:</label>
        <input type="text" name="jurusan" required><br>
        <label>Nama Fakultas:</label>
        <input type="text" name="fakultas" required><br>
        <label>Angkatan:</label>
        <input type="text" name="angkatan" required><br>
        <label>Jenis Kelamin:</label>
        <select name="jenis_kelamin" required>
            <option value="">Pilih Jenis Kelamin</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select><br>
        <label>Alamat:</label>
        <input type="text" name="alamat" required><br>
        <label>No Telepon:</label>
        <input type="text" name="no_hp" required><br>
        <input type="submit" name="add" value="Tambah">
    </form>
</div>
</body>
</html>
