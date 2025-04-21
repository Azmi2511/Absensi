<?php
include '../config/db.php';

// Pastikan bahwa data yang diterima dari form menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data yang dikirim melalui form
    $id_guru = $_POST['id_guru'];
    $nama_guru = $_POST['nama_guru'];
    $nip = $_POST['nip'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];

    // Menyiapkan query untuk memperbarui data guru
    $query = "UPDATE guru SET 
                nama_guru = ?, 
                nip = ?, 
                jenis_kelamin = ?, 
                tanggal_lahir = ?, 
                alamat = ? 
                WHERE id_guru = ?";

    // Menggunakan prepared statement untuk menghindari SQL injection
    if ($stmt = $conn->prepare($query)) {
        // Mengikat parameter ke query
        $stmt->bind_param('sssssi', $nama_guru, $nip, $jenis_kelamin, $tanggal_lahir, $alamat, $id_guru);

        // Menjalankan query dan memeriksa apakah berhasil
        if ($stmt->execute()) {
            // Jika berhasil, beri pesan sukses dan redirect ke halaman guru
            echo "<script>alert('Data guru berhasil diperbarui.'); window.location.href = '../guru.php';</script>";
        } else {
            // Jika gagal, beri pesan error
            echo "<script>alert('Gagal memperbarui data guru.'); window.location.href = '../guru.php';</script>";
        }

        // Menutup prepared statement
        $stmt->close();
    } else {
        // Jika terjadi kesalahan saat menyiapkan query
        echo "<script>alert('Terjadi kesalahan pada server.'); window.location.href = '../guru.php';</script>";
    }
} else {
    // Jika request method bukan POST, redirect ke halaman guru
    echo "<script>window.location.href = '../guru.php';</script>";
}
?>