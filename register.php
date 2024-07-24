<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">

        <?php 
        include("php/config.php");

        if(isset($_POST['submit'])){
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = md5($_POST['password']); 
            $level = $_POST['level'];

            // Verifying the unique email
            $verify_query = "SELECT email FROM users WHERE email='$email'";
            $result = mysqli_query($con, $verify_query);

            if($result === false) {
                echo "Error: " . mysqli_error($con);
            } else {
                if(mysqli_num_rows($result) != 0) {
                    echo "<div class='message'>
                            <p>This email is used, Try another One Please!</p>
                          </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
                } else {
                    $insert_query = "INSERT INTO users (email, username, password, level) VALUES ('$email', '$username', '$password', '$level')";
                    
                    if (mysqli_query($con, $insert_query)) {
                        echo "<div class='message'>
                                <p>Registration successfully!</p>
                              </div> <br>";
                        echo "<a href='index.php'><button class='btn'>Login Now</button></a>";
                    } else {
                        echo "Error: " . $insert_query . "<br>" . mysqli_error($con);
                    }
                }
            }
        } else {
        ?>

            <header>Sign Up</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="namapengguna">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field input">
                <label for="jenispublikasi">Level</label>
                <select name="level" required>
                    <option value="Admin">Admin</option>
                    <option value="Dosen">Dosen</option>
                    <option value="Mahasiswa">Mahasiswa</option>
                </select>
            </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    Already a member? <a href="index.php">Sign In</a>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>
