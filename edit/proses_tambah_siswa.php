<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama           = $_POST['nama'];
    $nis            = $_POST['nis'];
    $jenis_kelamin  = $_POST['jenis_kelamin'];
    $tanggal_lahir  = $_POST['tanggal_lahir'];
    $alamat         = $_POST['alamat'];
    $id_kelas       = $_POST['id_kelas'];

    $query = "INSERT INTO siswa (nama_siswa, nis, jenis_kelamin, tanggal_lahir, alamat, id_kelas) 
              VALUES ('$nama', '$nis', '$jenis_kelamin', '$tanggal_lahir', '$alamat', '$id_kelas')";

    if ($conn->query($query)) {
        header("Location: ../siswa.php?status=berhasil");
    } else {
        echo "Gagal menambahkan data siswa: " . $conn->error;
    }
}
?>
