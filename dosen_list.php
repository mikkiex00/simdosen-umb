<?php
session_start();
require 'config.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

$dosen = $pdo->query("SELECT * FROM dosen")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Data Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between mb-3">
            <h2>Daftar Dosen Aktif Universitas</h2>
            <div>
                <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
                <a href="dosen_tambah.php" class="btn btn-primary">Tambah Dosen</a>
            </div>
        </div>
        <div class="table-responsive shadow">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>NIDN/Reg</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Jabatan Fungsional</th>
                        <th>Pendidikan</th>
                        <th>Penempatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($dosen as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nomor_registrasi']) ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= htmlspecialchars($row['nip']) ?></td>
                        <td><?= htmlspecialchars($row['jabatan_fungsional']) ?></td>
                        <td><?= htmlspecialchars($row['pendidikan_terakhir']) ?></td>
                        <td><?= htmlspecialchars($row['penempatan']) ?></td>
                        <td>
                            <a href="dosen_edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="dosen_hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>