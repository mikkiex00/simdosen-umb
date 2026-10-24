<?php
session_start();
require 'config.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') { 
    die("Akses Ditolak!"); 
}

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM dosen WHERE id = ?");
$stmt->execute([$id]);

header("Location: dosen_list.php");
?>