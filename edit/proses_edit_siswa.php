<?php
include '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id_siswa'];
    $nama = $_POST['nama_siswa'];
    $nis = $_POST['nis'];
    $kelas = $_POST['id_kelas'];
    $jk = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];

    $stmt = $conn->prepare("UPDATE siswa SET nama_siswa = ?, nis = ?, id_kelas = ?, jenis_kelamin = ?, alamat = ? WHERE id_siswa = ?");
    $stmt->bind_param("sssssi", $nama, $nis, $kelas, $jk, $alamat, $id);

    if ($stmt->execute()) {
        header("Location: ../siswa.php"); // Kembali ke halaman utama siswa setelah sukses
        exit();
    } else {
        echo "Gagal memperbarui data: " . $stmt->error;
    }
}
?>
