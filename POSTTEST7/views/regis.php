<?php
require "../aksi/koneksi.php";

if (isset($_POST["regis"])) {
    $username = strtolower($_POST["username"]);
    $pass = $_POST["password"];
    $email = $_POST["email"];
    $cpassword = $_POST["cpassword"];

    if ($pass === $cpassword){
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $result = mysqli_query($conn, "SELECT username FROM regis WHERE username = '$username'");

        if (mysqli_fetch_assoc($result)){
            echo "
            <script>
                alert('Username telah digunakan!');
                document.location.href = 'regis.php';
            </script>";
        }
        else {
            $sql = "INSERT INTO regis VALUES ('', '$username', '$pass', '$email')"; 
            $result = mysqli_query($conn, $sql);
    
            if (mysqli_affected_rows($conn) > 0){
                echo"
                <script>
                    alert('Registrasi Berhasil!');
                    document.location.href = 'login.php';
                </script>";
            }
            else {
                echo"
                <script>
                    alert('Registrasi Gagal!');
                    document.location.href ='regis.php';
                </script>";
            }
        }
    }    
    else {
    echo"
    <script>
        alert('Password tidak sama']);
        document.location.href ='regis.php';
    </script>";
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Universitas Mulawarman</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <div class="form">
        <div class="form-container">
            <h1>Registrasi</h1><hr>
            <form action="" method="POST">
                <input type="text" name="username" placeholder="Username" class="textfield" required>
                <input type="password" name="password" placeholder="Password" class="textfield" required>
                <input type="email" name="email" placeholder="Email" class="textfield" required>
                <input type="password" name="cpassword" id ="cpassword" placeholder="Konfirmasi Password" autocomplete = "off" class="textfield" required>
                <input type="submit" name="regis" value = "Daftar"class="login-btn">
            </form>
        </div>
    </div>
</body>
</html>