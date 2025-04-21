<?php include '../config/db.php'; ?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM siswa WHERE id_siswa = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h3 class="my-4">Edit Data Siswa</h3>
        <form action="proses_edit_siswa.php" method="POST">
            <input type="hidden" name="id_siswa" value="<?= $row['id_siswa']; ?>">
            <div class="mb-3">
                <label for="nama_siswa" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= $row['nama_siswa']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nis" class="form-label">NIS</label>
                <input type="text" class="form-control" id="nis" name="nis" value="<?= $row['nis']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="id_kelas" class="form-label">Kelas</label>
                <input type="text" class="form-control" id="id_kelas" name="id_kelas" value="<?= $row['id_kelas']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="L" <?= $row['jenis_kelamin'] == 'L' ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="P" <?= $row['jenis_kelamin'] == 'P' ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" required><?= $row['alamat']; ?></textarea>
            </div>
            <!-- Tombol Submit yang lebih baik -->
            <button type="submit" class="btn btn-success btn-lg">Simpan Perubahan</button>
            <a href="../siswa.php" class="btn btn-secondary btn-lg">Kembali</a>
        </form>
    </div>
</body>
</html>
