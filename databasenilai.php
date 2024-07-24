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

// Initialize an array to hold GPA data for each student
$gpa_data = [];

// Fetch all distinct NIMs from the KRS table
$student_query = mysqli_query($con, "SELECT DISTINCT nim FROM krs");

while ($student = mysqli_fetch_assoc($student_query)) {
    $nim = $student['nim'];

    // Query to get all courses and grades for a specific student
    $query = "SELECT m.sks, n.nilai 
              FROM krs k
              JOIN matakuliah m ON k.matkul_id = m.id
              JOIN nilai n ON k.id = n.krs_id
              WHERE k.nim = '$nim'";

    $result = mysqli_query($con, $query);

    if ($result) {
        $total_krs = 0;
        $total_score = 0;

        while ($row = mysqli_fetch_assoc($result)) {
            $sks = $row['sks'];
            $nilai = $row['nilai'];
            $score = convertGradeToScore($nilai);

            // Calculate total krs and scores
            $total_krs += $sks;
            $total_score += $score * $sks;
        }

        // Calculate GPA (IP)
        $gpa = $total_krs > 0 ? $total_score / $total_krs : 0;

        // Store GPA data
        $gpa_data[] = [
            'nim' => $nim,
            'gpa' => round($gpa, 2)
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/databasenilai.css">
    <title>Database Nilai</title>
</head>
<body>
<div class="container">
    <header class="header">
        <div class="header-left">
            <a href="homeadmin.php">SIKULI</a>
        </div>
        <div class="header-right">
            <a href="php/logout.php">Logout</a>
        </div>
    </header>

    <h3>Daftar Nilai Mahasiswa</h3>
    <table>
        <thead>
            <tr>
                <th>NIM</th>
                <th>GPA</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($gpa_data as $data) { ?>
                <tr>
                    <td><?php echo $data['nim']; ?></td>
                    <td><?php echo $data['gpa']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
