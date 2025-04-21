<?php include '../config/db.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kelas = $_POST['nama_kelas'];
    $jumlah_siswa = $_POST['jumlah_siswa'];

    $query = "INSERT INTO kelas (nama_kelas, jumlah_siswa) 
                VALUES ('$nama_kelas', '$jumlah_siswa')";
    if ($conn->query($query)) {
        header("Location: ../kelas.php?status=berhasil");
    } else {
        echo "Gagal menambahkan data kelas: " . $conn->error;
    }
}
?>
