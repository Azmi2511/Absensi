<?php include '../config/db.php'; ?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Update query untuk menandai siswa sebagai terhapus (soft delete)
    $query = "UPDATE siswa SET is_delete = 1 WHERE id_siswa = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();

    // Redirect ke halaman utama setelah proses update
    header('Location: ../siswa.php');
}
?>
