<?php
include '../config/db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_notifikasi = $_GET['id'];

    $query = "DELETE FROM notifikasi WHERE id_notifikasi = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_notifikasi);

    if ($stmt->execute()) {
        header("Location: ../notifikasi.php?status=hapus-berhasil");
    } else {
        echo "Gagal menghapus notifikasi: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "ID notifikasi tidak valid.";
}
?>
