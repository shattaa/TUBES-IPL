<?php
require "../../config/database.php";

$id = $_GET['id'];

$data = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM peminjaman_buku WHERE id_peminjaman='$id'")
);

$telat_awal = 0;
$denda_awal = 0;

if (isset($_POST['tgl_kembali'])) {
    $deadline = strtotime($data['due']);
    $kembali  = strtotime($_POST['tgl_kembali']);

    $selisih = floor(($kembali - $deadline) / 86400);
    $telat_awal = $selisih > 0 ? $selisih : 0;
    $denda_awal = $telat_awal * 2000;
}

if (isset($_POST['submit'])) {

    $tgl_kembali = $_POST['tgl_kembali'];

    $deadline = strtotime($data['due']);
    $kembali  = strtotime($tgl_kembali);

    $selisih = floor(($kembali - $deadline) / 86400);
    $telat = $selisih > 0 ? $selisih : 0;
    $denda = $telat * 2000;

    // SIMPAN PENGEMBALIAN
    mysqli_query($conn, "
        INSERT INTO pengembalian_buku
        (kode_buku, judul_buku, penulis, penerbit, tahun_terbit, nis, nama_peminjam, return_date, elp, fine)
        VALUES (
            '{$data['kode_buku']}',
            '{$data['judul_buku']}',
            '{$data['penulis']}',
            '{$data['penerbit']}',
            '{$data['tahun_terbit']}',
            '{$data['nis']}',
            '{$data['nama_peminjam']}',
            '$tgl_kembali',
            '$telat',
            '$denda'
        )
    ");

    // 🔥 TAMBAH STOK SAAT DIKEMBALIKAN (FIX UTAMA)
    mysqli_query($conn, "
        UPDATE daftar_buku
        SET 
            stok = stok + 1,
            status = 'Tersedia'
        WHERE kode_buku = '{$data['kode_buku']}'
    ");

    // HAPUS DATA PEMINJAMAN
    mysqli_query($conn, "
        DELETE FROM peminjaman_buku WHERE id_peminjaman='$id'
    ");

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pengembalian Buku</title>
<style>
body {
    font-family: Arial, sans-serif;
    background: #f0f2f5;
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
label { font-size: 14px; color: #555; }
p { font-size: 14px; margin-bottom: 10px; }
input[type="date"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 8px;
    border: 1px solid #ccc;
}
.info-denda {
    background: #fff3cd;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 15px;
    color: #856404;
}
button {
    width: 100%;
    padding: 12px;
    background: #28a745;
    border: none;
    border-radius: 8px;
    color: white;
}
button:hover { background: #218838; }
.back-link {
    display: block;
    text-align: center;
    margin-top: 15px;
}
</style>
</head>

<body>
<div class="form-box">
<h2>Proses Pengembalian Buku</h2>

<p><b>Judul:</b> <?= $data['judul_buku']; ?></p>
<p><b>Peminjam:</b> <?= $data['nama_peminjam']; ?></p>
<p><b>Deadline:</b> <?= date('d-m-Y', strtotime($data['due'])); ?></p>

<?php if ($telat_awal > 0): ?>
<div class="info-denda">
    Terlambat <?= $telat_awal ?> hari<br>
    Denda: <b>Rp <?= number_format($denda_awal,0,',','.'); ?></b>
</div>
<?php endif; ?>

<form method="post">
<label>Tanggal Dikembalikan</label>
<input type="date" name="tgl_kembali" required>
<button name="submit">Simpan Pengembalian</button>
</form>

<a href="index.php" class="back-link">⬅ Kembali</a>
</div>
</body>
</html>
