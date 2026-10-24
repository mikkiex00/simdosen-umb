<?php
require 'config.php';
require 'auth.php';

$stmt = $pdo->query("SELECT * FROM dosen ORDER BY nama ASC");
$dosen = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Laporan Data Dosen - SIM Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            .container {
                width: 100%;
                max-width: 100%;
            }
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-4 bg-white p-4 shadow-sm rounded">
        <!-- Bagian Header Laporan -->
        <div class="text-center mb-4">
            <h3 class="mb-0">LAPORAN DATA DOSEN AKTIF</h3>
            <h4 class="mb-0">UNIVERSITAS MUHAMMADIYAH BENGKULU</h4>
            <p class="text-muted">Tanggal Cetak: <?= date('d-m-Y') ?></p>
            <hr>
        </div>

        <!-- Tombol Aksi (Disembunyikan saat diprint) -->
        <div class="d-flex justify-content-between mb-3 no-print">
            <a href="dashboard.php" class="btn btn-secondary">Kembali ke Dashboard</a>
            <button onclick="window.print()" class="btn btn-success">
                🖨️ Cetak Laporan
            </button>
        </div>

        <!-- Tabel Data Laporan -->
        <div class="table-responsive">
            <table class="table table-bordered table-sm align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Nomor Registrasi</th>
                        <th>NUPTK</th>
                        <th>Nama Dosen</th>
                        <th>NIP</th>
                        <th>Jabatan Fungsional</th>
                        <th>Pendidikan</th>
                        <th>Penempatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($dosen) > 0): ?>
                        <?php $no = 1; foreach ($dosen as $row): ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nomor_registrasi']) ?></td>
                            <td><?= htmlspecialchars($row['nuptk']) ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['nip']) ?></td>
                            <td><?= htmlspecialchars($row['jabatan_fungsional']) ?></td>
                            <td><?= htmlspecialchars($row['pendidikan_terakhir']) ?></td>
                            <td><?= htmlspecialchars($row['penempatan']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">Belum ada data dosen.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Bagian Tanda Tangan (Opsional untuk laporan resmi) -->
        <div class="row mt-5">
            <div class="col-8"></div>
            <div class="col-4 text-center">
                <p>Bengkulu, <?= date('d F Y') ?><br>Mengetahui,</p>
                <br><br><br>
                <p><strong>Pimpinan / Dekan</strong></p>
            </div>
        </div>
    </div>
</body>
</html>