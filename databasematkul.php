<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/student.css">
    <title>Database Mata Kuliah</title>
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
    <h3> Data Mata Kuliah </h3>
    <!-- Form Pencarian -->
    <form method="GET" action="">
        <select name="search_id">
            <option value="">Pilih Filter Pencarian...</option>
            <option value="kode">Kode Matkul</option>
            <option value="nama">Nama Matkul</option>
            <option value="sks">SKS</option>
            <option value="jadwal">Jadwal</option>
            <option value="kelas">Kelas</option>
            <option value="semester">Semester</option>
            <option value="dosen">Dosen</option>
        </select>
        <input type="text" name="search_keyword" placeholder="Cari...">
        <input type="submit" value="Cari">
        <a href="addmatkul.php" style="margin-left: 10px;"><button type="button" class="tambah-data-btn">Add New</button>
</a>
        </a>
    </form>

    <table border="1">
        <tr>
            <th>No</th>
            <th>Kode MK</th>
            <th>Nama MK</th>
            <th>SKS</th>
            <th>Jadwal MK</th>
            <th>Kelas</th>
            <th>Semester</th>
            <th>Dosen MK</th>
            <th colspan="2">Aksi</th>
        </tr>
        <?php
        include 'php/config.php'; // Include your database connection file

        $No = 1;
        $query = "SELECT * FROM matakuliah WHERE 1=1";

        // Pengecekan dan penambahan kondisi pencarian
        $conditions = [];

        if (!empty($_GET['search_id']) && !empty($_GET['search_keyword'])) {
            $search_id = mysqli_real_escape_string($con, $_GET['search_id']);
            $search_keyword = mysqli_real_escape_string($con, $_GET['search_keyword']);
            $conditions[] = "$search_id LIKE '%$search_keyword%'";
        }

        // Gabungkan kondisi pencarian
        if (!empty($conditions)) {
            $query .= " AND " . implode(" AND ", $conditions);
        }

        $ambildata = mysqli_query($con, $query);

        while ($tampil = mysqli_fetch_array($ambildata)) {
            echo "<tr>
                <td>" . $No++ . "</td>
                <td>" . $tampil['kode'] . "</td>
                <td>" . $tampil['nama'] . "</td>
                <td>" . $tampil['sks'] . "</td>
                <td>" . $tampil['jadwal'] . "</td>
                <td>" . $tampil['kelas'] . "</td>
                <td>" . $tampil['semester'] . "</td>
                <td>" . $tampil['dosen'] . "</td>
                <td><button><a href='editmatkul.php?id=" . $tampil['id'] . "'>Edit</a></button></td>
                <td><button><a href='databasematkul.php?id=" . $tampil['id'] . "' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\">Hapus</a></button></td>
            </tr>";
        }
        ?>
    </table>
    <?php
    // Proses hapus data
    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($con, $_GET['id']);
        mysqli_query($con, "DELETE FROM matakuliah WHERE id='$id'");
        echo "Data Berhasil Dihapus";
        echo "<meta http-equiv='refresh' content='2;URL=databasemahasiswa.php'>";
    }
    ?>
</div>
</body>
</html>
