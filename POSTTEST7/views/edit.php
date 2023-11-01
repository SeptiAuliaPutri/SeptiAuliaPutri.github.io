<?php
    require "../aksi/koneksi.php";
    
    $id = $_GET['id'];

    $get = mysqli_query($conn, "SELECT * FROM destinasi WHERE id = $id");
    $get_foto = mysqli_query($conn, "SELECT foto FROM destinasi WHERE id = $id");

    $destinasi = [];

    while ($row = mysqli_fetch_assoc($get)) {
        $destinasi[] = $row;
    }

    $destinasi = $destinasi[0];

    
    if (isset($_POST['ubah'])) {
        $nama = $_POST['nama'];
        $deskripsi = $_POST['deskripsi'];
        $harga = $_POST['harga'];
        $foto = $_FILES['foto']['name'];
        $x = explode('.', $foto);
        $ekstensi = strtolower(end($x));

        $new_foto = "$nama.$ekstensi";
        $tmp = $_FILES['foto']['tmp_name'];

        
        $data_old = mysqli_fetch_array($get_foto);
        unlink("img/".$data_old['foto']);

        if (move_uploaded_file($tmp, "../img/".$new_foto)) {
            $result = mysqli_query($conn, "UPDATE destinasi SET nama='$nama', deskripsi='$deskripsi', harga='$harga', foto='$new_foto' WHERE id = $id");

            if ($result) {
                echo "
                <script>
                    alert('Data berhasil diubah!');
                    document.location.href = 'dashboard.php';
                </script>";
            } else {
                echo "
                <script>
                    alert('Data gagal diubah!');
                </script>";
            }

        } else {
            echo "
            <script>
                alert('Data gagal diubah!');
            </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <section class="add-data">
        <div class="add-form-container">
            <h1>Edit Data</h1><hr><br>
            <form action="" method="post" enctype="multipart/form-data">
                <label for="nama">Nama</label>
                <input type="text" name="nama" value="<?php echo $destinasi['nama'] ?>" class="textfield">
                <label for="deskripsi">Deskripsi</label>
                <input type="text" name="deskripsi" value="<?php echo $destinasi['deskripsi'] ?>" class="textfield">
                <label for="harga">Harga</label>
                <input type="text" name="harga" value="<?php echo $destinasi['harga'] ?>" class="textfield">
                <label for="foto">Foto</label>
                <input type="file" name="foto" class="textfield">
                <input type="submit" name="ubah" value="Edit Data" class="login-btn">
            </form>
        </div>
    </section>
</body>
</html>