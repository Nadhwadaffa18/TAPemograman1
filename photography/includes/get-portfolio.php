<?php
include 'config.php';

$id = isset($_GET['id']) ? escape($_GET['id']) : '';

if (!empty($id)) {
    $portfolio = querySingle("SELECT p.*, k.nama_kategori FROM portofolio p JOIN kategori k ON p.kategori_id = k.id WHERE p.id = '$id'");
    
    if ($portfolio) {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $portfolio
        ]);
    } else {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => 'Portfolio not found'
        ]);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'ID not provided'
    ]);
}
?>
