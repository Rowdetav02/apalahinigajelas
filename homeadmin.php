<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/adminstyle.css">
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

        <aside class="sidebar">
            <ul>
                <li><a href="edit.php">Ganti Password</a></li>
                <li><a href="databasemahasiswa.php">Daftar Mahasiswa</a></li>
                <li><a href="databasedosen.php">Daftar Dosen</a></li>
                <li><a href="databasematkul.php">Daftar Matkul</a></li>
                <li><a href="databasenilai.php">Rekap Nilai</a></li>

            </ul>
        </aside>

        <main class="main-box">
            <h1>Welcome to SIKULI</h1>
            <p>Here you can manage various aspects of the academic system. Use the sidebar to navigate to different sections.</p>
            <!-- Add more content here as needed -->
        </main>
    </div>
</body>
</html>

