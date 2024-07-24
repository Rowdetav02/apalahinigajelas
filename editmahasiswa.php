<?php
include 'php/config.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($con, "SELECT * FROM students WHERE id='$id'");
    $data = mysqli_fetch_array($query);
}
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $jurusan = $_POST['jurusan'];
    $fakultas = $_POST['fakultas'];
    $angkatan = $_POST['angkatan'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    mysqli_query($con, "UPDATE students SET id='$id', nim='$nim', nama='$nama', email='$email', jurusan='$jurusan', fakultas='$fakultas', angkatan='$angkatan', jenis_kelamin ='$jenis_kelamin', alamat='$alamat', no_hp='$no_hp' WHERE id='$id'");
    header("Location: databasemahasiswa.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/editmahasiswa.css">
    <title>Edit Mahasiswa</title>
</head>
<body>
    <h3>Edit Data Mahasiswa</h3>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
        <label>NIM Mahasiswa:</label>
        <input type="text" name="nim" value="<?php echo $data['nim']; ?>"><br>
        <label>Nama Mahasiswa:</label>
        <input type="text" name="nama" value="<?php echo $data['nama']; ?>"><br>
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $data['email']; ?>"><br>
        <label>Jurusan:</label>
        <input type="text" name="jurusan" value="<?php echo $data['jurusan']; ?>"><br>
        <label>Nama Fakultas:</label>
        <input type="text" name="fakultas" value="<?php echo $data['fakultas']; ?>"><br>
        <label>Angkatan:</label>
        <input type="text" name="angkatan" value="<?php echo $data['angkatan']; ?>"><br>
        <label>Jenis Kelamin:</label>
        <input type="text" name="jenis_kelamin" value="<?php echo $data['jenis_kelamin']; ?>"><br>
        <label>Alamat:</label>
        <input type="text" name="alamat" value="<?php echo $data['alamat']; ?>"><br>
        <label>No Telepon:</label>
        <input type="text" name="no_hp" value="<?php echo $data['no_hp']; ?>"><br>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>
