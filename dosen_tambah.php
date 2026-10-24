<?php
session_start();
require 'config.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "INSERT INTO dosen (nomor_registrasi, nama, nip, jabatan_fungsional, pendidikan_terakhir, penempatan) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['nomor_registrasi'], $_POST['nama'], $_POST['nip'], 
        $_POST['jabatan_fungsional'], $_POST['pendidikan_terakhir'], $_POST['penempatan']
    ]);
    header("Location: dosen_list.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4>Tambah Data Dosen</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Nomor Registrasi / NIDN</label>
                            <input type="text" name="nomor_registrasi" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>NIP</label>
                            <input type="text" name="nip" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Jabatan Fungsional</label>
                            <input type="text" name="jabatan_fungsional" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Pendidikan Terakhir</label>
                            <input type="text" name="pendidikan_terakhir" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Penempatan (Prodi/Fakultas)</label>
                            <input type="text" name="penempatan" class="form-control" value="Teknik Informatika">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan Data</button>
                    <a href="dosen_list.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>