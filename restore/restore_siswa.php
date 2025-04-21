<?php include '../config/db.php'; ?>
<?php
// Query untuk mengambil siswa yang terhapus beserta nama_kelas
$query = "SELECT siswa.*, kelas.nama_kelas FROM siswa INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas 
          WHERE siswa.is_delete = 1";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Restore Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h3 class="my-4">Restore Data Siswa</h3>
        
        <div class="card p-4 mb-4">
            <h5>Daftar Siswa yang Terhapus</h5>
            <div class="table-responsive">
                <table class="table table-striped table-bordered mt-3">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>Kelas</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            $no = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>$no</td>
                                        <td>{$row['nama_siswa']}</td>
                                        <td>{$row['nis']}</td>
                                        <td>{$row['nama_kelas']}</td>
                                        <td>{$row['jenis_kelamin']}</td>
                                        <td>{$row['alamat']}</td>
                                        <td>
                                            <a href='restore_single_siswa.php?id={$row['id_siswa']}' class='btn btn-success btn-sm'>Restore</a>
                                        </td>
                                    </tr>";
                                $no++;
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>Tidak ada data yang terhapus.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <a href="../siswa.php" class="btn btn-secondary btn-lg">Kembali</a>
    </div>
</body>
</html>
