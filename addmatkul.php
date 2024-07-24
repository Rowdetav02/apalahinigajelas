<?php
include 'php/config.php'; // Include the database connection file

if (isset($_POST['add'])) {
    $id = $_POST['id'];
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $sks = $_POST['sks'];
    $jadwal = $_POST['jadwal'];
    $kelas = $_POST['kelas'];
    $semester = $_POST['semester'];
    $dosen = $_POST['dosen'];

    // Insert data into the database
    $query = "INSERT INTO matakuliah (id, kode, nama, sks, jadwal, kelas, semester, dosen)
              VALUES ('$id', '$kode', '$nama', '$sks', '$jadwal', '$kelas', '$semester', '$dosen')";

    if (mysqli_query($con, $query)) {
        echo "Data berhasil ditambahkan.";
        header("Location: databasematkul.php");
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
    <title>Tambah Data Mata Kuliah</title>
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
    <h3>Tambah Data Mata Kuliah</h3>
    <form method="POST" action="">
        <label>Kode Mata Kuliah:</label>
        <input type="text" name="kode" required><br>
        <label>Nama Mata Kuliah:</label>
        <input type="" name="nama" required><br>
        <label>SKS:</label>
        <input type="number" name="sks" required><br>
        <label>Jadwal:</label>
        <input type="text" name="jadwal" required><br>
        <label>Ruangan Kelas:</label>
        <input type="text" name="kelas" required><br>
        <label>Semester:</label>
        <input type="number" name="semester" required><br>
        <label>Dosen Ajar:</label>
        <input type="dosen" name="dosen" required><br>
        <input type="submit" name="add" value="Tambah">
    </form>
</div>
</body>
</html>
