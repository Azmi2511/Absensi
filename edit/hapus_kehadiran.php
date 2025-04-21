<?php
include '../config/db.php';

// Cek apakah ada ID yang diberikan
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Mendapatkan ID kehadiran yang akan dihapus
    $id_kehadiran = $_GET['id'];

    // Menyiapkan query untuk menghapus data kehadiran berdasarkan ID
    $query = "DELETE FROM kehadiran WHERE id_kehadiran = ?";
    $stmt = $conn->prepare($query);

    // Mengikat parameter ke dalam prepared statement
    $stmt->bind_param("i", $id_kehadiran);

    // Mengeksekusi statement
    if ($stmt->execute()) {
        // Jika berhasil menghapus, arahkan kembali ke halaman kehadiran
        header("Location: ../kehadiran.php?status=hapus-berhasil");
    } else {
        echo "Gagal menghapus data kehadiran: " . $stmt->error;
    }

    // Menutup statement
    $stmt->close();
} else {
    echo "ID kehadiran tidak valid.";
}
?>
