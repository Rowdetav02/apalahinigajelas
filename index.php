<?php
session_start();
if (isset($_SESSION['email'])) {
    // Redirect based on stored user role in the session
    $level = $_SESSION['level'] ?? '';
    if ($role === 'Admin') {
        header("Location: homeadmin.php");
    } elseif ($role === 'Dosen') {
        header("Location: homedosen.php");
    } else {
        header("Location: homemahasiswa.php");
    }
    exit();
}

include("php/config.php");

$email = "";
$password = "";
$err = ""; // Initialize $err as an empty string.

if (isset($_POST['login'])) { // Correct the spelling of 'isset'.
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if ($email == '' || $password == '') { // Use logical OR `||` instead of `or`.
        $err .= "<li>Silahkan Masukkan Email dan Password</li>";
    }
    
    if (empty($err)) {
        $sql1 = "SELECT * FROM users WHERE email = ?";
        $stmt = $con->prepare($sql1); // Use prepared statements to avoid SQL injection
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $r1 = $result->fetch_assoc();

        if (!$r1 || md5($password) != $r1['password']) { // Check if user exists and password matches
            $err .= "<li>Akun tidak ditemukan</li>";
        } else {
            // Successful login
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $r1['level']; // Store user role in session

            // Redirect based on user role
            if ($r1['level'] === 'Dosen') {
                header("Location: homedosen.php");
            } elseif ($r1['level'] === 'Mahasiswa') {
                header("Location: homemahasiswa.php");
            } else {
                header("Location: homeadmin.php");
            }
            exit();
        }
        
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="./style.css">
</head>
<body>
    <section class="container">
        <div class="login-container">
            <div class="circle circle-one"></div>
            <div class="form-container">
                <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
                <h1 class="opacity">LOGIN</h1>

                <form method="post" action="">
                    <?php if (!empty($err)) echo "<ul>$err</ul>"; ?>
                    <input type="text" name="email" class="input" placeholder="EMAIL" value="<?php echo htmlspecialchars($email); ?>" />
                    <input type="password" name="password" class="input" placeholder="PASSWORD" />
                    <button type="submit" name="login" class="opacity">LOGIN</button>
                    <button><a href="register.php">REGISTER</a></button>
                </form>
            </div>
            <div class="circle circle-two"></div>
        </div>
        <div class="theme-btn-container"></div>
    </section>

    <script src="./script.js"></script>
</body>
</html>
