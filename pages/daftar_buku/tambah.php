<?php
require "../../config/database.php";

if (isset($_POST['simpan'])) {
    $kode    = $_POST['kode'];
    $judul   = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit= $_POST['penerbit'];
    $tahun   = $_POST['tahun'];
    $stok    = $_POST['stok'];

    // status otomatis berdasarkan stok
    $status = ($stok > 0) ? 'Tersedia' : 'Habis';

    // simpan ke database
    mysqli_query($conn, "
        INSERT INTO daftar_buku 
        (kode_buku, judul, penulis, penerbit, tahun_terbit, stok, status) 
        VALUES 
        ('$kode', '$judul', '$penulis', '$penerbit', '$tahun', '$stok', '$status')
    ");

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku</title>
    <link rel="stylesheet" href="/TUBES_PERPUS/assets/css/global.css">
    <link rel="stylesheet" href="/TUBES_PERPUS/assets/css/form.css">
</head>
<body>

<div class="form-box">
    <h2>Tambah Buku</h2>

    <form method="post">
        <label>Kode Buku:</label>
        <input type="text" name="kode" required>

        <label>Judul Buku:</label>
        <input type="text" name="judul" required>

        <label>Penulis:</label>
        <input type="text" name="penulis" required>

        <label>Penerbit:</label>
        <input type="text" name="penerbit" required>

        <label>Tahun Terbit:</label>
        <input type="number" name="tahun" min="1900" max="<?= date('Y'); ?>" required>

        <label>Stok Buku:</label>
        <input type="number" name="stok" min="1" value="1" required>

       <button class="btn-primary" name="simpan">Simpan</button>
    </form>

    <a href="index.php" class="back-link">⬅ Kembali</a>
</div>

</body>
</html>
