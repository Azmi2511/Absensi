<?php include '../config/db.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_kelas = $_POST['id_kelas'];
    $nama_kelas = $_POST['nama_kelas'];
    $jumlah_siswa = $_POST['jumlah_siswa'];

    $query = "UPDATE kelas SET nama_kelas = '$nama_kelas', jumlah_siswa = '$jumlah_siswa' WHERE id_kelas = '$id_kelas'";
    if ($conn->query($query)) {
        header("Location: ../kelas.php?status=berhasil");
    } else {
        echo "Gagal mengedit data kelas: " . $conn->error;
    }
}
?>
