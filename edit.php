<?php
require_once 'koneksi.php';

// Ambil ID dari URL
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit;
}

// Ambil data buku lama
$stmt = $conn->prepare("SELECT * FROM buku WHERE id = :id");
$stmt->execute([':id' => $id]);
$buku = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$buku) {
    echo "Data buku tidak ditemukan!";
    exit;
}

// Proses update saat form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $judul   = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $terbit  = $_POST['terbit'];
    $stok    = $_POST['stok'];

    try {
        $sql = "UPDATE buku SET judul = :judul, penulis = :penulis, tahun_terbit = :terbit, stok = :stok WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':judul'   => $judul,
            ':penulis' => $penulis,
            ':terbit'  => $terbit,
            ':stok'    => $stok,
            ':id'      => $id
        ]);

        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Buku</title>
</head>
<body>
    <div class="container my-5" style="max-width: 600px;">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h4 class="m-0">Form Edit Buku</h4>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= $error; ?></div>
                <?php endif; ?>

                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Judul Buku</label>
                        <input type="text" class="form-control" name="judul" value="<?= htmlspecialchars($buku['judul']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Penulis</label>
                        <input type="text" class="form-control" name="penulis" value="<?= htmlspecialchars($buku['penulis']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tahun Terbit</label>
                        <input type="number" class="form-control" name="terbit" min="1900" max="2026" value="<?= htmlspecialchars($buku['tahun_terbit']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" class="form-control" name="stok" min="0" value="<?= htmlspecialchars($buku['stok']); ?>" required>
                    </div>
                    <button type="submit" name="update" class="btn btn-warning">Update Data</button>
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>