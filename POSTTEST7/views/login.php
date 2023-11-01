<?php
session_start();
require "../aksi/koneksi.php";

if (isset($_POST["masuk"])) {
    $username = strtolower($_POST["username"]);
    $pass = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM regis WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);

        if (password_verify($pass, $row["password"])){
            $_SESSION['login'] = true;

            header("Location: dashboard.php");
            exit;
        }
        else {
            echo "Gagal Masuk";
        }
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelScapeXplorer</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <section class ="more" id="more">
        <div class="form">
        <img src="../assets/banner.png" alt="">
            <div class="box form-box">
                <header>Login</header>
                <?php
                if (isset ($error)) {
                    echo "<p style = 'color : red;'>USERNAME ATAU PASSWORD SALAH</p>";
                }
                ?>
                <form action="" method="post">
                    <div class="field input">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" required>
                    </div>
                    <div class="field input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                    <div class="remember">
                    <h5>Apakah anda sudah punya akun? </h5> <a href = "../views/regis.php">Register</a>
                    </div>
                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Login">
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
