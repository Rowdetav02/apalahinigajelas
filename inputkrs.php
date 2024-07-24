<?php
include 'php/config.php';

// Menangani form submit untuk menambah KRS
if (isset($_POST['submit'])) {
    $nim = $_POST['nim'];
    $matkul_id = $_POST['matkul_id'];
    
    // Masukkan data KRS ke dalam database
    $query = "INSERT INTO krs (nim, matkul_id) VALUES ('$nim', '$matkul_id')";
    if (mysqli_query($con, $query)) {
        echo "<div class='message'>Mata kuliah berhasil ditambahkan ke KRS.</div>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

// Ambil data mata kuliah
$matkul_query = mysqli_query($con, "SELECT * FROM matakuliah");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/adddata.css">
    <title>Tambah KRS</title>
</head>
<body>
<div class="container">
        <header class="header">
            <div class="header-left">
                <a href="homemahasiswa.php">SIKULI</a>
            </div>
            <div class="header-right">
                <a href="php/logout.php">Logout</a>
            </div>
        </header>
    <h3>Tambah Mata Kuliah ke KRS</h3>
    <form method="POST" action="">
        <label>NIM Mahasiswa:</label>
        <input type="text" name="nim" required><br>
        
        <label>Pilih Mata Kuliah:</label>
        <select name="matkul_id" required>
            <option value="">Pilih Mata Kuliah...</option>
            <?php while ($row = mysqli_fetch_array($matkul_query)) { ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['nama']; ?></option>
            <?php } ?>
        </select><br>
        
        <input type="submit" name="submit" value="Tambah">
    </form>
</body>
</html>
