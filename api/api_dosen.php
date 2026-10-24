<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
require 'config.php';

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        if(isset($_GET['id'])) {
            $stmt = $pdo->prepare("SELECT * FROM dosen WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $stmt = $pdo->query("SELECT * FROM dosen");
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        echo json_encode(["status" => "success", "data" => $data]);
        break;
        
    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        if(!empty($data->nama)) {
            $stmt = $pdo->prepare("INSERT INTO dosen (nama, nip, jabatan_fungsional) VALUES (?, ?, ?)");
            $stmt->execute([$data->nama, $data->nip, $data->jabatan_fungsional]);
            echo json_encode(["status" => "success", "message" => "Data berhasil ditambahkan"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Data tidak lengkap"]);
        }
        break;
        
    default:
        echo json_encode(["status" => "error", "message" => "Method not allowed"]);
        break;
}
?>