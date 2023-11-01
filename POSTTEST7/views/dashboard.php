<?php
    session_start();
    require "../aksi/koneksi.php";

    if (!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }

    $result = mysqli_query($conn, "SELECT * FROM destinasi");
    $destinasi = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $destinasi[] = $row;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <div class="dashboard">
        <nav class="dash-side-bar">
            <img src="../assets/logo.png" alt="">
            <div class="settings">
                <img src="" alt="">
                <p>Pengaturan</p>
            </div>
        </nav>
        <main class="dash-container">
            <section class="dash-nav-bar">
                <div class="dash-nav-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M160-200v-80h80v-280q0-83 50-147.5T420-792v-28q0-25 17.5-42.5T480-880q25 0 42.5 17.5T540-820v28q80 20 130 84.5T720-560v280h80v80H160Zm320-300Zm0 420q-33 0-56.5-23.5T400-160h160q0 33-23.5 56.5T480-80ZM320-280h320v-280q0-66-47-113t-113-47q-66 0-113 47t-47 113v280Z"/></svg>
                </div>
                <div class="dash-account">
                    <img src="" alt="">
                    <p></p>
                    <a href= logout.php>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-345 240-585l56-56 184 184 184-184 56 56-240 240Z"/></svg>
                    </a>
                </div>
            </section>
            <section class="dash-main">
                <h1>DASHBOARD ADMIN</h1>
                <p>Current Date : <?php echo date('l, d F Y')?></p><br>
                <hr><br>
                <div class="leading-btn">
                    <a href="add.php"><button class="add-btn">Tambah</button></a>
                    <button class="history-btn" onclick="alert('TBA!')">Histori</button>
                </div><br>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($destinasi as $dst) :?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $dst['nama']; ?></td>
                            <td><?php echo $dst['deskripsi']; ?></td>
                            <td><?php echo $dst['harga']; ?></td>
                            <td><img src="../img/<?php echo $dst['foto']; ?>" alt="" height="100px"></td>
                            <td class="action">
                                <a href="edit.php?id=<?php echo $dst['id']?>"><button class="edit-btn"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" fill="white"><path d="M200-200h56l345-345-56-56-345 345v56Zm572-403L602-771l56-56q23-23 56.5-23t56.5 23l56 56q23 23 24 55.5T829-660l-57 57Zm-58 59L290-120H120v-170l424-424 170 170Zm-141-29-28-28 56 56-28-28Z"/></svg></button></a>
                                <a href="delete.php?id=<?php echo $dst['id']?>"><button class="delete-btn" onclick="confirm('Yakin ingin menghapus <?php echo $dst['nama']?>?')"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" fill="white"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg></button></a>
                            </td>
                        </tr>
                        <?php $i++; endforeach; ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>