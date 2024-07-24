<?php
include 'php/config.php';
session_start();

if (isset($_POST['submit'])) {
    // Get NIM from input form
    $nim_input = $_POST['nim'];

    // Ensure the NIM input is not empty
    if (!empty($nim_input)) {
        // Fetch the KRS records for the given NIM
        $krs_query = mysqli_query($con, "
            SELECT matakuliah.kode, matakuliah.nama, matakuliah.jadwal, matakuliah.sks, matakuliah.dosen, matakuliah.kelas 
            FROM krs 
            INNER JOIN matakuliah ON krs.matkul_id = matakuliah.id 
            WHERE krs.nim = '$nim_input'
        ");
    } else {
        echo "<div class='message'>NIM tidak boleh kosong!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/jadwal.css">
    <title>Jadwal Mata Kuliah</title>
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
        
        <h3>Jadwal Mata Kuliah</h3>
        <form method="POST" action="">
            <label>NIM Mahasiswa:</label>
            <input type="text" name="nim" required>
            <input type="submit" name="submit" value="Tampilkan Jadwal">
        </form>

        <?php if (isset($krs_query) && mysqli_num_rows($krs_query) > 0) { ?>
        <table border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Matkul</th>
                    <th>Nama Matkul</th>
                    <th>Jadwal</th>
                    <th>SKS</th>
                    <th>Dosen</th>
                    <th>Kelas</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($krs_query)) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $row['kode'] . "</td>";
                    echo "<td>" . $row['nama'] . "</td>";
                    echo "<td>" . $row['jadwal'] . "</td>";
                    echo "<td>" . $row['sks'] . "</td>";
                    echo "<td>" . $row['dosen'] . "</td>";
                    echo "<td>" . $row['kelas'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <?php } elseif (isset($krs_query)) { ?>
            <p>Tidak ada mata kuliah yang terdaftar untuk NIM ini.</p>
        <?php } ?>
    </div>
</body>
</html>
