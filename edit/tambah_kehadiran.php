<?php
include '../config/db.php';

// Mengambil daftar siswa dari database untuk dropdown
$query_siswa = "SELECT * FROM siswa";
$result_siswa = $conn->query($query_siswa);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tambah Kehadiran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/style.css"> <!-- Perbaiki path ke file CSS -->
</head>
<body>
    <div class="container my-4">
        <h3>Tambah Kehadiran</h3>
        <form action="proses_tambah_kehadiran.php" method="POST"> <!-- Perbaiki action path -->
            <div class="mb-3">
                <label for="id_siswa" class="form-label">Nama Siswa</label>
                <select name="id_siswa" id="id_siswa" class="form-control" required>
                    <option value="">Pilih Siswa</option>
                    <?php while ($row = $result_siswa->fetch_assoc()) { ?>
                        <option value="<?= $row['id_siswa']; ?>"><?= htmlspecialchars($row['nama_siswa']); ?></option> <!-- Menghindari XSS -->
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="tanggal_kehadiran" class="form-label">Tanggal Kehadiran</label>
                <input type="date" name="tanggal_kehadiran" id="tanggal_kehadiran" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status Kehadiran</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="">Pilih Status Kehadiran</option>
                    <option value="Hadir">Hadir</option>
                    <option value="Tidak Hadir">Tidak Hadir</option>
                    <option value="Tidak Hadir">Sakit</option>
                    <option value="Tidak Hadir">Izin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Simpan Kehadiran</button>
            <a href="../kehadiran.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>