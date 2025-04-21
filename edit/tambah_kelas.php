<?php include '../config/db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="container py-4">
    <h3>Tambah Kelas</h3>
    <form action="proses_tambah_kelas.php" method="POST">
        <div class="mb-3">
            <label>Nama Kelas</label>
            <input type="text" name="nama_kelas" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jumlah Siswa</label>
            <input type="number" name="jumlah_siswa" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="../kelas.php" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>
