<?php
include '../config/db.php';?>
<?php

if (isset($_GET['id'])) {
    $id_siswa = $_GET['id'];

    // Query untuk mengembalikan siswa yang dipilih
    $query = "UPDATE siswa SET is_delete = 0 WHERE id_siswa = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_siswa);

    if ($stmt->execute()) {
        echo "<script>alert('Data siswa berhasil dipulihkan!'); window.location='restore_siswa.php';</script>";
    } else {
        echo "<script>alert('Gagal memulihkan data siswa.'); window.location='restore_siswa.php';</script>";
    }
} else {
    echo "<script>alert('ID Siswa tidak ditemukan.'); window.location='restore_siswa.php';</script>";
}
?>
