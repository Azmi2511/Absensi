<?php include 'config/db.php'; ?>

<?php
// Query untuk mengambil data kehadiran
$query = "SELECT kehadiran.*, siswa.nama_siswa, kelas.nama_kelas FROM kehadiran
          JOIN siswa ON kehadiran.id_siswa = siswa.id_siswa
          JOIN kelas ON siswa.id_kelas = kelas.id_kelas
          ORDER BY tanggal_kehadiran DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Data Kehadiran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
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

                <!-- Tabel Data Kehadiran -->
                <div class="card p-4 mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5>Daftar Kehadiran</h5>
                        <a href="edit/tambah_kehadiran.php" class="btn btn-primary mb-3">+ Tambah Kehadiran</a>
                    </div>
                    <div class="table-responsive">
                        <table id="tabelSiswa" class="table table-striped table-bordered mt-3">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Tanggal Kehadiran</th>
                                <th>Status Kehadiran</th>
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
                                            <td>{$row['nama_kelas']}</td>
                                            <td>{$row['tanggal_kehadiran']}</td>
                                            <td>{$row['status']}</td>
                                            <td>
                                                <a href='edit/edit_kehadiran.php?id={$row['id_kehadiran']}' class='btn btn-warning btn-sm'>Edit</a>
                                                <a href='edit/hapus_kehadiran.php?id={$row['id_kehadiran']}' class='btn btn-danger btn-sm'>Hapus</a>
                                            </td>
                                        </tr>";
                                    $no++;
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center'>Tidak ada data kehadiran.</td></tr>";
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
