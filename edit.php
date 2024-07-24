<?php
include 'php/config.php';
if (isset($_GET['eamil'])) {
    $email = $_GET['email'];
    $query = mysqli_query($con, "SELECT * FROM users WHERE email='$email'");
    $data = mysqli_fetch_array($query);
}
if (isset($_POST['update'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    mysqli_query($con, "UPDATE users SET email='$email', username='$username', password='$password' WHERE email='$email'");
    header("Location: databasedosen.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/editmahasiswa.css">
    <title>Edit Dosen</title>
</head>
<body>
    <h3>Edit Akun</h3>
    <form method="POST" action="">
        <input type="hidden" name="email" value="<?php echo $data['email']; ?>">
        <label>Username:</label>
        <input type="text" name="username" value="<?php echo $data['username']; ?>"><br>
        <label>Password:</label>
        <input type="password" name="password" value="<?php echo $data['password']; ?>"><br>
                <input type="submit" name="update" value="Update">
    </form>
</body>
</html>
