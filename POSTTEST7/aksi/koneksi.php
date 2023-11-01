<?php

$host = "localhost";
$user = "root";
$pass = "" ;
$db = "posttest5";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Gagal Terhubung".mysqli_connect_error());
}

?>