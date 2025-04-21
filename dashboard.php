<?php
include 'config/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Absensi</title>
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
            <!-- Admin -->
            <div class="text-center mb-4">
                <img src="images/Profile.jpg" class="rounded-circle" height="60" alt="Foto User">
                <h6 class="mt-2">Zul Azmi, S. Tr. Kom</h6>
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
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <!-- Header -->
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
            <div class="d-flex align-items-center">
                <img src="images/logo.jpg" alt="Logo" style="height: 50px;">
                <h4 class="ms-3 mb-0">Sistem Absensi SMAN 1 Bantan</h4>
            </div>
            <input type="text" class="form-control w-25 w-sm-100" placeholder="Cari...">
        </div>
        <button class="btn btn-outline-secondary d-md-none mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i> Menu
        </button>

        <!-- PHP Queries -->
        <?php
            $jmlGuru = $conn->query("SELECT COUNT(*) as total FROM guru")->fetch_assoc()['total'];
            $jmlSiswa = $conn->query("SELECT COUNT(*) as total FROM siswa")->fetch_assoc()['total'];
            $jmlHadir = $conn->query("SELECT COUNT(*) as total FROM kehadiran WHERE status='Hadir'")->fetch_assoc()['total'];
            $jmlAlpa = $conn->query("SELECT COUNT(*) as total FROM kehadiran WHERE status='Alpa'")->fetch_assoc()['total'];
        ?>

        <!-- Info Cards -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3"><div class="card text-bg-light p-3"><div>Jumlah Guru</div><h4><?= $jmlGuru; ?></h4></div></div>
            <div class="col-6 col-md-3"><div class="card text-bg-light p-3"><div>Jumlah Siswa</div><h4><?= $jmlSiswa; ?></h4></div></div>
            <div class="col-6 col-md-3"><div class="card text-bg-light p-3"><div>Jumlah Hadir</div><h4><?= $jmlHadir; ?></h4></div></div>
            <div class="col-6 col-md-3"><div class="card text-bg-light p-3"><div>Jumlah Alpa</div><h4><?= $jmlAlpa; ?></h4></div></div>
        </div>

        <!-- Charts -->
        <div class="row mb-4">
            <div class="col-md-6"><div class="card p-3"><h6>Grafik Kehadiran Siswa</h6><canvas id="barChart" height="150"></canvas></div></div>
            <div class="col-md-6"><div class="card p-3"><h6>Grafik Kehadiran Siswa</h6><canvas id="lineChart" height="150"></canvas></div></div>
        </div>

        <!-- Tabel Data Siswa -->
        <div class="card p-3 mb-5">
            <h6>Data Kehadiran Siswa</h6>
            <div class="table-responsive mt-3">
                <table id="tabelSiswa" class="table table-striped table-bordered">
                    <thead class="table-light"><tr><th>No</th><th>Nama Siswa</th><th>NIS</th><th>Kelas</th></tr></thead>
                    <tbody>
                    <?php
                    $no = 1;
                    $siswa = $conn->query("SELECT * FROM siswa INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas");
                    while ($row = $siswa->fetch_assoc()) {
                        echo "<tr><td>$no</td><td>{$row['nama_siswa']}</td><td>{$row['nis']}</td><td>{$row['nama_kelas']}</td></tr>";
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="js/script.js"></script>
</body>
</html>
