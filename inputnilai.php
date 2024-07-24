<?php
include 'php/config.php';

// Handle form submission to input grades
if (isset($_POST['submit'])) {
    $nim = $_POST['nim'];
    $krs_id = $_POST['krs_id'];
    $grade = $_POST['nilai'];

    // Insert grade into the database
    $query = "INSERT INTO nilai (krs_id, nilai) VALUES ('$krs_id', '$grade')";
    if (mysqli_query($con, $query)) {
        echo "<div class='message'>Nilai berhasil ditambahkan.</div>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}


// Retrieve all KRS entries for the form
$krs_query = mysqli_query($con, "SELECT k.id as krs_id, k.nim, m.nama 
                                 FROM krs k
                                 JOIN matakuliah m ON k.matkul_id = m.id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/inputnilai.css">
    <title>Input Nilai</title>
</head>
<body>
<div class="container">
    <header class="header">
        <div class="header-left">
            <a href="homedosen.php">SIKULI</a>
        </div>
        <div class="header-right">
            <a href="php/logout.php">Logout</a>
        </div>
    </header>

    <h3>Input Nilai</h3>
    <form method="POST" action="">
        <label>NIM Mahasiswa:</label>
        <input type="text" name="nim" required><br>

        <label>Pilih Mata Kuliah:</label>
        <select name="krs_id" required>
            <option value="">Pilih Mata Kuliah...</option>
            <?php while ($row = mysqli_fetch_array($krs_query)) { ?>
                <option value="<?php echo $row['krs_id']; ?>">
                    <?php echo $row['nim'] . " - " . $row['nama']; ?>
                </option>
            <?php } ?>
        </select><br>

        <label>Nilai:</label>
        <select name="nilai" required>
            <option value="">Pilih Nilai...</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            <option value="E">E</option>
        </select><br>

        <input type="submit" name="submit" value="Tambah Nilai">
    </form>
</div>
</body>
</html>
