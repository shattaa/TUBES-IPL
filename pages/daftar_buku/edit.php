<?php
require "../../config/database.php";

$kode = $_GET['kode'];

$result = mysqli_query($conn, "SELECT * FROM daftar_buku WHERE kode_buku='$kode'");
$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $judul    = $_POST['judul'];
    $penulis  = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun    = $_POST['tahun'];
    $stok     = $_POST['stok'];

    // status otomatis berdasarkan stok
    $status = ($stok > 0) ? 'Tersedia' : 'Habis';

    mysqli_query($conn, "
        UPDATE daftar_buku SET 
            judul='$judul',
            penulis='$penulis',
            penerbit='$penerbit',
            tahun_terbit='$tahun',
            stok='$stok',
            status='$status'
        WHERE kode_buku='$kode'
    ");

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-box {
            width: 450px;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        label {
            font-size: 14px;
            color: #555;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #ffc107;
            border: none;
            border-radius: 8px;
            color: #000;
            cursor: pointer;
            font-size: 15px;
            transition: 0.3s;
        }

        button:hover {
            background: #e0a800;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="form-box">
    <h2>Edit Buku</h2>

    <form method="post">

        <label>Kode Buku</label>
        <input type="text" value="<?= $data['kode_buku']; ?>" readonly>

        <label>Judul Buku</label>
        <input type="text" name="judul" value="<?= $data['judul']; ?>" required>

        <label>Penulis</label>
        <input type="text" name="penulis" value="<?= $data['penulis']; ?>" required>

        <label>Penerbit</label>
        <input type="text" name="penerbit" value="<?= $data['penerbit']; ?>" required>

        <label>Tahun Terbit</label>
        <input type="number" name="tahun" value="<?= $data['tahun_terbit']; ?>" required>

        <!-- ✅ TAMBAHAN EDIT STOK -->
        <label>Stok Buku</label>
        <input type="number" name="stok" min="0" value="<?= $data['stok']; ?>" required>

        <button name="update">Update Buku</button>
    </form>

    <a href="index.php" class="back-link">⬅ Kembali</a>
</div>

</body>
</html>
