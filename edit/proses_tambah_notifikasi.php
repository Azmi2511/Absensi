<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pesan = $_POST['pesan'];
    $tggl_pengiriman = $_POST['tggl_pengiriman'];
    $klasifikasi = $_POST['klasifikasi'];
    $penerima = $_POST['penerima'];

    $query = "INSERT INTO notifikasi (pesan, tggl_pengiriman, klasifikasi, penerima) 
                VALUES ('$pesan', '$tggl_pengiriman', '$klasifikasi', '$penerima')";
    
    if ($conn->query($query)) {
        header("Location: ../notifikasi.php?status=berhasil");
    } else {
        echo "Gagal menambahkan notifikasi: " . $conn->error;
    }
}
?>
