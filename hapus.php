<?php
require_once 'koneksi.php';

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        $stmt = $conn->prepare("DELETE FROM buku WHERE id = :id");
        $stmt->execute([':id' => $id]);
    } catch (PDOException $e) {
        die("Gagal menghapus data: " . $e->getMessage());
    }
}

// Redirect kembali ke tabel index
header("Location: index.php");
exit;
?>