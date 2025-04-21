<?php
include '../config/db.php';

if (isset($_GET['id'])) {
    $id_guru = $_GET['id'];

    // Cek apakah data guru dengan id tersebut ada di database
    $query = "SELECT * FROM guru WHERE id_guru = '$id_guru' AND is_delete = 1";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Update is_delete menjadi 0 untuk restore data
        $restoreQuery = "UPDATE guru SET is_delete = 0 WHERE id_guru = '$id_guru'";
        if ($conn->query($restoreQuery)) {
            // Jika berhasil, alihkan ke halaman daftar guru
            echo "<script>alert('Data guru berhasil dipulihkan.'); window.location.href = 'restore_guru.php';</script>";
        } else {
            // Jika gagal, tampilkan pesan error
            echo "<script>alert('Gagal memulihkan data guru.'); window.location.href = 'restore_guru.php';</script>";
        }
    } else {
        // Jika data tidak ditemukan
        echo "<script>alert('Data guru tidak ditemukan atau sudah dipulihkan sebelumnya.'); window.location.href = 'restore_guru.php';</script>";
    }
} else {
    // Jika id tidak ditemukan dalam URL
    echo "<script>alert('ID guru tidak valid.'); window.location.href = 'restore_guru.php';</script>";
}
?>
