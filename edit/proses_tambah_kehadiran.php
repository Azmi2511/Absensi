<?php
include '../config/db.php';

// Cek apakah request method adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari form
    $id_siswa = $_POST['id_siswa'];
    $tanggal = $_POST['tanggal_kehadiran'];
    $status = $_POST['status'];

    // Validasi input
    if (empty($id_siswa) || empty($tanggal) || empty($status)) {
        echo "Semua field harus diisi.";
        exit;
    }

    // Query untuk memasukkan data ke dalam tabel kehadiran dengan menggunakan prepared statements
    $query = $conn->prepare("INSERT INTO kehadiran (id_siswa, tanggal_kehadiran, status) VALUES (?, ?, ?)");
    $query->bind_param("iss", $id_siswa, $tanggal, $status);

    // Eksekusi query
    if ($query->execute()) {
        // Jika berhasil, redirect ke halaman kehadiran dengan status=berhasil
        header("Location: ../kehadiran.php?status=berhasil");
        exit;
    } else {
        // Menampilkan error jika gagal
        echo "Gagal menambahkan data kehadiran: " . $query->error;
    }

    // Menutup prepared statement
    $query->close();
}
?>
