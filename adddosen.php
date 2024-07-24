<?php
include 'php/config.php'; // Include the database connection file

if (isset($_POST['add'])) {
    $nid = $_POST['nid'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $jurusan = $_POST['jurusan'];
    $fakultas = $_POST['fakultas'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    // Insert data into the database
    $query = "INSERT INTO dosen (nid, nama, email, jurusan, fakultas, jenis_kelamin, alamat, no_hp)
              VALUES ('$nid', '$nama', '$email', '$jurusan', '$fakultas', '$jenis_kelamin', '$alamat', '$no_hp')";

    if (mysqli_query($con, $query)) {
        echo "Data berhasil ditambahkan.";
        header("Location: databasedosen.php");
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
    <title>Tambah Data Dosen</title>
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
    <h3>Tambah Data Dosen</h3>
    <form method="POST" action="">
        <label>NID Dosen:</label>
        <input type="text" name="nid" required><br>
        <label>Nama Dosen:</label>
        <input type="text" name="nama" required><br>
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Jurusan:</label>
        <input type="text" name="jurusan" required><br>
        <label>Nama Fakultas:</label>
        <input type="text" name="fakultas" required><br>
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
