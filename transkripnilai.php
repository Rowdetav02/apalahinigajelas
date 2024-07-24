<?php
include 'php/config.php';

// Function to convert letter grade to numeric score
function convertGradeToScore($grade) {
    switch ($grade) {
        case 'A': return 4;
        case 'B': return 3;
        case 'C': return 2;
        case 'D': return 1;
        case 'E': return 0;
        default: return 0;
    }
}

$total_krs = 0;
$total_score = 0;
$gpa = 0;
$results = [];

if (isset($_POST['submit'])) {
    $nim = $_POST['nim'];

    // Retrieve course and grade data for the student
    $query = "SELECT m.nama AS matkul_nama, m.sks, n.nilai 
              FROM krs k
              JOIN matakuliah m ON k.matkul_id = m.id
              JOIN nilai n ON k.id = n.krs_id
              WHERE k.nim = '$nim'";

    $result = mysqli_query($con, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $nama_matkul = $row['matkul_nama'];
            $sks = $row['sks'];
            $nilai = $row['nilai'];
            $score = convertGradeToScore($nilai);

            // Calculate total krs and scores
            $total_krs += $sks;
            $total_score += $score * $sks;

            // Store the result for output
            $results[] = [
                'nama_matkul' => $nama_matkul,
                'sks' => $sks,
                'nilai' => $nilai,
                'score' => $score
            ];
        }

        // Calculate GPA (IP)
        if ($total_krs > 0) {
            $gpa = $total_score / $total_krs;
        }
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
    <link rel="stylesheet" href="assets/css/transkripnilai.css">
    <title>Transkrip Nilai</title>
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

    <h3>Transkrip Nilai</h3>
    <form method="POST" action="">
        <label>NIM Mahasiswa:</label>
        <input type="text" name="nim" required><br>
        <input type="submit" name="submit" value="Lihat Transkrip">
    </form>

    <?php if (!empty($results)) { ?>
        <table>
            <thead>
                <tr>
                    <th>Nama Matkul</th>
                    <th>SKS</th>
                    <th>Nilai</th>
                    <th>Skor</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $result) { ?>
                    <tr>
                        <td><?php echo $result['nama_matkul']; ?></td>
                        <td><?php echo $result['sks']; ?></td>
                        <td><?php echo $result['nilai']; ?></td>
                        <td><?php echo $result['score']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="summary">
            <p>Total SKS: <?php echo $total_krs; ?></p>
            <p>Total Skor: <?php echo $total_score; ?></p>
            <p>IP (GPA): <?php echo round($gpa, 2); ?></p>
        </div>
    <?php } ?>
</div>
</body>
</html>
