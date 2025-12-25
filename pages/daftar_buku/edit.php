<?php
require "../../config/database.php";

if (!isset($_GET['kode'])) {
    header("Location: index.php");
    exit;
}

$kode = $_GET['kode'];
$q = mysqli_query($conn, "SELECT * FROM daftar_buku WHERE kode_buku='$kode'");
$data = mysqli_fetch_assoc($q);

if (!$data) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['update'])) {
    mysqli_query($conn, "
        UPDATE daftar_buku SET
            judul='{$_POST['judul']}',
            penulis='{$_POST['penulis']}',
            penerbit='{$_POST['penerbit']}',
            tahun_terbit='{$_POST['tahun']}',
            stok='{$_POST['stok']}'
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
<link rel="stylesheet" href="/TUBES_PERPUS/assets/css/global.css">
<link rel="stylesheet" href="/TUBES_PERPUS/assets/css/form.css">
</head>
<body>

<div class="form-box">
<h2>Edit Buku</h2>

<form method="post">
<label>Judul Buku</label>
<input type="text" name="judul" value="<?= $data['judul'] ?>" required>

<label>Penulis</label>
<input type="text" name="penulis" value="<?= $data['penulis'] ?>" required>

<label>Penerbit</label>
<input type="text" name="penerbit" value="<?= $data['penerbit'] ?>" required>

<label>Tahun Terbit</label>
<input type="text" name="tahun" value="<?= $data['tahun_terbit'] ?>" required>

<label>Stok</label>
<input type="number" name="stok" value="<?= $data['stok'] ?>" required>

<button type="submit" name="update" class="btn-warning">Update</button>
</form>

<a href="index.php" class="back-link">⬅ Kembali</a>
</div>

</body>
</html>
