<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/student.css">
    <title>Database Mahasiswa</title>
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
    <h3> Data Mahasiswa </h3>
    <!-- Form Pencarian -->
    <form method="GET" action="">
        <select name="search_id">
            <option value="">Pilih Filter Pencarian...</option>
            <option value="nim">NIM Mahasiswa</option>
            <option value="nama">Nama Mahasiswa</option>
            <option value="jurusan">Jurusan</option>
            <option value="fakultas">Fakultas</option>
            <option value="angkatan">Angkatan</option>
            <option value="jenis_kelamin">Jenis Kelamin</option>
        </select>
        <input type="text" name="search_keyword" placeholder="Cari...">
        <input type="submit" value="Cari">
        <a href="addmahasiswa.php" style="margin-left: 10px;"><button type="button" class="tambah-data-btn">Add New</button>
</a>
        </a>
    </form>

    <table border="1">
        <tr>
            <th>No</th>
            <th>Id</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
            <th>Fakultas</th>
            <th>Angkatan</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>No. HP</th>
            <th colspan="2">Aksi</th>
        </tr>
        <?php
        include 'php/config.php'; // Include your database connection file

        $No = 1;
        $query = "SELECT * FROM students WHERE 1=1";

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
                <td>" . $tampil['id'] . "</td>
                <td>" . $tampil['nim'] . "</td>
                <td>" . $tampil['nama'] . "</td>
                <td>" . $tampil['email'] . "</td>
                <td>" . $tampil['jurusan'] . "</td>
                <td>" . $tampil['fakultas'] . "</td>
                <td>" . $tampil['angkatan'] . "</td>
                <td>" . $tampil['jenis_kelamin'] . "</td>
                <td>" . $tampil['alamat'] . "</td>
                <td>" . $tampil['no_hp'] . "</td>
                <td><button><a href='editmahasiswa.php?id=" . $tampil['id'] . "'>Edit</a></button></td>
                <td><button><a href='databasemahasiswa.php?id=" . $tampil['id'] . "' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\">Hapus</a></button></td>
            </tr>";
        }
        ?>
    </table>
    <?php
    // Proses hapus data
    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($con, $_GET['id']);
        mysqli_query($con, "DELETE FROM students WHERE id='$id'");
        echo "Data Berhasil Dihapus";
        echo "<meta http-equiv='refresh' content='2;URL=databasemahasiswa.php'>";
    }
    ?>
</div>
</body>
</html>
