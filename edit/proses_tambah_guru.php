<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama           = $_POST['nama'];
    $nip            = $_POST['nip'];
    $jenis_kelamin  = $_POST['jenis_kelamin'];
    $tanggal_lahir  = $_POST['tanggal_lahir'];
    $alamat         = $_POST['alamat'];

    $query = "INSERT INTO guru (nama_guru, nip, jenis_kelamin, tanggal_lahir, alamat) 
              VALUES ('$nama', '$nip', '$jenis_kelamin', '$tanggal_lahir', '$alamat')";

    if ($conn->query($query)) {
        header("Location: ../guru.php?status=berhasil");
    } else {
        echo "Gagal menambahkan data guru: " . $conn->error;
    }
}
?>
