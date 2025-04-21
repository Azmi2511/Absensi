<?php
include '../config/db.php';

if (isset($_GET['id'])) {
    $id_guru = $_GET['id'];

    $query = "UPDATE guru SET is_delete = 1 WHERE id_guru = '$id_guru'";
    if ($conn->query($query)) {
        echo "<script>alert('Data guru berhasil dihapus.'); window.location.href = '../guru.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data.'); window.location.href = '../guru.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak valid.'); window.location.href = '../guru.php';</script>";
}
?>
