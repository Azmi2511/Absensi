<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_kehadiran = $_POST['id_kehadiran'];
    $id_siswa = $_POST['id_siswa'];
    $tanggal = $_POST['tanggal_kehadiran'];
    $status = $_POST['status'];

    // Query untuk mengupdate data kehadiran berdasarkan ID kehadiran yang dipilih
    $query = "UPDATE kehadiran SET id_siswa = '$id_siswa', tanggal_kehadiran = '$tanggal', status = '$status' WHERE id_kehadiran = '$id_kehadiran'";
    if ($conn->query($query)) {
        // Jika sukses, arahkan kembali ke halaman kehadiran
        header("Location: ../kehadiran.php?status=berhasil");
    } else {
        echo "Gagal mengedit data kehadiran: " . $conn->error;
    }
}
?>
