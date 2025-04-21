<?php
include 'config/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Data Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
                <div class="position-sticky p-3 text-white">
                    <div class="text-center mb-4">
                    <img src="images/Profile.jpg" class="rounded-circle" height="60" alt="Foto Admin">
                    <h6 class="mt-2">Zul Azmi, S.Tr.Kom</h6>
                    <span class="badge bg-primary">Admin</span>
                    <?php date_default_timezone_set('Asia/Jakarta'); ?>
                    <p class="text-white-50 small mt-2">Tanggal: <?= date('d M Y'); ?></p>
                    <p id="jam" class="text-white-50 small">Jam: <?= date('H:i'); ?> WIB</p>
                    </div>
                    <button class="btn btn-outline-secondary d-md-none mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                        <i class="fas fa-bars"></i> Menu
                    </button>
                    <ul class="nav flex-column">
                    <li class="nav-item"><a href="dashboard.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">Dashboard</a></li>
                    <li class="nav-item"><a href="guru.php" class="nav-link text-white">Data Guru</a></li>
                    <li class="nav-item"><a href="siswa.php" class="nav-link text-white">Data Siswa</a></li>
                    <li class="nav-item"><a href="kelas.php" class="nav-link text-white">Data Kelas</a></li>
                    <li class="nav-item"><a href="kehadiran.php" class="nav-link text-white">Kehadiran</a></li>
                    <li class="nav-item"><a href="notifikasi.php" class="nav-link text-white">Notifikasi</a></li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 ms-sm-auto px-4">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-4 border-bottom">
                    <div class="d-flex align-items-center">
                        <img src="images/logo.jpg" alt="Logo" style="height: 50px;">
                        <h4 class="ms-3 mb-0">Sistem Absensi SMAN 1 Bantan</h4>
                    </div>
                    <!-- Input search yang responsif -->
                    <input type="text" class="form-control w-25 w-sm-100" placeholder="Cari...">
                </div>

                <!-- Tombol Menu untuk tampilan mobile -->
                <button class="btn btn-outline-secondary d-md-none mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i> Menu
                </button>
                <!-- Tabel Data Guru -->
                <div class="card p-4 mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">Daftar Guru</h5>
                        <div class="d-flex gap-2">
                            <a href="edit/tambah_guru.php" class="btn btn-primary">+ Tambah Guru</a>
                            <a href="restore/restore_guru.php" class="btn btn-success">Restore</a>
                        </div>
                    </div>
                    <!-- Tabel Data dengan Responsif -->
                    <div class="table-responsive">
                        <table id="tabelSiswa" class="table table-striped table-bordered mt-3">
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
                                $no = 1;
                                $query = "SELECT * FROM guru WHERE is_delete = 0";
                                $result = $conn->query($query);
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>$no</td>
                                            <td>{$row['nama_guru']}</td>
                                            <td>{$row['nip']}</td>
                                            <td>{$row['jenis_kelamin']}</td>
                                            <td>{$row['tanggal_lahir']}</td>
                                            <td>{$row['alamat']}</td>
                                            <td>
                                                <a href='edit/edit_guru.php?id={$row['id_guru']}' class='btn btn-warning btn-sm'>Edit</a>
                                                <a href='edit/hapus_guru.php?id={$row['id_guru']}' class='btn btn-danger btn-sm'>Hapus</a>
                                            </td>
                                        </tr>";
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        setInterval(() => {
            const now = new Date();
            const jam = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
            document.getElementById("jam").innerText = "Jam: " + jam + " WIB";
        }, 1000);

        $(document).ready(function () {
            $('table').DataTable();
        });

        if (!$.fn.DataTable.isDataTable('#tabelSiswa')) {
            $('#tabelSiswa').DataTable({
                "paging": true,
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50, 100],
                "searching": true, 
                "ordering": true 
            });
        }
    </script>

</body>
</html>
