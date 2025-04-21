<?php
include '../config/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Notifikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container my-4">
        <h3>Tambah Notifikasi</h3>
        <form action="proses_tambah_notifikasi.php" method="POST">
            <div class="mb-3">
                <label for="pesan" class="form-label">Pesan</label>
                <textarea name="pesan" id="pesan" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="tggl_pengiriman" class="form-label">Tanggal Pengiriman</label>
                <input type="datetime-local" name="tggl_pengiriman" id="tggl_pengiriman" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="klasifikasi" class="form-label">Klasifikasi</label>
                <select name="klasifikasi" id="klasifikasi" class="form-control" required>
                    <option value="Penting">Penting</option>
                    <option value="Informasi">Informasi</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="penerima" class="form-label">Penerima</label>
                <select name="penerima" id="penerima" class="form-control" required>
                    <option value="Siswa">Siswa</option>
                    <option value="Guru">Guru</option>
                    <option value="Orang_tua">Orang Tua</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Simpan Notifikasi</button>
            <a href="../notifikasi.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
