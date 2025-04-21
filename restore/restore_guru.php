<?php include '../config/db.php'; ?>
<?php
// Query untuk mengambil guru yang terhapus
$query = "SELECT * FROM guru WHERE is_delete = 1";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Restore Data Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h3 class="my-4">Restore Data Guru</h3>

        <div class="card p-4 mb-4">
            <h5>Daftar Guru yang Terhapus</h5>
            <div class="table-responsive">
                <table class="table table-striped table-bordered mt-3">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
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
                                        <td>{$row['nama_guru']}</td>
                                        <td>{$row['nip']}</td>
                                        <td>{$row['jenis_kelamin']}</td>
                                        <td>{$row['tanggal_lahir']}</td>
                                        <td>{$row['alamat']}</td>
                                        <td>
                                            <a href='restore_single_guru.php?id={$row['id_guru']}' class='btn btn-success btn-sm'>Restore</a>
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

        <a href="../guru.php" class="btn btn-secondary btn-lg">Kembali</a>
    </div>
</body>
</html>
