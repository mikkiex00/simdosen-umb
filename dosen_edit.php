<?php
require 'config.php';
require 'auth.php';

if (!isset($_GET['id'])) {
    header("Location: dosen_list.php");
    exit;
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM dosen WHERE id = ?");
$stmt->execute([$id]);
$dosen = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$dosen) {
    die("Data dosen tidak ditemukan!");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "UPDATE dosen SET 
            nomor_registrasi = ?, 
            nama = ?, 
            nip = ?, 
            jabatan_fungsional = ?, 
            pendidikan_terakhir = ?, 
            penempatan = ? 
            WHERE id = ?";
            
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['nomor_registrasi'], 
        $_POST['nama'], 
        $_POST['nip'], 
        $_POST['jabatan_fungsional'], 
        $_POST['pendidikan_terakhir'], 
        $_POST['penempatan'],
        $id
    ]);
    
    header("Location: dosen_list.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Data Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h4>Edit Data Dosen</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($dosen['nama']) ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Nomor Registrasi / NIDN</label>
                            <input type="text" name="nomor_registrasi" class="form-control" value="<?= htmlspecialchars($dosen['nomor_registrasi']) ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>NIP</label>
                            <input type="text" name="nip" class="form-control" value="<?= htmlspecialchars($dosen['nip']) ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Jabatan Fungsional</label>
                            <input type="text" name="jabatan_fungsional" class="form-control" value="<?= htmlspecialchars($dosen['jabatan_fungsional']) ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Pendidikan Terakhir</label>
                            <input type="text" name="pendidikan_terakhir" class="form-control" value="<?= htmlspecialchars($dosen['pendidikan_terakhir']) ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Penempatan (Prodi/Fakultas)</label>
                            <input type="text" name="penempatan" class="form-control" value="<?= htmlspecialchars($dosen['penempatan']) ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Data</button>
                    <a href="dosen_list.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>