<?php
include 'php/config.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($con, "SELECT * FROM matakuliah WHERE id='$id'");
    $data = mysqli_fetch_array($query);
}
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $sks = $_POST['sks'];
    $jadwal = $_POST['jadwal'];
    $kelas = $_POST['kelas'];
    $semester = $_POST['semester'];
    $dosen = $_POST['dosen'];

    mysqli_query($con, "UPDATE matakuliah SET id='$id', kode='$kode', nama='$nama', sks='$sks', jadwal='$jadwal', kelas='$kelas', semester='$semester', dosen ='$dosen 'WHERE id='$id'");
    header("Location: databasematkul.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/editmahasiswa.css">
    <title>Edit Matkul</title>
</head>
<body>
    <h3>Edit Data Mata Kuliah</h3>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
        <label>Kode Matkul:</label>
        <input type="text" name="kode" value="<?php echo $data['kode']; ?>"><br>
        <label>Nama Matkul:</label>
        <input type="text" name="nama" value="<?php echo $data['nama']; ?>"><br>
        <label>SKS</label>
        <input type="number" name="sks" value="<?php echo $data['sks']; ?>"><br>
        <label>Jadwal:</label>
        <input type="text" name="jadwal" value="<?php echo $data['jadwal']; ?>"><br>
        <label>Kelas :</label>
        <input type="text" name="kelas" value="<?php echo $data['kelas']; ?>"><br>
        <label>Semester:</label>
        <input type="number" name="semester" value="<?php echo $data['semester']; ?>"><br>
        <label>Dosen:</label>
        <input type="text" name="dosen" value="<?php echo $data['dosen']; ?>"><br>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>
