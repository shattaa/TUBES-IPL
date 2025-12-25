<?php
require "../../config/database.php";

$anggota = mysqli_query($conn, "SELECT * FROM anggota_perpus");
$buku = mysqli_query($conn, "SELECT * FROM daftar_buku WHERE stok > 0");

$selectedBook = null;

if(isset($_POST['pilih_buku'])) {
    $kode_buku = $_POST['kode_buku'];
    $selectedBook = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT * FROM daftar_buku WHERE kode_buku='$kode_buku'")
    );
}

if(isset($_POST['simpan'])) {
    $kode_buku = $_POST['kode_buku'];
    $judul     = $_POST['judul'];
    $penulis   = $_POST['penulis'];
    $penerbit  = $_POST['penerbit'];
    $tahun     = $_POST['tahun'];
    $nis       = $_POST['nis'];
    $nama      = $_POST['nama'];
    $date      = $_POST['date'];
    $due       = $_POST['due'];

    $total = (strtotime($due) - strtotime($date)) / 86400;

    // SIMPAN PEMINJAMAN
    mysqli_query($conn, "
        INSERT INTO peminjaman_buku
        (kode_buku, judul_buku, penulis, penerbit, tahun_terbit, nis, nama_peminjam, date, due, total_hari)
        VALUES
        ('$kode_buku', '$judul', '$penulis', '$penerbit', '$tahun', '$nis', '$nama', '$date', '$due', '$total')
    ");

    // 🔥 KURANGI STOK
    mysqli_query($conn, "
        UPDATE daftar_buku
        SET 
            stok = stok - 1,
            status = IF(stok - 1 > 0, 'Tersedia', 'Habis')
        WHERE kode_buku = '$kode_buku'
    ");

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Peminjaman Buku</title>
<link rel="stylesheet" href="/TUBES_PERPUS/assets/css/global.css">
<link rel="stylesheet" href="/TUBES_PERPUS/assets/css/form.css">
<link rel="stylesheet" href="/TUBES_PERPUS/assets/css/peminjaman.css">


</head>

<body>

<div class="form-box">
<h2>Tambah Peminjaman Buku</h2>

<form method="post">

<label>Pilih Buku</label>
<select name="kode_buku" onchange="this.form.submit()" required>
    <option disabled selected>Pilih Buku</option>
    <?php while($row = mysqli_fetch_assoc($buku)): ?>
        <option value="<?= $row['kode_buku']; ?>"
            <?= ($selectedBook && $selectedBook['kode_buku']==$row['kode_buku'])?'selected':'' ?>>
            <?= $row['judul']; ?> (Stok: <?= $row['stok']; ?>)
        </option>
    <?php endwhile; ?>
</select>
<input type="hidden" name="pilih_buku" value="1">

<label>Judul Buku</label>
<input type="text" name="judul" value="<?= $selectedBook['judul'] ?? '' ?>" readonly>

<label>Penulis</label>
<input type="text" name="penulis" value="<?= $selectedBook['penulis'] ?? '' ?>" readonly>

<label>Penerbit</label>
<input type="text" name="penerbit" value="<?= $selectedBook['penerbit'] ?? '' ?>" readonly>

<label>Tahun Terbit</label>
<input type="text" name="tahun" value="<?= $selectedBook['tahun_terbit'] ?? '' ?>" readonly>

<label>Pilih Anggota</label>
<select name="nis" id="nis" required>
    <option disabled selected>Pilih Peminjam</option>
    <?php
    mysqli_data_seek($anggota,0);
    while($a = mysqli_fetch_assoc($anggota)): ?>
        <option value="<?= $a['nis']; ?>" data-nama="<?= $a['nama']; ?>">
            <?= $a['nis']; ?> - <?= $a['nama']; ?>
        </option>
    <?php endwhile; ?>
</select>

<label>Nama Peminjam</label>
<input type="text" name="nama" id="nama_peminjam" readonly>

<label>Tanggal Pinjam</label>
<input type="date" name="date" required>

<label>Tanggal Kembali</label>
<input type="date" name="due" required>

<button class="btn-primary" name="simpan">Simpan</button>

</form>

<a href="index.php" class="back-link">← Kembali</a>
</div>

<script>
document.getElementById('nis').addEventListener('change', function(){
    const opt = this.options[this.selectedIndex];
    document.getElementById('nama_peminjam').value =
        opt.getAttribute('data-nama') || '';
});
</script>

</body>
</html>
