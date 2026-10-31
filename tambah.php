<?php
require_once 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $judul   = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $terbit  = $_POST['terbit'];
    $stok    = $_POST['stok'];

    try {
        $sql = "INSERT INTO buku (judul, penulis, tahun_terbit, stok) VALUES (:judul, :penulis, :terbit, :stok)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':judul'   => $judul,
            ':penulis' => $penulis,
            ':terbit'  => $terbit,
            ':stok'    => $stok
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
    <title>Tambah Buku</title>
</head>
<body>
    <div class="container my-5" style="max-width: 600px;">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="m-0">Form Tambah Buku</h4>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= $error; ?></div>
                <?php endif; ?>

                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Judul Buku</label>
                        <input type="text" class="form-control" name="judul" required minlength="3">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Penulis</label>
                        <input type="text" class="form-control" name="penulis" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tahun Terbit</label>
                        <input type="number" class="form-control" name="terbit" min="1900" max="2026" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" class="form-control" name="stok" min="0" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Simpan Buku</button>
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>