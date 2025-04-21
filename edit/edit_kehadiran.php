<?php include '../config/db.php'; ?>

<?php
$id_kehadiran = $_GET['id'];
$query = "SELECT * FROM kehadiran WHERE id_kehadiran = '$id_kehadiran'";
$result = $conn->query($query);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Kehadiran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container py-4">
        <h3>Edit Kehadiran</h3>
        <form action="proses_edit_kehadiran.php" method="POST">
            <input type="hidden" name="id_kehadiran" value="<?= $row['id_kehadiran']; ?>">
            <div class="mb-3">
                <label for="id_siswa">Nama Siswa</label>
                <select name="id_siswa" class="form-control" required>
                    <?php
                    $query_siswa = "SELECT * FROM siswa";
                    $result_siswa = $conn->query($query_siswa);
                    while ($siswa = $result_siswa->fetch_assoc()) {
                        $selected = $siswa['id_siswa'] == $row['id_siswa'] ? 'selected' : '';
                        echo "<option value='{$siswa['id_siswa']}' $selected>{$siswa['nama_siswa']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="tanggal">Tanggal Kehadiran</label>
                <input type="date" name="tanggal_kehadiran" value="<?= $row['tanggal_kehadiran']; ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="status">Status Kehadiran</label>
                <select name="status" class="form-control" required>
                    <option value="Hadir" <?= $row['status'] == 'Hadir' ? 'selected' : ''; ?>>Hadir</option>
                    <option value="Alpa" <?= $row['status'] == 'Alpa' ? 'selected' : ''; ?>>Alpa</option>
                    <option value="Sakit" <?= $row['status'] == 'Sakit' ? 'selected' : ''; ?>>Sakit</option>
                    <option value="Izin" <?= $row['status'] == 'Izin' ? 'selected' : ''; ?>>Izin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="../kehadiran.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
