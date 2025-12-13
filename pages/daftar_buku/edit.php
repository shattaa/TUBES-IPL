<?php
require "../../config/database.php";
$kode = $_GET['kode'];

$result = mysqli_query($conn, "SELECT * FROM daftar_buku WHERE kode_buku='$kode'");
$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $status = $_POST['status'];

    mysqli_query($conn, "UPDATE daftar_buku SET 
        judul='$judul',
        penulis='$penulis',
        penerbit='$penerbit',
        tahun_terbit='$tahun',
        status='$status'
        WHERE kode_buku='$kode'");

    header("Location: index.php");
    exit;
}
?>

<h2>Edit Buku</h2>
<form method="post">
    Judul Buku: <input type="text" name="judul" value="<?= $data['judul']; ?>" required><br><br>
    Penulis: <input type="text" name="penulis" value="<?= $data['penulis']; ?>" required><br><br>
    Penerbit: <input type="text" name="penerbit" value="<?= $data['penerbit']; ?>" required><br><br>
    Tahun Terbit: <input type="number" name="tahun" value="<?= $data['tahun_terbit']; ?>" required><br><br>
    Status: 
    <select name="status">
        <option <?= $data['status']=='Tersedia'?'selected':'' ?>>Tersedia</option>
        <option <?= $data['status']=='Dipinjam'?'selected':'' ?>>Dipinjam</option>
    </select><br><br>

    <button name="update">Update</button>
</form>

<br>
<a href="index.php">Kembali</a>
