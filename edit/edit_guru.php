<?php include '../config/db.php'; ?>

<?php
if (isset($_GET['id'])) {
    $id_guru = $_GET['id'];
    $query = "SELECT * FROM guru WHERE id_guru = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id_guru);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Data Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container mt-4">
        <h3>Edit Data Guru</h3>
        <form action="proses_edit_guru.php" method="POST">
            <input type="hidden" name="id_guru" value="<?= $row['id_guru']; ?>">
            <div class="mb-3">
                <label for="nama_guru" class="form-label">Nama Guru</label>
                <input type="text" class="form-control" id="nama_guru" name="nama_guru" value="<?= $row['nama_guru']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="text" class="form-control" id="nip" name="nip" value="<?= $row['nip']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-laki" <?= $row['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="Perempuan" <?= $row['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $row['tanggal_lahir']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" required><?= $row['alamat']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-success btn-lg">Simpan Perubahan</button>
            <a href="../guru.php" class="btn btn-secondary btn-lg">Kembali</a>
        </form>
    </div>
</body>
</html>
