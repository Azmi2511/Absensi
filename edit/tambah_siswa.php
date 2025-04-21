<?php include '../config/db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="container py-4">
    <h3>Tambah Siswa</h3>
    <form action="proses_tambah_siswa.php" method="POST">
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>NIS</label>
            <input type="text" name="nis" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="">Pilih</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Kelas</label>
            <select name="id_kelas" class="form-control" required>
                <?php
                $query = "SELECT * FROM kelas";
                $result = $conn->query($query);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id_kelas']}'>{$row['nama_kelas']}</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="../siswa.php" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>
