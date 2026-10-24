<?php
session_start();
require 'config.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

$stmt = $pdo->query("SELECT COUNT(*) FROM dosen");
$total_dosen = $stmt->fetchColumn();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard - SIM Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Dashboard - Halo, <?= $_SESSION['username'] ?></a>
            <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </nav>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group shadow">
                    <a href="dashboard.php" class="list-group-item list-group-item-action active">Dashboard</a>
                    <a href="dosen_list.php" class="list-group-item list-group-item-action">Manajemen Dosen</a>
                    <a href="laporan.php" class="list-group-item list-group-item-action">Laporan</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">Ringkasan Data</div>
                    <div class="card-body">
                        <h5 class="card-title">Total Dosen Aktif</h5>
                        <p class="card-text display-4"><?= $total_dosen ?> Orang</p>
                        <a href="dosen_list.php" class="btn btn-success">Kelola Data Dosen</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>