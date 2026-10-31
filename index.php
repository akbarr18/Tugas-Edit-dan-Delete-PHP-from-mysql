<?php
require_once 'koneksi.php';

// Ambil semua data buku dari database
$stmt = $conn->query("SELECT * FROM buku ORDER BY id DESC");
$daftar_buku = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Daftar Buku - Perpustakaan</title>
</head>
<body>
    <header class="bg-primary text-white p-3 mb-4">
        <div class="container">
            <h1 class="h3 m-0">Website Praktik Perpustakaan</h1>
        </div>
    </header>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Daftar Koleksi Buku</h2>
            <a href="tambah.php" class="btn btn-success">+ Tambah Buku Baru</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Tahun Terbit</th>
                        <th>Stok</th>
                        <th style="width: 160px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($daftar_buku) > 0): ?>
                        <?php $no = 1; foreach ($daftar_buku as $buku): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($buku['judul']); ?></td>
                                <td><?= htmlspecialchars($buku['penulis']); ?></td>
                                <td><?= htmlspecialchars($buku['tahun_terbit']); ?></td>
                                <td><?= htmlspecialchars($buku['stok']); ?></td>
                                <td class="text-center">
                                    <a href="edit.php?id=<?= $buku['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="hapus.php?id=<?= $buku['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus buku ini?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-3">Belum ada data buku. Silakan klik tombol tambah.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>