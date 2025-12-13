<?php
require "../../config/database.php";

$anggota = mysqli_query($conn, "SELECT * FROM anggota_perpus");
$buku = mysqli_query($conn, "SELECT * FROM daftar_buku WHERE status='Tersedia'");

$selectedBook = null;

if(isset($_POST['pilih_buku'])) {
    $kode_buku = $_POST['kode_buku'];
    $selectedBook = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM daftar_buku WHERE kode_buku='$kode_buku'"));
}

if(isset($_POST['simpan'])) {
    $kode_buku = $_POST['kode_buku'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $date = $_POST['date'];
    $due = $_POST['due'];

    $total = (strtotime($due) - strtotime($date)) / 86400;

    mysqli_query($conn, 
    "INSERT INTO peminjaman_buku 
    (kode_buku, judul_buku, penulis, penerbit, tahun_terbit, nis, nama_peminjam, date, due, total_hari) 
    VALUES 
    ('$kode_buku', '$judul', '$penulis', '$penerbit', '$tahun', '$nis', '$nama', '$date', '$due', '$total')");

    mysqli_query($conn, "UPDATE daftar_buku SET status='Dipinjam' WHERE kode_buku='$kode_buku'");

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Peminjaman Buku</title>
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

        select, input {
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
            background: #007bff;
            border: none;
            border-radius: 8px;
            color: white;
            cursor: pointer;
            font-size: 15px;
            transition: 0.3s;
        }

        button:hover {
            background: #005dc1;
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
    <h2>Tambah Peminjaman Buku</h2>

    <form method="post">
        <label>Pilih Buku:</label>
        <select name="kode_buku" onchange="this.form.submit()" required>
            <option disabled selected>Pilih Buku</option>
            <?php while($row = mysqli_fetch_assoc($buku)): ?>
                <option value="<?= $row['kode_buku']; ?>" 
                    <?= (isset($selectedBook) && $selectedBook['kode_buku'] == $row['kode_buku']) ? 'selected' : '' ?>>
                    <?= $row['judul']; ?>
                </option>
            <?php endwhile; ?>
        </select>
        <input type="hidden" name="pilih_buku" value="1">

        <label>Judul Buku:</label>
        <input type="text" name="judul" value="<?= $selectedBook['judul'] ?? '' ?>" readonly>

        <label>Penulis:</label>
        <input type="text" name="penulis" value="<?= $selectedBook['penulis'] ?? '' ?>" readonly>

        <label>Penerbit:</label>
        <input type="text" name="penerbit" value="<?= $selectedBook['penerbit'] ?? '' ?>" readonly>

        <label>Tahun Terbit:</label>
        <input type="text" name="tahun" value="<?= $selectedBook['tahun_terbit'] ?? '' ?>" readonly>

        <label>Pilih Anggota:</label>
        <select name="nis" required>
            <option disabled selected>Pilih Peminjam</option>
            <?php 
            mysqli_data_seek($anggota, 0);
            while($a = mysqli_fetch_assoc($anggota)): ?>
                <option value="<?= $a['nis']; ?>"><?= $a['nama']; ?></option>
            <?php endwhile; ?>
        </select>

        <label>Nama Peminjam:</label>
        <input type="text" name="nama" required>

        <label>Tanggal Pinjam:</label>
        <input type="date" name="date" required>

        <label>Tanggal Kembali:</label>
        <input type="date" name="due" required>

        <button name="simpan">Simpan</button>
    </form>

    <a href="index.php" class="back-link">← Kembali</a>
</div>

</body>
</html>
